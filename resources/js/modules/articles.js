/*
|-------------------------------------------------------------------------------
| VUEX modules/users.js
|-------------------------------------------------------------------------------
| The Vuex data store for the articles
*/

import ArticleAPI from '../api/articles';

/**
 status = 0 -> 数据尚未加载
 status = 1 -> 数据开始加载
 status = 2 -> 数据加载成功
 status = 3 -> 数据加载失败
 */

export const articles = {
    state: {
        //分类
        articles: [],
        articlesLoadStatus:0,
        article: '',
        articleLoadStatus:0,
        articleAddStatus:0,
        articleAddResponseMessages:'',
    },
    actions:{
        loadarticles({commit},data){
            commit('setarticlesLoadStatus',1);
            ArticleAPI.getarticles(data.id)
                .then(function (response) {
                    commit('setarticles', response.data.data);
                    commit('setarticlesLoadStatus', 2);
                })
                .catch(function (error){
                    commit('setarticlesLoadStatus', 3);
                });
        },
        addArticle({commit,dispatch},data){
            commit('setArticleAddStatus', 1);
            ArticleAPI.postArticle(data.title,data.body,data.tags,data.category_id,data.target)
                .then(function (response) {
                    commit('setArticleAddStatus', 2);
                })
                .catch(function (error){
                    commit('setArticleAddStatus', 3);
                    console.log(error.response.data.errors[Object.keys(error.response.data.errors)[0]].toString());
                    commit('setArticleAddResponseMessages', error.response.data.errors[Object.keys(error.response.data.errors)[0]].toString());
                });
        },
        initArticleAddStatus({commit}){
            commit('setArticleAddStatus', 0);
            commit('setArticleAddResponseMessages', '');
        }
    },
    mutations:{
        setarticlesLoadStatus(state,status){
            state.articlesLoadStatus = status;
        },
        setarticles(state,articles){
            state.articles = articles;
        },
        setArticleAddStatus(state,status){
            state.articleAddStatus = status;
        },
        setArticleAddResponseMessages(state,messages){
            state.articlesAddResponseMessages = messages;
        },
    },
    getters:{
        getArticles(state){
            return state.articles;
        },
        getArticlesLoadStatus(state){
            return state.articlesLoadStatus;
        },
        getArticleAddStatus(state){
            return function() {
                return state.articleAddStatus;
            }
        },
        getArticleAddResponseMessages(state){
            return function() {
                return state.articlesAddResponseMessages;
            }
        }
    }
};