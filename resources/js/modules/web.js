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
        friends:{
            data:{
                name:'',
                avatar:'',
                description:'',
                owner:'',
            }
        },
        setFriendsLoadStatus:''
    },
    actions:{
        loadConfigs({commit}){
            commit('setConfigsLoadStatus',1);
            WebAPI.getConfigs()
                .then(function (response) {
                    commit('setConfigs', response.data);
                    commit('setConfigsLoadStatus', 2);
                })
                .catch(function (error){
                    commit('setConfigsLoadStatus', 3);
                });
        },
        loadFriends({commit}){
            commit('setFriendsLoadStatus',1);
            WebAPI.getFriends()
                .then(function (response) {
                    commit('setFriends', response.data);
                    commit('setFriendsLoadStatus', 2);
                })
                .catch(function (error){
                    commit('setFriendsLoadStatus', 3);
                });
        },
    },
    mutations:{
        setConfigsLoadStatus(state,status){
            state.configsLoadStatus = status;
        },
        setConfigs(state,configs){
            state.configs = configs;
        },
        setFriendsLoadStatus(state,status){
            state.friendsLoadStatus = status;
        },
        setFriends(state,friends){
            state.friends = friends;
        },
    },
    getters:{
        getConfigs(state){
            return state.configs;
        },
        getConfigsLoadStatus(state){
            return state.configsLoadStatus;
        },
        getFriends(state){
            return state.friends;
        },
        getsetFriendsLoadStatus(state){
            return state.setFriendsLoadStatus;
        },
    }
};