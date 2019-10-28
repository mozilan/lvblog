/*
|-------------------------------------------------------------------------------
| VUEX modules/users.js
|-------------------------------------------------------------------------------
| The Vuex data store for the Users
*/

import UserAPI from '../api/users';

/**
    status = 0 -> 数据尚未加载
    status = 1 -> 数据开始加载
    status = 2 -> 数据加载成功
    status = 3 -> 数据加载失败
*/

export const users = {
    state: {
        //图形验证码
        captchas:[],
        //图形验证码加载状态
        captchaLoadStatus:0,
        //短信验证码
        captchaError:'',
        verificationCodes:[],
        //短信验证码加载状态
        verificationCodeLoadStatus:0,
        verificationCodeError:'',
        //手机号注册
        registerByPhoneStatus:0,
        registerByPhoneError:'',
        //登录状态
        loginStatus:0,
        loginErrors:'',
        // 存储token
        Authorization: localStorage.getItem('Authorization') ? localStorage.getItem('Authorization') : '',
        user: {
            data:{
                id:11,
                name:'Mozilan',
                email:null,
                avatar:'',
                bound_phone:false,
                bound_oauth:'github',
                created_at:'2019-10-15 20:26:11',
                updated_at:'2019-10-15 20:26:11',
                introduction:'',
            }
        },
        userLoadStatus:0,
        logoutStatus:0,
        userProfileUpdateStatus:'',
        userProfileUpdateMessages:'',
        other:'',
        otherLoadStatus:'',
    },
    actions: {
        loadCaptchas({commit},data){
            commit('setCaptchaLoadStatus', 1);
            UserAPI.getCaptchas(data.phone)
                .then(function (response) {
                    commit('setCaptchas', response.data);
                    commit('setCaptchaLoadStatus', 2);
                })
                .catch(function (error){
                    commit('setCaptchas', []);
                    commit('setCaptchasError', error.response.data.errors[Object.keys(error.response.data.errors)[0]].toString());
                    commit('setCaptchaLoadStatus', 3);
                });
        },
        loadVerificationCodes({commit}, data) {
            commit('setVerificationCodeLoadStatus', 1);
            UserAPI.getVerificationCodes(data.captcha_key, data.captcha_code, data.phone)
                .then(function (response) {
                    commit('setVerificationCodes',response.data.key);
                    commit('setVerificationCodeLoadStatus', 2);
                })
                .catch(function (error) {
                    commit('setVerificationCodes', []);
                    if(error.response.status == 422){
                        commit('setVerificationCodeError', '图形验证码已失效');
                    }else{
                        commit('setVerificationCodeError', error.response.data.message);
                    }
                    commit('setVerificationCodeLoadStatus', 3);
                });
        },
        registerByPhone( {commit , dispatch},data){
            commit( 'setRegisterByPhoneStatus', 1);
            UserAPI.postSignIn( data.verification_key,data.verification_code, data.name,data.password)
                .then(function ( response ) {
                    commit('setRegisterByPhoneStatus' , 2);
                    commit('setLoginToken','Bearer ' + response.data.meta.access_token);
                    dispatch('loadUser');
                })
                .catch(function (error){
                    commit('setRegisterByPhoneError', error.response.data.errors[Object.keys(error.response.data.errors)[0]].toString());
                    commit('setRegisterByPhoneStatus',3);
                })
        },
        login({commit},data){
            commit('setLoginStatus',1);
            UserAPI.postSignUp( data.username,data.password)
                .then(function ( response ) {
                    commit('setUser' , response.data.data);
                    commit('setUserLoadStatus',2);
                    commit('setLoginToken','Bearer ' + response.data.meta.access_token);
                    commit('setLoginStatus' , 2);
                })
                .catch(function (error) {
                    commit('setUser' ,'');
                    commit('setUserLoadStatus',3);
                    commit('setLoginStatus',3);
                    commit('setLoginErrors',error.response.data.message !== '' ? error.response.data.message: '未知错误');
        })
        },
        loginByOauth({commit},data){
            commit('setLoginStatus',1);
                    UserAPI.postSignInByOauth( data.code,data.social_type)
                    .then(function ( response ) {
                        commit('setLoginToken','Bearer ' + response.data.meta.access_token);
                        commit('setUser' , response.data.data);
                        commit('setUserLoadStatus',2);
                        commit('setLoginStatus' , 2);
                    })
                    .catch(function (error) {
                        localStorage.removeItem('Authorization');
                        commit('setLoginToken','');
                        commit('setUser' ,'');
                        commit('setLoginStatus',3);
                        commit('setUserLoadStatus',3);
                        commit('setLoginErrors',error.response.data.message !== '' ? error.response.data.message: '未知错误');
                    });
        },
        loadUser({commit}){
            commit('setUserLoadStatus',1);
                UserAPI.getLoadUser()
                    .then(function (response) {
                        commit('setUserLoadStatus',2);
                        commit('setUser' , response.data.data);
                    })
                    .catch(function (error) {

                        localStorage.removeItem('Authorization');
                        commit('setLoginToken','');

                        commit('setUser' ,'');
                        commit('setUserLoadStatus',3);
                    });
        },
        loadOther({commit},data){
            commit('setOtherLoadStatus',1);
            UserAPI.getLoadOther(data)
                .then(function (response) {
                    if(response.data.data !== ''){
                        commit('setOtherLoadStatus',2);
                        commit('setOther' , response.data.data);
                    }
                    else{
                        commit('setOtherLoadStatus',3);
                    }
                })
                .catch(function (error){
                    commit('setOther' ,'');
                    commit('setOtherLoadStatus',3);
                });
        },
        logout({commit,dispatch}){
            commit('setLogoutStatus',1);
            try {
                localStorage.removeItem('Authorization');
                commit('setLoginToken', '');
                dispatch('loadUser');
                commit('setLogoutStatus', 2);
                commit('setLoginStatus',0);
            }catch (e) {
                commit('setLogoutStatus', 3);
            }
        },
        updateUserProfile({commit,dispatch},data) {
            commit( 'setUserProfileUpdateStatus', 1);
            UserAPI.patchUpdateUserProfile( data)
                .then(function ( response ) {
                    commit('setUserProfileUpdateStatus' , 2);
                    dispatch('loadUser');
                })
                .catch(function (error){
                    commit('setUserProfileUpdateMessages', error.response.data.errors[Object.keys(error.response.data.errors)[0]].toString());
                    commit('setUserProfileUpdateStatus',3);
                })
        },
        refreshToken({commit},data){
            commit('setLoginToken', data.token);
        }
    },
        mutations:{
            setCaptchaLoadStatus(state,status){
                state.captchaLoadStatus = status;
            },
            setCaptchas(state,capchas){
                state.captchas = capchas;
            },
            setCaptchasError(state,error){
                state.captchaError = error;
            },
            setVerificationCodeLoadStatus(state,status){
                state.verificationCodeLoadStatus = status;
            },
            setVerificationCodes(state,verificationCodes){
                state.verificationCodes = verificationCodes;
            },
            setVerificationCodeError( state , error ){
                state.verificationCodeError = error;
            },
            setRegisterByPhoneStatus(state , status){
                state.registerByPhoneStatus = status;
            },
            setRegisterByPhoneError(state , error ){
                state.registerByPhoneError = error;
            },
            setLoginStatus(state , status){
                state.loginStatus = status;
            },
            setLogoutStatus(state , status){
                state.logoutStatus = status;
            },
            setLoginErrors(state , status){
                state.loginErrors = status;
            },
            // 修改token，并将token存入localStorage
            setLoginToken (state, access_token) {
                state.Authorization = access_token;
                localStorage.setItem('Authorization', access_token);
            },
            setUser (state, data) {
                state.user = data;
            },
            setUserLoadStatus(state,status){
                state.userLoadStatus = status;
            },
            setOther (state, data) {
                state.other = data;
            },
            setOtherLoadStatus(state,status){
                state.otherLoadStatus = status;
            },
            setUserProfileUpdateStatus(state,status){
                state.userProfileUpdateStatus = status;
            } ,
            setUserProfileUpdateMessages(state,error){
                state.userProfileUpdateMessages = error;
            },
        },
        getters:{
            getCaptchaLoadStatus( state ){
                return function () {
                    return state.captchaLoadStatus;
                }
            },
            getCaptchas( state ){
                return state.captchas;
            },
            getCaptchaError( state ){
                return state.captchaError;
            },
            getVerificationCodeLoadStatus( state ){
                return function () {
                    return state.verificationCodeLoadStatus;
                }
            },
            getVerificationCodes( state ){
                return state.verificationCodes;
            },
            getVerificationCodeError( state ){
                return state.verificationCodeError;
            },
            getLoginStatus( state ){
                return function () {
                    return state.loginStatus;
                }
            },
            getLoginErrors(state ){
                return function () {
                    return state.loginErrors;
                }
            },
            getLoginToken( state ){
                return state.Authorization;
            },
            getRegisterByPhoneStatus (state){
                return function () {
                    return state.registerByPhoneStatus;
                }
            },
            getRegisterByPhoneError( state ){
                return state.registerByPhoneError;
            },
            getUser(state){
                return state.user;
            },
            getUserLoadStatus(state){
                return function(){
                    return state.userLoadStatus;
                }
            },
            getOther(state){
                return state.other;
            },
            getOtherLoadStatus(state){
                return state.otherLoadStatus;
            },
            getUserProfileUpdateStatus(state){
                return function() {
                    return state.userProfileUpdateStatus;
                }
            } ,
            getUserProfileUpdateMessages(state){
                return function() {
                    return state.userProfileUpdateMessages;
                }
            },
            getLogoutStatus(state){
                return state.logoutStatus;
            }
        }
};