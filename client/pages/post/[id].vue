<script lang="ts" setup>
import {useGetPost} from '~/composables/post/useGetPosts'
import StickyNav from "~/components/post/sticky-nav.vue";

const route = useRoute()
const post_id = route.params.id
let posts = await useGetPost(post_id)
const post = posts.data.post

</script>
<template>
  <div class="grid grid-cols-12 w-full gap-3">
    <div class="flex flex-wrap col-span-3"></div>
    <div class="flex flex-wrap col-span-12 md:col-span-6 gap-6">

      <div class="flex flex-wrap w-full">
        <div
          class="flex col-span-3 border border-base-100 transition ease-out gap-3 bg-base-100 rounded-3xl flex-wrap w-full">
          <sticky-nav :post="post"/>
            <div
                class="leading-8 flex flex-wrap gap-3 text-justify">
                <img :src="post.image.large" alt="">
                <div class="flex w-full flex-wrap gap-3">
                    <post-category-item :categories="post.categories"/>
                </div>
            </div>
          <div
            class="leading-8  p-4  post-body text-justify"
            v-html="post.html"></div>
        </div>
        <div class="flex flex-wrap p-4 justify-center items-center w-full">
          benyaminrmb
        </div>
      </div>
    </div>
    <div class="flex flex-wrap col-span-3"></div>
  </div>
</template>
