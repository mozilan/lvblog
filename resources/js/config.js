/**
 * Defines the API route we are using.
 */
var api_url = '';

switch( process.env.NODE_ENV ){
    case 'development':
        api_url = 'http://www.mozilan.com/api';
        break;
    case 'production':
        api_url = 'http://www.mozilan.com/api';
        break;
}

export const LVBLOG_CONFIG = {
    API_URL: api_url,
};