<script lang="ts" setup>
import {useAuth} from '~/stores/auth'

const use_auth = useAuth()
const logOut = async () => {
  await use_auth.emptyUser()
}
const colorMode = useColorMode()
const theme_name = ref('theme_name')
theme_name.value = false
colorMode.preference = 'dark'
const changeTheme = () => {
  if (!theme_name.value) {
    return (colorMode.preference = 'light')
  }
  return (colorMode.preference = 'dark')
}
</script>
<template>
  <div
    class="navbar z-50 shadow border-b border-base-300 backdrop-blur-xl sticky top-0 gap-7 bg-base-100/90">
    <div class="flex">
      <nuxt-link to="/" class="btn btn-ghost normal-case text-xl"
        >Gmodern</nuxt-link
      >
    </div>
      <slot/>
    <div class="flex flex-wrpa w-full justify-between">
      <div class="flex navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal p-0">
          <li v-if="!use_auth.user.id">
            <nuxt-link to="/login"> login </nuxt-link>
          </li>

          <li class="rounded-md">
            <nuxt-link to="/admin">admin</nuxt-link>
          </li>
        </ul>
      </div>

      <div class="flex gap-3">
        <div class="flex flex-wrap">
          <label class="swap swap-rotate">
            <input
              v-model="theme_name"
              checked
              @click="changeTheme"
              class="hidden"
              type="checkbox" />
            <svg
              class="swap-on fill-current w-10 h-10"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24">
              <path
                d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
            </svg>
            <svg
              class="swap-off fill-current w-10 h-10"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24">
              <path
                d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
            </svg>
          </label>
        </div>
        <div class="flex flex-wrap">
          <div v-if="use_auth.user.id" class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
              <div class="w-10 rounded-full">
                <img src="https://placeimg.com/80/80/people" />
              </div>
            </label>
            <ul
              tabindex="0"
              class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
              <li v-if="use_auth.user.is_admin">
                <nuxt-link to="/admin"> داشبورد </nuxt-link>
              </li>
              <li></li>
              <li>
                <a @click="logOut"> خروج </a>
              </li>
            </ul>
          </div>
          <nuxt-link v-else to="/login" class="btn btn-ghost btn-circle">
            <div
              class="w-10 justify-center flex flex-wrap items-center rounded-full">
              <svg
                class="w-5 h-5 fill-current"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512">
                <!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path
                  d="M256 288c79.53 0 144-64.47 144-144s-64.47-144-144-144c-79.52 0-144 64.47-144 144S176.5 288 256 288zM351.1 320H160c-88.36 0-160 71.63-160 160c0 17.67 14.33 32 31.1 32H480c17.67 0 31.1-14.33 31.1-32C512 391.6 440.4 320 351.1 320z" />
              </svg>
            </div>
          </nuxt-link>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
.router-link-active {
  @apply bg-base-200 !important;
}
</style>
