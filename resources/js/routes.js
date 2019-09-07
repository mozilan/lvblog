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
                    name: 'index',
                    components: Vue.component( 'Index', require( './pages/Index.vue' ) )
                },
            ]
        }
    ]
});