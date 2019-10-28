/*
|-------------------------------------------------------------------------------
| VUEX modules/users.js
|-------------------------------------------------------------------------------
| The Vuex data store for the Categories
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
        categoriesAddStatus:0,
        categoriesAddResponseMessages:'',
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
            commit('setCategoriesAddStatus', 1);
            CategoryAPI.postCategories(data.name)
                .then(function (response) {
                    commit('setCategoriesAddStatus', 2);
                    commit('setCategories', response.data.data);
                })
                .catch(function (error){
                    commit('setCategoriesAddStatus', 3);
                    commit('setCategoriesAddResponseMessages', error.response.data.message);
                });
        },
        initCategoryAddStatus({commit}){
            commit('setCategoriesAddStatus', 0);
            commit('setCategoriesAddResponseMessages', '');
        }
    },
    mutations:{
        setCategoriesLoadStatus(state,status){
            state.categoriesLoadStatus = status;
        },
        setCategories(state,categories){
            state.categories = categories;
        },
        setCategoriesAddStatus(state,status){
            state.categoriesAddStatus = status;
        },
        setCategoriesAddResponseMessages(state,messages){
            state.categoriesAddResponseMessages = messages;
        },
    },
    getters:{
        getCategories(state){
            return state.categories;
        },
        getCategoriesLoadStatus(state){
            return state.categoriesLoadStatus;
        },
        getCategoriesAddStatus(state){
            return function() {
                return state.categoriesAddStatus;
            }
        },
        getCategoriesAddResponseMessages(state){
            return function() {
                return state.categoriesAddResponseMessages;
            }
        }
    }
};