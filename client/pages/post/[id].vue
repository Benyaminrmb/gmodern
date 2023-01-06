<script lang="ts" setup>
import {useGetPost} from '~/composables/post/useGetPosts'

const route = useRoute()
const post_id = route.params.id
let posts = await useGetPost(post_id)
const post = posts.data.post
</script>
<template>
  <div class="flex flex-wrap p-4 w-full">
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
        <div class="flex flex-wrap w-full gap-2 items-center">
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
      <div v-html="post.html" class="flex col-span-3 flex-wrap p-4 w-full">

      </div>
      <div class="flex flex-wrap p-4 w-full">ddd</div>
    </div>
  </div>
</template>
