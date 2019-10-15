/*
|-------------------------------------------------------------------------------
| VUEX modules/users.js
|-------------------------------------------------------------------------------
| The Vuex data store for the configs
*/

import WebAPI from '../api/web';

/**
 status = 0 -> 数据尚未加载
 status = 1 -> 数据开始加载
 status = 2 -> 数据加载成功
 status = 3 -> 数据加载失败
 */

export const web = {
    state: {
        //网站配置信息初始化
        configs:{
            data:{
                titile:'',
                notice:'',
                message:'',
                author:'',
                record:'',
                time:'',
            }
        },
        configsLoadStatus:0,
    },
    actions:{
        loadConfigs({commit}){
            commit('setConfigLoadStatus',1);
            WebAPI.getConfigs()
                .then(function (response) {
                    commit('setConfigs', response.data);
                    commit('setConfigLoadStatus', 2);
                })
                .catch(function (error){
                    commit('setConfigLoadStatus', 3);
                });
        },
    },
    mutations:{
        setConfigLoadStatus(state,status){
            state.configsLoadStatus = status;
        },
        setConfigs(state,configs){
            state.configs = configs;
        },
    },
    getters:{
        getConfigs(state){
            return state.configs;
        },
        getConfigsLoadStatus(state){
            return state.configsLoadStatus;
        },
    }
};