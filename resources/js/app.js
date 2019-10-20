window._ = require('lodash');
//
// try {
//     window.$ = window.jQuery = require('jquery');
// } catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */
// 添加请求拦截器，在请求头中加token
axios.interceptors.request.use(
    config => {
        if (localStorage.getItem('Authorization')) {
            config.headers.Authorization = localStorage.getItem('Authorization');
        }
        return config;
    },
    error => {
        return Promise.reject(error);
    });
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
import $ from 'jquery'
window.$ = $;
window.jQuery = $;

import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import router from './routes.js'
import store from './store.js'
import hljs from 'highlight.js'

// http响应拦截器
axios.interceptors.response.use((response) => {
    console.log(response);
    var token = response.headers.authorization;
    if (token) {
        store.dispatch('refreshToken',{
            token:token
        });
    }
    return response;
}, (error) => {
    switch (error.response.status) {

        // 如果响应中的 http code 为 401，那么则此用户可能 token 失效了之类的，我会触发 logout 方法，清除本地的数据并将用户重定向至登录页面
        case 401:
            return store.dispatch('logout');
            break;
        // 如果响应中的 http code 为 400，那么就弹出一条错误提示给用户
        case 400:
            return this.$message.error(error.response.data.error);
            break;
    }
    return Promise.reject(error);
});
//封装成一个指令
Vue.directive('highlight', (el) => {
    let blocks = el.querySelectorAll('pre code');
    blocks.forEach((block) => {
        hljs.highlightBlock(block)
    })
});
Vue.use(ElementUI);

const app = new Vue({
    router,
    store,
    created() {
        // 自定义的 axios 响应拦截器
        axios.interceptors.response.use((response) => {
            // 判断一下响应中是否有 token，如果有就直接使用此 token 替换掉本地的 token。你可以根据你的业务需求自己编写更新 token 的逻辑
            var token = response.headers.Authorization;
            if (token) {
                // 如果 header 中存在 token，那么触发 refreshToken 方法，替换本地的 token
                this.$store.dispatch('refreshToken', token)
            }
            return response
        }, (error) => {
            switch (error.response.status) {

                // 如果响应中的 http code 为 401，那么则此用户可能 token 失效了之类的，我会触发 logout 方法，清除本地的数据并将用户重定向至登录页面
                case 401:
                    return this.$store.dispatch('logout');
                    break;
                // 如果响应中的 http code 为 400，那么就弹出一条错误提示给用户
                case 400:
                    return this.$message.error(error.response.data.error);
                    break;
            }
            return Promise.reject(error)
        })
    }
}).$mount('#app');

