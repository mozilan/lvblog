/**
 * Defines the API route we are using.
 */
var url = '';
var api_url = '';

switch( process.env.NODE_ENV ){
    case 'development':
        url = 'http://www.mozilan.com';
        api_url = 'http://www.mozilan.com/api';
        break;
    case 'production':
        url = 'http://www.mozilan.com';
        api_url = 'http://www.mozilan.com/api';
        break;
}
var ValineAppID='vEWC8aDW7kv3G3fW021C6LII-gzGzoHsz';
var ValineAppKey='mgzfz3n69093F8zHv6Q8EySf';
export const LVBLOG_CONFIG = {
    URL:url,
    API_URL: api_url,
};