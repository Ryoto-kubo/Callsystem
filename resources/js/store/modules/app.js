
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
    inputTellNumObject: {
        id: null,
        tellNum: null,
        inputState: true,
    }
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
    TELL_NUM: (state, inputTellNumObject) => {
        state.inputTellNumObject.id         = inputTellNumObject.id
        state.inputTellNumObject.tellNum    = inputTellNumObject.tellNum
        state.inputTellNumObject.inputState = inputTellNumObject.inputState
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
    inputTellNum({ commit }, { inputTellNumObject }) {
        commit('TELL_NUM', inputTellNumObject)
    },
  
}

export default {
    namespaced: true,
    state,
    mutations,
    actions
}
