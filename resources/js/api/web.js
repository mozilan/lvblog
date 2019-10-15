/**
 * Imports the LvBlog API URL from the config.
 */
import { LVBLOG_CONFIG } from '../config.js';

export default {
    getConfigs: function(){
        return axios.get(LVBLOG_CONFIG.API_URL + '/web/configs');
    },
    getFriends: function () {
        return axios.get(LVBLOG_CONFIG.API_URL + '/web/friends');
    }
}