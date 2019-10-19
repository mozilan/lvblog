/*
|-------------------------------------------------------------------------------
| VUEX modules/comments.js
|-------------------------------------------------------------------------------
| The Vuex data store for the Comments
*/

import CommentsAPI from '../api/comments';

/**
 status = 0 -> 数据尚未加载
 status = 1 -> 数据开始加载
 status = 2 -> 数据加载成功
 status = 3 -> 数据加载失败
 */

export const comments = {
    state: {
        //初始化评论信息
            comments:
                [
                    {
                        id:'',
                        article_id:'',
                        type:'',
                        fromId:'',
                        fromName:'',
                        fromAvatar:'',
                        likeNum:'',
                        contents:'',
                        date:'',
                        reply:{
                            data:[

                            ]
                        }
                    }
                ],
        commentsLoadStatus:0,
        commentPostStatus:0,
        commentDeleteStatus:0,
        replyPostStatus:0,
        replyDeleteStatus:0,
        commentLikeStatus:0,
    },
    actions:{
        loadComments({commit},data){
            commit('setCommentsLoadStatus',1);
            CommentsAPI.getComments(data)
                .then(function (response) {
                    commit('setComments', response.data);
                    commit('setCommentsLoadStatus', 2);
                })
                .catch(function (error){
                    commit('setCommentsLoadStatus', 3);
                });
        },
        postComment({commit,dispatch},data){
            commit('setCommentPostStatus',1);
            CommentsAPI.postComment(data)
                .then(function (response) {
                    dispatch('loadComments',{
                        art_id:data.art_id,
                    });
                    commit('setCommentPostStatus', 2);
                })
                .catch(function (error){
                    commit('setCommentPostStatus', 3);
                });
        },
        postReply({commit,dispatch},data){
            commit('setReplyPostStatus',1);
            CommentsAPI.postReply(data)
                .then(function (response) {
                    dispatch('loadComments',{
                        art_id:data.art_id,
                    });
                    commit('setReplyPostStatus', 2);
                })
                .catch(function (error){
                    commit('setReplyPostStatus', 3);
                });
        },
        likeComment({commit},data){
            commit('setCommentLikeStatus',1);
            CommentsAPI.patchLikeComment(data)
                .then(function (response) {
                    commit('setCommentLikeStatus', 2);
                })
                .catch(function (error){
                    commit('setCommentLikeStatus', 3);
                });
        },
        deleteReply({commit,dispatch},data){
            commit('setReplyDeleteStatus',1);
            CommentsAPI.deleteReply(data)
                .then(function (response) {
                    dispatch('loadComments',{
                        art_id:data.art_id,
                    });
                    commit('setReplyDeleteStatus', 2);
                })
                .catch(function (error){
                    commit('setReplyDeleteStatus', 3);
                });
        },
        deleteComment({commit,dispatch},data){
            commit('setCommentDeleteStatus',1);
            CommentsAPI.deleteComment(data)
                .then(function (response) {
                    dispatch('loadComments',{
                        art_id:data.art_id,
                    });
                    commit('setCommentDeleteStatus', 2);
                })
                .catch(function (error){
                    commit('setCommentDeleteStatus', 3);
                });
        },
    },
    mutations:{
        setCommentsLoadStatus(state,status){
            state.commentsLoadStatus = status;
        },
        setComments(state,Comments){
            state.comments = Comments;
        },
        setCommentPostStatus(state,status){
            state.commentPostStatus = status;
        },
        setReplyPostStatus(state,status){
            state.replyPostStatus = status;
        },
        setReplyDeleteStatus(state,status){

            state.replyDeleteStatus = status;

        },
        setCommentDeleteStatus(state,status){

            state.commentDeleteStatus = status;

        },
        setCommentLikeStatus(state,status){

            state.commentLikeStatus = status;

        },
    }
    ,
    getters:{
        getComments(state){
            return state.comments;
        },
        getCommentsLoadStatus(state){
            return function () {
                return state.commentsLoadStatus;
            }
        },
        getCommentPostStatus(state){
            return function () {
                return state.commentPostStatus;
            }
        },
        getReplyPostStatus(state){
            return function () {
                return state.replyPostStatus;
            }
        },
        getReplyDeleteStatus(state){
            return function () {
                return state.replyDeleteStatus;
            }
        },
        getCommentDeleteStatus(state){
            return function () {
                return state.commentDeleteStatus
            }
        },
        getCommentLikeStatus(state){
            return function () {
                return state.commentLikeStatus;
            }
        },

    }
};