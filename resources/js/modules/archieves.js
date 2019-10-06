/*
|-------------------------------------------------------------------------------
| VUEX modules/users.js
|-------------------------------------------------------------------------------
| The Vuex data store for the Archives
*/

import ArchivesAPI from '../api/archives';

/**
 status = 0 -> 数据尚未加载
 status = 1 -> 数据开始加载
 status = 2 -> 数据加载成功
 status = 3 -> 数据加载失败
 */

export const archives = {
    state: {
        //分类
        archives: [],
        archivesLoadStatus:0,
    },
    actions:{
        loadArchives({commit},data){
            commit('setArchivesLoadStatus',1);
            ArchivesAPI.getArchives(data.user)
                .then(function (response) {
                    commit('setArchives', response.data);
                    commit('setArchivesLoadStatus', 2);
                })
                .catch(function (error){
                    commit('setArchivesLoadStatus', 3);
                });
        },
    },
    mutations:{
        setArchivesLoadStatus(state,status){
            state.archivesLoadStatus = status;
        },
        setArchives(state,Archives){
            state.archives = Archives;
        },
    },
    getters:{
        getArchives(state){
            return state.archives;
        },
        getArchivesLoadStatus(state){
            return state.archivesLoadStatus;
        },
    }
};