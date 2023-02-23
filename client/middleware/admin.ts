import {useAuth} from "~/stores/auth";

// @ts-ignore
export default defineNuxtRouteMiddleware(async (to, from,nuxtApp ) => {
    const use_auth:any = useAuth()
    // @ts-ignore
    console.log('use_auth.user.is_admin',use_auth.user.is_admin)
    if(!use_auth.user.is_admin){
        return navigateTo('/')
    }
 })
