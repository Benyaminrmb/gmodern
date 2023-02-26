import {defineStore} from 'pinia'



const state = () => ({
    posts: []
})
const getters={}
const actions = {
    setPost(data:any) {
        console.log('set data',data)
        this.posts = data
    },
    pushPosts(data) {
        console.log('push data',data)
        this.posts.push(data)
    },
}

export const useAdminPosts = defineStore('useAdminPosts', {
    state,
    getters,
    actions
})
