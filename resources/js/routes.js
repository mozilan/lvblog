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
            redirect: {name: '首页'},
            name: 'LvBlog',
            components: Vue.component( 'Layout', require( './pages/Layout.vue' ) ),
            children: [
                {
                    path: 'index',
                    name: '首页',
                    components: Vue.component( 'Index', require( './pages/Index.vue' ) ),
                    children: [
                        {
                            path: 'comment/:comment',
                            name: '热门评论',
                            components: Vue.component( 'Index-Comment', require( './pages/Index.vue' ) )
                        },
                        {
                            path: 'category/:category',
                            name: '热门分类',
                            components: Vue.component( 'Index-Category', require( './pages/Index.vue' ) )
                        }
                    ]
                },
                {
                    path: 'edit',
                    name: '写作',
                    components: Vue.component( 'Edit', require( './pages/Edit' ) ),
                    beforeEnter: requireAuth
                },
                {
                    path: 'blog',
                    name: '文章',
                    components: Vue.component( 'Blog', require( './pages/Blog' ) ),
                    children: [
                        {
                            path: 'user/:user',
                            name: '用户文章',
                            components: Vue.component( 'Blog-User', require( './pages/Blog' ) )
                        },
                        {
                            path: 'tag/:tag',
                            name: '标签文章',
                            components: Vue.component( 'Blog-Tag', require( './pages/Blog' ) )
                        },
                        {
                            path: 'category/:category',
                            name: '分类文章',
                            components: Vue.component( 'Blog-Category', require( './pages/Blog' ) )
                        }
                    ]
                },
                {
                    path: 'art/:art_id',
                    name: '查看文章',
                    components: Vue.component( 'Article', require( './pages/Art' ) ),
                },
                {
                    path: 'archive/:user',
                    name: '归档',
                    components: Vue.component( 'Archive', require( './pages/Archive' ) ),
                },
                {
                    path: 'home/:user',
                    name: '主页',
                    components: Vue.component( 'Home', require( './pages/Home' ) ),
                },
                {
                    path: 'about',
                    name: '关于我',
                    components: Vue.component( 'About', require( './pages/About' ) ),
                },
            ]
        },
    ]
});
