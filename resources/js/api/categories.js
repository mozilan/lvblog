/**
 * Imports the LvBlog API URL from the config.
 */
import { LVBLOG_CONFIG } from '../config.js';

export default {
    getCategories: function(user_id){
        return axios.get(LVBLOG_CONFIG.API_URL + '/categories/'+ user_id)
    }
}