
const state = {
  editStatus: {
    id: null,
    editPrev: false
  },
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
  EDIT_STATUS: (state, editStatus) => {
      state.editStatus.id       = editStatus.id
      state.editStatus.editPrev = editStatus.editPrev
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
  editStatus({ commit }, { editStatus }) {
      commit('EDIT_STATUS', editStatus)
  },
}

export default {
  namespaced: true,
  state,
  mutations,
  actions
}
