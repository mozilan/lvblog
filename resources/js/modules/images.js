/*
|-------------------------------------------------------------------------------
| VUEX modules/users.js
|-------------------------------------------------------------------------------
| The Vuex data store for the Images
*/

import ImagesAPI from '../api/images';

/**
 status = 0 -> 数据尚未加载
 status = 1 -> 数据开始加载
 status = 2 -> 数据加载成功
 status = 3 -> 数据加载失败
 */

export const images = {
    state: {
        //分类
        Images: [],
        ImagesUpLoadStatus:0,
    },
    actions:{
        upLoadImages({commit},data){
            commit('setImagesUpLoadStatus',1);
            ImagesAPI.upLoadImages(data)
                .then(function (response){
                    commit('setImages', response.data);
                    commit('setImagesUpLoadStatus', 2);
                })
                .catch(function (error){
                    commit('setImagesUpLoadStatus', 3);
                });
        }
    },
    mutations:{
        setImagesUpLoadStatus(state,status){
            state.ImagesUpLoadStatus = status;
        },
        setImages(state,Images){
            state.Images = Images;
        }
    },
    getters:{
        getImages(state){
            return state.Images;
        },
        getImagesUpLoadStatus(state){
            return function() {
                return state.ImagesUpLoadStatus;
            }
        }
    }
};