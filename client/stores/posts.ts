import {defineStore} from 'pinia'

export interface IndexData {

  data: aa|Object

}
export interface aa {

    indexPosts:Object,
    bannerPosts:Object,
}

const state = () => ({
    data: []
})
const getters={}
const actions = {
    setIndexPosts(data) {
        this.data = data
    },
}

export const usePosts = defineStore('posts', {
    state,
    getters,
    actions
})
