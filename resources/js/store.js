/*
 |-------------------------------------------------------------------------------
 | VUEX store.js
 |-------------------------------------------------------------------------------
 | Builds the data store from all of the modules for the Roast app.
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
/**
 * Export our data store.
 */
export default new Vuex.Store({
    modules: {
        users,
        categories,
        tags
    }
});