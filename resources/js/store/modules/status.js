
const state = {
  prevState: false,
  nextStepId: 1,
}

const mutations = {
  PREV_FORM: (state, prevState) => {
      state.prevState = prevState
  },    
  NEXT_STEP: (state, nextStepId) => {
      state.nextStepId = nextStepId
  },    
}

const actions = {
  prevForm({ commit }, { prevState }) {
      commit('PREV_FORM', prevState)
  },

  nextStep({ commit }, { currentId }) {
      let nextStepId = ++currentId
      commit('NEXT_STEP', nextStepId)
  },
  
}

export default {
  namespaced: true,
  state,
  mutations,
  actions
}
