<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AuthorizationRequest;
use App\Http\Requests\Api\SocialAuthorizationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Transformers\UserTransformer;

class AuthorizationsController extends Controller
{
    public function store(AuthorizationRequest $request)
    {
        $username = $request->username;

        filter_var($username, FILTER_VALIDATE_EMAIL) ?
            $credentials['email'] = $username :
            $credentials['phone'] = $username;

        $credentials['password'] = $request->password;
        if (!$token = \Auth::guard('api')->attempt($credentials)) {
            return $this->response->errorUnauthorized('用户名或密码错误');
        }
        filter_var($username, FILTER_VALIDATE_EMAIL) ? $username_type = 'email': $username_type = 'phone';
        $user = User::where($username_type,$username)->first();
        return $this->respondWithUserTransformer($user,$token);
    }
    protected function respondWithUserTransformer($user,$token)
    {
        return $this->response->item($user, new UserTransformer())
            ->setMeta([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
            ])
            ->setStatusCode(201);
    }
    public function update()
    {
        $token = Auth::guard('api')->refresh();
        return $this->respondWithToken($token);
    }

    public function destroy()
    {
        Auth::guard('api')->logout();
        return $this->response->noContent();
    }
    public function socialStore($type, SocialAuthorizationRequest $request)
    {
//        if (!in_array($type, ['weixin'])) {
//            return $this->response->errorBadRequest();
//        }

        $driver = \Socialite::driver($type);

        try {
            if ($code = $request->code) {
                $response = $driver->getAccessTokenResponse($code);
                $token = array_get($response, 'access_token');
            } else {
                $token = $request->access_token;

                if ($type == 'weixin') {
                    $driver->setOpenId($request->openid);
                }
            }

            $oauthUser = $driver->userFromToken($token);
        } catch (\Exception $e) {
            return $this->response->errorUnauthorized('参数错误，未获取用户信息');
        }
        
        // 在本地 users 表中查询该用户来判断是否已存在
        $user = User::where( 'provider_id', '=', $oauthUser->id )
            ->where( 'provider', '=', $type )
            ->first();
        if ($user == null) {
            // 如果该用户不存在则将其保存到 users 表
            $newUser = new User();

            $newUser->name        = $type=='weibo'?$oauthUser->getNickname():$oauthUser->getName();
            $oauthUserEmail = $oauthUser->getEmail() ;
            if($oauthUserEmail !== ''){
                User::where('email',$oauthUserEmail)->doesntExist() ? $newUser->email = $oauthUserEmail:$newUser->email = null;
            }else{
                $newUser->email = '';
            }
            $newUser->avatar      = $oauthUser->getAvatar();
            $newUser->password    = '';
            $newUser->provider    = $type;
            $newUser->provider_id = $oauthUser->getId();

            $newUser->save();
            $user = $newUser;
        }
        $token=\Auth::guard('api')->fromUser($user);
        return $this->respondWithUserTransformer($user,$token);
    }
}
