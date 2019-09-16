/**
 * Imports the LvBlog API URL from the config.
 */
import { LVBLOG_CONFIG } from '../config.js';

export default {
    upLoadImages: function(data){
        return axios.post(LVBLOG_CONFIG.API_URL + '/images',data);
    }
}