/**
 * Imports the LvBlog API URL from the config.
 */
import { LVBLOG_CONFIG } from '../config.js';

export default {
    getArticles: function(page){
        return axios.get(LVBLOG_CONFIG.API_URL + '/articles'+'?page='+page ,{

        });
    },
    getArticle: function(id){
        return axios.get(LVBLOG_CONFIG.API_URL + '/articles',{

        });
    },
    postArticle: function(title,body,tags,category_id,target){
        return axios.post(LVBLOG_CONFIG.API_URL + '/articles',{
            title:title,
            body:body,
            tags:tags,
            category_id:category_id,
            target:target,
        });
    }
}