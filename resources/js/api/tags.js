/**
 * Imports the LvBlog API URL from the config.
 */
import { LVBLOG_CONFIG } from '../config.js';

export default {
    getTags: function(user_id){
        return axios.get(LVBLOG_CONFIG.API_URL + '/tags/'+ user_id);
    }
}