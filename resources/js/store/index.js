import Vue from 'vue'
import Vuex from 'vuex'
import getters from './getters'
import app from './modules/app'
import status from './modules/status'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    app,
    status,
  },
  getters
})

export default store
