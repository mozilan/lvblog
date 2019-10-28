/*
 |-------------------------------------------------------------------------------
 | VUEX store.js
 |-------------------------------------------------------------------------------
 | Builds the data store from all of the modules for the LvBlog app.
 */

/**
 * Adds the promise polyfill for IE 11
 */
require('es6-promise').polyfill();

/**
 * Import Vue and Vuex
 */
import Vue from 'vue'
import Vuex from 'vuex'

/**
 * Initializes Vuex on Vue.
 */
Vue.use( Vuex );
import { users } from './modules/users'
import { categories } from './modules/categories'
import { tags } from './modules/tags'
import { images } from './modules/images'
import { articles } from './modules/articles'
import { archives } from './modules/archieves'
import { web } from './modules/web'
import { common } from './modules/common'
import { comments } from './modules/comments'
/**
 * Export our data store.
 */
export default new Vuex.Store({
    modules: {
        users,
        categories,
        tags,
        images,
        articles,
        archives,
        web,
        common,
        comments
    }
});