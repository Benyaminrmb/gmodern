<script setup lang="ts">
let props = defineProps({
    post: {
        required: true,
        type: Object,
    },
})
function readingTime(text:string) {
    const wpm = 225
    const words = text.trim().split(/\s+/).length
    return Math.ceil(words / wpm)
}
const timeToRead = readingTime(props.post.html)
</script>
<template>
  <div
    class="flex sticky z-20 backdrop-blur-xl bg-black/70 right-0 top-16 p-3 flex-wrap w-full gap-2 items-center">
    <div class="flex">
      <img
        :src="props.post.source.source.icon"
        :alt="props.post.source.source.name"
        class="flex w-8 h-8 bg-white rounded-full p-2 ease-out transition hover:ring-4 ring-0 ring-primary/60" />
    </div>
    <span class="flex text-sm"> توسط : {{ props.post.source.source.name }} </span>
    <span>|</span>
    <nuxt-link class="flex text-sm" :to="props.post.url">
      نمایش در سایت اصلی
    </nuxt-link>

    <span>|</span>
    <span class="flex text-sm">
      {{ props.post.created_at.shamsi }}
    </span>
    <span>|</span>
    <span class="flex text-sm"> زمان مطالعه : {{ timeToRead }} </span>
  </div>
</template>
