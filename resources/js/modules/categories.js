/*
|-------------------------------------------------------------------------------
| VUEX modules/users.js
|-------------------------------------------------------------------------------
| The Vuex data store for the categories
*/

import CategoryAPI from '../api/categories';

/**
 status = 0 -> 数据尚未加载
 status = 1 -> 数据开始加载
 status = 2 -> 数据加载成功
 status = 3 -> 数据加载失败
 */

export const categories = {
    state: {
        //分类
        categories: [],
        categoriesLoadStatus:0,
    },
    actions:{
        loadCategories({commit},data){
            commit('setCategoriesLoadStatus',1);
            CategoryAPI.getCategories(data.id)
                .then(function (response) {
                    commit('setCategories', response.data.data);
                    commit('setCategoriesLoadStatus', 2);
                })
                .catch(function (error){
                     commit('setCategoriesLoadStatus', 3);
                });
        },
        addCategories({commit,dispatch},data){
            CategoryAPI.postCategories(data.name)
                .then(function (response) {
                    commit('setCategories', response.data.data);
                })
                .catch(function (error){

                });
        }
    },
    mutations:{
        setCategoriesLoadStatus(state,status){
            state.categoriesLoadStatus = status;
        },
        setCategories(state,categories){
            state.categories = categories;
        }
    },
    getters:{
        getCategories(state){
            return state.categories;
        },
        getCategoriesLoadStatus(state){
            return state.categoriesLoadStatus;
        }
    }
};