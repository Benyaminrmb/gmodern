import {defineStore} from 'pinia'



const state = () => ({
    user: []
})
const getters={}
const actions = {
    setUser(data) {
        this.user = data
    },
    emptyUser() {
        this.user = []
    },
    setToken(data) {
        this.user['token'] = data
    },
}

export const useAuth = defineStore('authenticate', {
    state,
    getters,
    actions
})
