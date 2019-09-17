
const state = {
    peopleNum: null,
    seatType: null,
    tobaccoType: null,
    tellNum: null,
}

const mutations = {
    PEOPLE_NUM: (state, peopleNum) => {
        state.peopleNum = peopleNum
    },    
    SEAT_TYPE: (state, seatType) => {
        state.seatType = seatType
    },    
    TOBACCO_TYPE: (state, tobaccoType) => {
        state.tobaccoType = tobaccoType
    },    
    TELL_NUM: (state, tellNum) => {
        state.tellNum = tellNum
    },    
  
}

const actions = {
    inputPeopleNum({ commit }, { peopleNum }) {
        commit('PEOPLE_NUM', peopleNum)
    },
    inputSeatType({ commit }, { seatType }) {
        commit('SEAT_TYPE', seatType)
    },
    inputTobaccoType({ commit }, { tobaccoType }) {
        commit('TOBACCO_TYPE', tobaccoType)
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
