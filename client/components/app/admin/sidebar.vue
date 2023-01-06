<script setup lang="ts">
const sidebar_items = [
  {
    name: 'ادمین',
    items: [
      {
        name: 'داشبورد',
        link: '/admin',
      },
    ],
  },
  {
    name: 'کاربران',
    items: [
      {
        name: 'لیست کاربران',
        link: '/admin/user',
      },
    ],
  },
  {
    name: 'مقالات',
    items: [
      {
        name: 'لیست مقالات',
        link: '/admin/post',
      },
    ],
  },
]
</script>
<template>
  <div
    class="drawer-side"
    style="scroll-behavior: smooth; scroll-padding-top: 5rem">
    <label for="drawer" class="drawer-overlay"></label>
    <aside class="bg-base-200 w-80">
      <div
        class="z-20 bg-base-200 bg-opacity-90 backdrop-blur sticky top-0 items-center gap-2 px-4 py-2 hidden lg:flex">
        <nuxt-link
          to="/"
          aria-current="page"
          aria-label="Homepage"
          class="flex-0 btn btn-ghost px-2">
          <div
            class="font-title flex-row-reverse text-primary inline-flex text-lg transition-all duration-200 md:text-3xl">
            <span class="uppercase">g</span>
            <span class="text-base-content lowercase">modern</span>
          </div></nuxt-link
        >
      </div>
      <div class="h-4"></div>
      <ul class="menu menu-compact flex flex-col p-0 px-4">
        <template v-for="(menu, index) in sidebar_items">
          <li v-if="index"></li>
          <li class="menu-title">
            <span>{{ menu.name }}</span>
          </li>

          <li v-for="item in menu.items">
            <nuxt-link :to="item.link" class="flex gap-4">
              <span class="flex-none"
                ><svg
                  width="24"
                  height="24"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  class="w-6 h-6 stroke-current">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg
              ></span>
              <span class="flex-1">{{ item.name }}</span>
            </nuxt-link>
          </li>
        </template>

      </ul>
      <div
        class="from-base-200 pointer-events-none sticky bottom-0 flex h-20 bg-gradient-to-t to-transparent"></div>
    </aside>
  </div>
</template>
<style scoped>
.router-link-active {
    @apply bg-primary !important;
}
</style>
