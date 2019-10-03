/*
|-------------------------------------------------------------------------------
| VUEX modules/users.js
|-------------------------------------------------------------------------------
| The Vuex data store for the Tags
*/

import TagAPI from '../api/tags';

/**
 status = 0 -> 数据尚未加载
 status = 1 -> 数据开始加载
 status = 2 -> 数据加载成功
 status = 3 -> 数据加载失败
 */

export const tags = {
    state: {
        //分类
        Tags: [],
        TagsLoadStatus:0,
    },
    actions:{
        loadTags({commit},data){
            commit('setTagsLoadStatus',1);
            TagAPI.getTags(data.id)
                .then(function (response) {
                    commit('setTags', response.data.data);
                    commit('setTagsLoadStatus', 2);
                })
                .catch(function (error){
                    commit('setTagsLoadStatus', 3);
                });
        }
    },
    mutations:{
        setTagsLoadStatus(state,status){
            state.TagsLoadStatus = status;
        },
        setTags(state,Tags){
            state.Tags = Tags;
        }
    },
    getters:{
        getTags(state){
            return state.Tags;
        },
        getTagsLoadStatus(state){
            return state.TagsLoadStatus;
        }
    }
};