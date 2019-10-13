/**
 * Imports the LvBlog API URL from the config.
 */
import { LVBLOG_CONFIG } from '../config.js';

export default {
    getArchives: function(user){
        return axios.get(LVBLOG_CONFIG.API_URL + '/archives/'+ user+'?include=user',{

        });
    },
}