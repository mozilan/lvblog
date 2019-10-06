/*
 |-------------------------------------------------------------------------------
 | routes.js
 |-------------------------------------------------------------------------------
 | Contains all of the routes for the application
 */

/**
 * Imports Vue and VueRouter to extend with the routes.
 */
import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store.js';
function requireAuth(to, from, next) {

        function proceed() {
        // 如果用户信息已经加载并且不为空则说明该用户已登录，可以继续访问路由，否则跳转到首页
        // 这个功能类似 Laravel 中的 auth 中间件
        if (store.getters.getUserLoadStatus() === 2 && store.getters.getUser !== '') {
                next();
            } else {
                next('/blog/?login=1');
            }
        }
        let token = localStorage.getItem('Authorization');

        if (token === 'null' || token === '') {
            proceed()
        }else {
            if(store.getters.getUserLoadStatus() === 0){
                store.dispatch('loadUser');
                // 监听用户信息加载状态，加载完成后调用 proceed 方法继续后续操作
                store.watch(store.getters.getUserLoadStatus, function () {
                    if(store.getters.getUserLoadStatus() !== 1){
                        proceed();
                    }
                });
            }else{
                proceed();
            }
    }
}
/**
 * Extends Vue to use Vue Router
 */
Vue.use( VueRouter );
/**
 * Makes a new VueRouter that we will use to run all of the routes for the app.
 */

export default new VueRouter({
    routes: [
        {
            path: '/',
            redirect: {name: 'index'},
            name: 'layout',
            components: Vue.component( 'Layout', require( './pages/Layout.vue' ) ),
            children: [
                {
                    path: 'index',
                    redirect: {name: 'blog'},
                    name: 'index',
                    components: Vue.component( 'Index', require( './pages/Index.vue' ) )
                },
                {
                    path: 'edit',
                    name: 'edit',
                    components: Vue.component( 'Edit', require( './pages/Edit' ) ),
                    beforeEnter: requireAuth
                },
                {
                    path: 'blog',
                    name: 'blog',
                    components: Vue.component( 'Home', require( './pages/Blog' ) ),
                },
                {
                    path: 'art/:art_id',
                    name: 'art',
                    components: Vue.component( 'Article', require( './pages/Art' ) ),
                },
                {
                    path: 'archive/:user',
                    name: 'archive',
                    components: Vue.component( 'Archive', require( './pages/Archive' ) ),
                },
                {
                    path: 'home',
                    name: 'home',
                    components: Vue.component( 'Home', require( './pages/Home' ) ),
                },
                {
                    path: 'about',
                    name: 'about',
                    components: Vue.component( 'About', require( './pages/About' ) ),
                },
            ]
        },
    ]
});
