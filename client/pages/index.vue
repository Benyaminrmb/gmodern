<script lang="ts" setup>
import {usePosts} from '~/stores/posts'

import {useGetIndexPosts} from '~/composables/useGetIndexPosts'
// import Swiper core and required modules
import {Pagination, Autoplay} from 'swiper'

// Import Swiper Vue.js components
import {Swiper, SwiperSlide} from 'swiper/vue'

// Import Swiper styles
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'
import 'swiper/css/scrollbar'
import 'swiper/css/autoplay'
import {useGetPosts} from '~/composables/admin/post/useGetPosts'

const route = useRoute()
const router = useRouter()
const nuxtApp = useNuxtApp()

let page = ref(route.query.page ? route.query.page : 1)
let posts_loading = ref(false)

let request_data = await useGetIndexPosts(page.value)

let banner_posts = request_data.data.bannerPosts
let main_posts = request_data.data.indexPosts
const changePage = async (new_page: number) => {
  window.scrollTo(0, 0)
  posts_loading.value = true
  if (new_page > 1) {
    router.push({
      query: {page: new_page},
    })
  } else {
    router.push({
      query: null,
    })
  }
  request_data = await useGetIndexPosts(new_page)
  banner_posts = request_data.data.bannerPosts
  main_posts = request_data.data.indexPosts
  posts_loading.value = false
}
posts_loading.value = false
</script>
<template>
  {{ posts_loading }}

  <div class="grid grid-cols-12 w-full gap-3">
    <div class="flex flex-wrap col-span-3"></div>
    <div class="flex flex-wrap col-span-12 md:col-span-6 p-4 gap-6">
      <div class="flex flex-wrap w-full dir-ltr">
        <swiper
          class="rounded-3xl w-full"
          :slides-per-view="1"
          :space-between="50"
          :modules="modules"
          :options="options"
          :loop="true"
          :pagination="{clickable: true, dynamicBullets: true}">
          <swiper-slide
            class="w-full"
            :virtualIndex="index"
            v-for="(post, index) in banner_posts"
            :key="index">
            <nuxt-link :to="`/post/${post.id}`" class="flex w-full flex-wrap">
              <div
                class="flex rounded-3xl bg-origin-content bg-center bg-contain bg-no-repeat bg-sca flex-wrap w-full h-[320px]"
                :style="`background-image:url(${post.image.large})`">
                <div
                  class="absolute items-stretch dir-rtl grid grid-cols-6 w-full h-full bottom-0 right-0 bg-gradient-to-l from-base-100/90 p-3">
                  <div class="flex flex-wrap gap-3 col-span-3">
                    <h2
                      class="flex w-full text-right flex-wrap content-color text-3xl leading-10">
                      {{ post.title }}
                    </h2>
                    <div class="flex w-full flex-wrap">
                      <p class="content-color truncate text-ellipsis">
                        {{ post.text }}
                      </p>
                    </div>
                    <div class="flex self-end w-full flex-wrap">
                      <div
                        class="flex rounded-2xl text-primary-content items-center gap-2 border-1 border-primary/60 bg-primary p-1">
                        <span class="text-xs">
                          {{ post.created_at.shamsi }}
                        </span>
                        <div
                          class="flex rounded-2xl text-primary-content bg-primary-focus p-2 hover:shadow hover:-translate-y-[3px] ease-in transition">
                          <span class="dir-ltr text-sm font-bold">
                            @{{ post.source.source.name }}
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </nuxt-link>
          </swiper-slide>
        </swiper>
      </div>

      <div class="flex flex-wrap w-full px-3">
        <span class="text-3xl font-bold content-color">آخرین اخبار</span>
      </div>

      <div
        v-if="main_posts.data"
        class="grid grid-cols-1 md:grid-cols-2 w-full gap-4">
        <template v-if="posts_loading">
          <post-loading v-for="(i, index) in 20" :item="i" :key="index" />
        </template>
        <template v-else>
          <post-item
            v-for="(post, index) in main_posts.data"
            :item="post"
            :key="index" />
        </template>
      </div>
      <nav class="flex flex-wrap w-full justify-center">
        <ul class="flex flex-wrap items-center -space-x-px">
          <li v-for="page in main_posts.links">
            <button
              v-html="page.label"
              @click="changePage(page.label)"
              :disabled="page.active || !page.url"
              class="px-3 py-2 leading-tight border border-secondary disabled:bg-secondary-focus hover:bg-accent-focus hover:text-gray-700"></button>
          </li>
        </ul>
      </nav>
    </div>
    <div class="flex flex-wrap col-span-3"></div>
  </div>
</template>
<style>
.swiper-pagination-bullet-active {
  @apply bg-primary !important;
}

.swiper-pagination-bullet {
  @apply opacity-100 bg-base-300;
}
</style>
