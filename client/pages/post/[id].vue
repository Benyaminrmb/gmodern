<script lang="ts" setup>
import {useGetPost} from '~/composables/post/useGetPosts'

const route = useRoute()
const post_id = route.params.id
let posts = await useGetPost(post_id)
const post = posts.data.post
function readingTime(text) {
    const wpm = 225
    const words = text.trim().split(/\s+/).length
    return Math.ceil(words / wpm)
}
const timeToRead = readingTime(post.html)
</script>
<template>
  <div class="flex flex-wrap p-4 w-full gap-4">
    <div class="grid grid-cols-2 flex-wrap gap-4">
      <div class="flex flex-wrap w-full items-end content-end gap-4">
        <div class="flex flex-wrap w-full gap-3">
          <span
            v-for="category in post.categories"
            class="text-base font-semibold flex text-sm">
            {{ category.name }}
          </span>
        </div>
        <div class="flex flex-wrap w-full">
          <h1 class="text-2xl font-semibold text-base-content">
            {{ post.title }}
          </h1>
        </div>
        <div class="flex flex-wrap w-full">
          <p class="text-base leading-8 text-base-content">{{ post.text }}</p>
        </div>
      </div>
      <div class="flex flex-wrap w-full">
        <img
          :src="post.image.large"
          :alt="post.title"
          class="w-full flex rounded-3xl" />
      </div>
    </div>
    <div class="grid grid-cols-4 flex-wrap gap-4 w-full">
      <div
        class="flex p-4 col-span-3 border border-base-100 transition ease-out gap-3 bg-base-100 rounded-3xl flex-wrap w-full">
        <div class="flex sticky backdrop-blur-xl bg-base-100/90 top-16 p-3  flex-wrap w-full gap-2 items-center">
          <div class="flex">
            <img
              :src="post.source.source.icon"
              :alt="post.source.source.name"
              class="flex w-8 h-8 bg-white rounded-full p-2 ease-out transition hover:ring-4 ring-0 ring-primary/60" />
          </div>
          <span class="flex text-sm">
            توسط : {{ post.source.source.name }}
          </span>
          <span>|</span>
          <nuxt-link class="flex text-sm" :to="post.url">
            نمایش در سایت اصلی
          </nuxt-link>

          <span>|</span>
          <span class="flex text-sm">
            {{ post.created_at.shamsi }}
          </span>
          <span>|</span>
          <span class="flex text-sm">
              زمان مطالعه : {{ timeToRead }}
          </span>
        </div>
        <div class="leading-8 post-body text-justify" v-html="post.html"></div>
      </div>
      <div class="flex flex-wrap p-4 justify-center items-center w-full">
        benyaminrmb
      </div>
    </div>
  </div>
</template>
