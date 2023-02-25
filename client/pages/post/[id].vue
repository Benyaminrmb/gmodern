<script lang="ts" setup>
import {useGetPost} from '~/composables/post/useGetPosts'
import StickyNav from '~/components/post/sticky-nav.vue'

const route = useRoute()
const post_id = route.params.id
let posts = await useGetPost(post_id)
const post = posts.data.post
useSeoMeta({
  title: post.title,
  "og:title": post.title,
  description: post.text,
  "og:description": post.text,
  "og:image": post.image.large,
})
</script>
<template>
  <div class="grid grid-cols-12 w-full gap-3">
    <div class="flex flex-wrap col-span-3"></div>
    <div class="flex flex-wrap col-span-12 md:col-span-6 p-4 gap-6">
      <div class="flex flex-wrap w-full">
          <sticky-nav class="rounded-t-md" :post="post" />
        <div
          class="flex col-span-3 w-full bg-white flex flex-wrap border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

          <div class="leading-8 flex flex-wrap gap-3 text-justify">
            <img class="w-full" :src="post.image.large" :alt="post.title" />
            <div class="flex w-full flex-wrap gap-3">
              <post-category-item :categories="post.categories" />
            </div>

            <div class="flex flex-wrap w-full">
              <h1>{{ post.title }}</h1>
            </div>
            <div
              class="leading-8 p-4 post-body text-justify"
              v-html="post.html"></div>
          </div>
          <div class="flex flex-wrap p-4 justify-center items-center w-full">
            
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-wrap col-span-3"></div>
  </div>
</template>
