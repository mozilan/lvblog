/*
|-------------------------------------------------------------------------------
| VUEX modules/users.js
|-------------------------------------------------------------------------------
| The Vuex data store for the users
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
        verificationCodes:[],
        //短信验证码加载状态
        verificationCodeLoadStatus:0,
        //手机号注册
        registerByPhoneStatus:0,
        //登录状态
        loginStatus:0,
        // 存储token
        Authorization: localStorage.getItem('Authorization') ? localStorage.getItem('Authorization') : '',
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
                    console.log(error);
                    commit('setCaptchas', []);
                    commit('setCaptchaLoadStatus', 3);
                });
        },
        loadVerificationCodes({commit}, data) {
            commit('setVerificationCodeLoadStatus', 1);
            UserAPI.getVerificationCodes(data.captcha_key, data.captcha_code, data.phone)
                .then(function (response) {
                    commit('setVerificationCodes', 'Bearer '+response.data);
                    commit('setVerificationCodeLoadStatus', 2);
                })
                .catch(function (error) {
                    console.log(error);
                    commit('setVerificationCodes', []);
                    commit('setVerificationCodeLoadStatus', 3);
                });
        },
        freshCaptchaStatus({commit}){
            commit('setCaptchas', []);
            commit('setCaptchaLoadStatus', 0);
        },
        freshVerificationCodeStatus({commit}){
            commit('setVerificationCodes', []);
            commit('setVerificationCodeLoadStatus', 0);
        },
        freshRegisterByPhoneStatus({commit}){
            commit( 'setRegisterByPhoneStatus',0);
        },
        registerByPhone( {commit},data){
            commit( 'setRegisterByPhoneStatus', 1);
            UserAPI.postSignIn( data.verification_key,data.verification_code, data.name,data.password)
                .then(function ( response ) {
                    commit( 'setRegisterByPhoneStatus' , 2);
                })
                .catch(function (error) {
                    console.log(error);
                    commit( 'setRegisterByPhoneStatus',3);
                })
        },
        login({commit},data){
            commit('setLoginStatus',1);
            UserAPI.postSignUp( data.username,data.password)
                .then(function ( response ) {
                    // console.log(response);
                    commit( 'setLoginStatus' , 2);
                    commit('setLoginToken','Bearer ' + response.data.access_token);
                })
                .catch(function (error) {
                    console.log(error);
                    commit( 'setLoginStatus',3);
                })
        }
    },
        mutations:{
            setCaptchaLoadStatus(state,status){
                state.captchaLoadStatus = status;
            },
            setCaptchas(state,capchas){
                state.captchas = capchas;
            },
            setVerificationCodeLoadStatus(state,status){
                state.verificationCodeLoadStatus = status;
            },
            setVerificationCodes(state,verificationCodes){
                state.verificationCodes = verificationCodes;
            },
            setRegisterByPhoneStatus(state , status){
                state.registerByPhoneStatus = status;
            },
            setLoginStatus(state , status){
                state.loginStatus = status;
            },
            // 修改token，并将token存入localStorage
            setLoginToken (state, access_token) {
                state.Authorization = access_token;
                localStorage.setItem('Authorization', access_token);
            }
        },
        getters:{
            getCaptchaLoadStatus( state ){
                return state.captchaLoadStatus;
            },
            getCaptchas( state ){
                return state.captchas;
            },
            getVerificationCodeLoadStatus( state ){
                return state.verificationCodeLoadStatus;
            },
            getVerificationCodes( state ){
                return state.verificationCodes;
            },
            getLoginStatus( state ){
                return state.loginStatus;
            },
            getLoginToken( state ){
                return state.Authorization;
            },
        }
};