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
        articles: '',
        articlesLoadStatus:0,
        article: '',
        articleLoadStatus:0,
        articleAddStatus:0,
        articleAddResponseMessages:'',
        articleUpdateStatus:0,
        articleUpdateResponseMessages:'',
        articleDeleteStatus:0,
    },
    actions:{
        loadArticles({commit,state},data ){
            commit('setArticlesLoadStatus',1);
            if(data.user === ''){
                ArticleAPI.getArticles(data.page !== '' ? data.page : 1)
                    .then(function (response) {
                        if(state.articles.data !== undefined){
                            var merge_data = state.articles.data.concat(response.data.data);
                            response.data.data = merge_data;
                            commit('setArticles',response.data);
                        }
                        commit('setArticles',response.data);
                        commit('setArticlesLoadStatus', 2);
                    })
                    .catch(function (error){
                        commit('setArticlesLoadStatus', 3);
                    });
            }else{
                ArticleAPI.getUserArticles(data.user,data.page !== '' ? data.page : 1)
                    .then(function (response) {
                        if(state.articles.data !== undefined){
                            var merge_data = state.articles.data.concat(response.data.data);
                            response.data.data = merge_data;
                            commit('setArticles',response.data);
                        }
                        commit('setArticles',response.data);
                        commit('setArticlesLoadStatus', 2);
                    })
                    .catch(function (error){
                        commit('setArticlesLoadStatus', 3);
                    });
            }
        },
        loadUserTagArticles({commit,state},data){
            commit('setArticleLoadStatus',1);
            ArticleAPI.getUserTagArticles(data.tag,data.page)
                .then(function (response) {
                    if(state.articles.data !== undefined){
                        var merge_data = state.articles.data.concat(response.data.data);
                        response.data.data = merge_data;
                        commit('setArticles',response.data);
                    }
                    commit('setArticles',response.data);
                    commit('setArticlesLoadStatus', 2);
                })
                .catch(function (error){
                    commit('setArticleLoadStatus', 3);
            });
        },
        loadUserCategoryArticles({commit,state},data){
            commit('setArticleLoadStatus',1);
            ArticleAPI.getUserCategoryArticles(data.category,data.page)
                .then(function (response) {
                    if(state.articles.data !== undefined){
                        var merge_data = state.articles.data.concat(response.data.data);
                        response.data.data = merge_data;
                        commit('setArticles',response.data);
                    }
                    commit('setArticles',response.data);
                    commit('setArticlesLoadStatus', 2);
                })
                .catch(function (error){
                    commit('setArticleLoadStatus', 3);
            });
        },
        addArticle({commit,dispatch},data){
            commit('setArticleAddStatus', 1);
            ArticleAPI.postArticle(data.title,data.body,data.tags,data.category_id,data.excerpt,data.target)
                .then(function (response) {
                    commit('setArticleAddStatus', 2);
                })
                .catch(function (error){
                    commit('setArticleAddStatus', 3);
                    console.log(error.response.data.errors[Object.keys(error.response.data.errors)[0]].toString());
                    commit('setArticleAddResponseMessages', error.response.data.errors[Object.keys(error.response.data.errors)[0]].toString() === '' ? "发布失败，可能是因为登陆超时造成的." : error.response.data.errors[Object.keys(error.response.data.errors)[0]].toString());
                });
        },
        updateArticle({commit},data){
            commit('setArticleUpdateStatus', 1);
            ArticleAPI.patchArticle(data)
                .then(function (response) {
                    commit('setArticleUpdateStatus', 2);
                })
                .catch(function (error){
                    commit('setArticleUpdateStatus', 3);
                    console.log(error.response.data.errors[Object.keys(error.response.data.errors)[0]].toString());
                    commit('setArticleUpdateResponseMessages', error.response.data.errors[Object.keys(error.response.data.errors)[0]].toString() === '' ? "发布失败，可能是因为登陆超时造成的." : error.response.data.errors[Object.keys(error.response.data.errors)[0]].toString());
                });
        },
        deleteArticle({commit},data){
            commit('setArticleDeleteStatus', 1);
            ArticleAPI.deleteArticle(data)
                .then(function (response) {
                    commit('setArticleDeleteStatus', 2);
                })
                .catch(function (error){
                    commit('setArticleDeleteStatus', 3);
                });
        },
        initArticleAddStatus({commit}){
            commit('setArticleAddStatus', 0);
            commit('setArticleAddResponseMessages', '');
        },
        initArticleUpdateStatus({commit}){
            commit('setArticleUpdateStatus', 0);
            commit('setArticleUpdateResponseMessages', '');
        },
        loadArticle({commit},data){
            commit('setArticleLoadStatus',1);
            ArticleAPI.getArticle(data.art_id)
                .then(function (response) {
                    commit('setArticle',response.data);
                    commit('setArticleLoadStatus', 2);
                })
                .catch(function (error){
                    commit('setArticleLoadStatus', 3);
                });
        },
        clearArticles({commit}){
            commit('setArticles','');
            commit('setArticlesLoadStatus', 0);
        },
    },
    mutations:{
        setArticlesLoadStatus(state,status){
            state.articlesLoadStatus = status;
        },
        setArticles(state,articles){
            state.articles = articles;
        },
        setArticleLoadStatus(state,status){
            state.articleLoadStatus = status;
        },
        setArticle(state,article){
            state.article = article;
        },
        setArticleAddStatus(state,status){
            state.articleAddStatus = status;
        },
        setArticleAddResponseMessages(state,messages){
            state.articlesAddResponseMessages = messages;
        },
        setArticleUpdateStatus(state,status){
            state.articleUpdateStatus = status;
        },
        setArticleDeleteStatus(state,status){
            state.articleDeleteStatus = status;
        },
        setArticleUpdateResponseMessages(state,messages){
            state.articlesUpdateResponseMessages = messages;
        },
    },
    getters:{
        getArticles(state){
            return state.articles;
        },
        getArticlesLoadStatus(state){
            return function(){
                return state.articlesLoadStatus;
            }
        },
        getArticle(state){
            return state.article;
        },
        getArticleLoadStatus(state){
            return function(){
                return state.articleLoadStatus;
            }
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
        } ,
        getArticleUpdateStatus(state){
            return function() {
                return state.articleUpdateStatus;
            }
        },
        getArticleDeleteStatus(state){
            return function(){
                return state.articleDeleteStatus;
            }
        },
        getArticleUpdateResponseMessages(state){
            return function() {
                return state.articlesUpdateResponseMessages;
            }
        }
    }
};