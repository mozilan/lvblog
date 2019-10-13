/**
 * Imports the LvBlog API URL from the config.
 */
import { LVBLOG_CONFIG } from '../config.js';

export default {
    getArticles: function(page){
        return axios.get(LVBLOG_CONFIG.API_URL + '/articles'+'?include=user,category&&page='+page ,{

        });
    },
    getUserArticles: function(user,page){

        return axios.get(LVBLOG_CONFIG.API_URL + '/users/'+user+'/articles'+'?include=user,category&&page='+page ,{

        });
    },
    getUserTagArticles: function(tag,page){
        return axios.get(LVBLOG_CONFIG.API_URL + '/tags/'+tag+'/articles'+'?include=user,category&&page='+page ,{

        });
    },
    getUserCategoryArticles: function(category,page){

        return axios.get(LVBLOG_CONFIG.API_URL + '/categories/'+category+'/articles'+'?include=user,category&&page='+page ,{

        });
    },
    getArticle: function(art_id){
        return axios.get(LVBLOG_CONFIG.API_URL + '/articles/'+art_id+'?include=user',{

        });
    },
    postArticle: function(title,body,tags,category_id,excerpt,target){
        return axios.post(LVBLOG_CONFIG.API_URL + '/articles',{
            title:title,
            body:body,
            tags:tags,
            category_id:category_id,
            excerpt:excerpt,
            target:target,
        });
    },
    patchArticle: function(data){
        return axios.patch(LVBLOG_CONFIG.API_URL + '/articles/'+data.id,{
            title:data.title,
            body:data.body,
            tags:data.tags,
            category_id:data.category_id,
            excerpt:data.excerpt,
            target:data.target,
        });
    },
    deleteArticle: function(data){
        return axios.delete(LVBLOG_CONFIG.API_URL + '/articles/'+data.id);
    }

}