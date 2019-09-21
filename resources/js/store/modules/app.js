
const state = {
    inputPeopleObject: {
        id: null,
        peopleNum: null,
    },
    selectSeatOject: {
        id: null,
        selectSeatType: null
    },
    selectTobaccoObject: {
        id: null,
        selectTobaccoType: null,
    },
    tellNum: null,
}

const mutations = {
    PEOPLE_NUM: (state, inputPeopleObject) => {
        state.inputPeopleObject.id        = inputPeopleObject.id
        state.inputPeopleObject.peopleNum = inputPeopleObject.peopleNum
    },    
    SEAT_TYPE: (state, selectSeatOject) => {
        state.selectSeatOject.id             = selectSeatOject.id
        state.selectSeatOject.selectSeatType = selectSeatOject.selectSeatType
    },    
    TOBACCO_TYPE: (state, selectTobaccoObject) => {
        state.selectTobaccoObject.id                = selectTobaccoObject.id
        state.selectTobaccoObject.selectTobaccoType = selectTobaccoObject.selectTobaccoType
    },    
    TELL_NUM: (state, tellNum) => {
        state.tellNum = tellNum
    },    
  
}

const actions = {
    inputPeopleNum({ commit }, { inputPeopleObject }) {
        commit('PEOPLE_NUM', inputPeopleObject)
    },
    inputSeatType({ commit }, { selectSeatOject }) {
        commit('SEAT_TYPE', selectSeatOject)
    },
    inputTobaccoType({ commit }, { selectTobaccoObject }) {
        commit('TOBACCO_TYPE', selectTobaccoObject)
    },
    inputTellNum({ commit }, { tellNum }) {
        commit('TELL_NUM', tellNum)
    },
  
}

export default {
    namespaced: true,
    state,
    mutations,
    actions
}
