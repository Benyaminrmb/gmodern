<script setup lang="ts">
const props = defineProps({
  item: {
    required: true,
    type: Object,
  },
})
</script>
<template>
  <div
    class="flex p-4 hover:bg-base-200 border border-base-100 transition ease-out gap-3 bg-base-100 rounded-3xl flex-wrap w-full">
    <nuxt-link :to="`/post/${item.id}`">
      <div class="flex flex-wrap w-full">
        <img
          class="w-full rounded-3xl h-[207px] object-cover"
          :src="props.item.image.large"
          alt="props.item.title" />
      </div>
    </nuxt-link>
    <div class="flex items-center gap-3 flex-wrap w-full">
      <div class="flex">
        <img
          :src="props.item.source.source.icon"
          :alt="props.item.source.source.name"
          class="flex w-8 h-8 bg-white rounded-full p-2 ease-out transition hover:ring-4 ring-0 ring-primary/60" />
      </div>
        <nuxt-link :to="`/post/${item.id}`">
      <h2 class="text-lg flex-1 content-color leading-8">
        {{ props.item.title }}
      </h2>
        </nuxt-link>
    </div>
    <div class="h-[1px] w-full bg-base-200"></div>
    <div class="flex flex-wrap">
      <p class="text-sm text-justify line-clamp-3 leading-6">
        {{ props.item.text }}
      </p>
    </div>
    <div class="flex w-full justify-around lex-wrap gap-3">
      <span class="badge badge-ghost text-xs py-3">
        {{ props.item.created_at.shamsi }}
      </span>
      <span class="hidden flex flex-wrap gap-2 text-xs items-center">
        <svg
          class="w-6 fill-base-300 h-6"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 576 512">
          <!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
          <path
            d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z" />
        </svg>
        <span> 12 </span>
      </span>

      <span class="hidden flex flex-wrap gap-2 text-xs items-center">
        <svg
          class="w-6 fill-base-300 h-6"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 512 512">
          <!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
          <path
            d="M256 32C114.6 32 .0272 125.1 .0272 240c0 49.63 21.35 94.98 56.97 130.7c-12.5 50.37-54.27 95.27-54.77 95.77c-2.25 2.25-2.875 5.734-1.5 8.734C1.979 478.2 4.75 480 8 480c66.25 0 115.1-31.76 140.6-51.39C181.2 440.9 217.6 448 256 448c141.4 0 255.1-93.13 255.1-208S397.4 32 256 32z" />
        </svg>
        <span> 12 </span>
      </span>
    </div>
    <div class="flex w-full flex-wrap gap-3">
      <span
        v-for="(category, index2) in props.item.categories.slice(0, 2)"
        :key="index"
        class="link-hover flex flex-wrap whitespace-nowrap text-sm">
        {{ category.name }}
      </span>
    </div>
  </div>
</template>
