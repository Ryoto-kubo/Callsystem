
const state = {
  prevState: null,
  nextStepId: 1,
  prevStepId: null,
}

const mutations = {
  PREV_FORM: (state, prevState) => {
      state.prevState = prevState
  },    
  NEXT_STEP: (state, nextStepId) => {
      state.nextStepId = nextStepId
  },
  PREV_STEP: (state, prevStepId) => {
      state.prevStepId = prevStepId
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
  prevStep({ commit }, { currentId }) {
      let prevStepId = --currentId
      commit('PREV_STEP', prevStepId)
  },
  
}

export default {
  namespaced: true,
  state,
  mutations,
  actions
}
