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
    class="w-full bg-white flex flex-wrap p-4 gap-3 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <nuxt-link class="w-full flex" :to="`/post/${item.id}`">
      <img
        class="rounded-lg"
        :src="props.item.image.large"
        :alt="props.item.title" />
    </nuxt-link>
    <div class="flex w-full flex-wrap gap-3">
      <nuxt-link
        v-for="(category, index2) in props.item.categories.slice(0, 2)"
        :key="index2"
        class="bg-accent hover:bg-accent-focus self-start flex transition ease-out text-accent-content px-1 py-0.5 rounded-md flex flex-wrap whitespace-nowrap text-sm">
        {{ category.name }}
      </nuxt-link>
    </div>
    <div class="flex items-center gap-3 flex-wrap w-full">
      <div class="flex w-full gap-3">
        <nuxt-link class="w-full flex" :to="`/post/${item.id}`">
          <h2
            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            {{ props.item.title }}
          </h2>
        </nuxt-link>
      </div>

      <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
        {{ props.item.text }}
      </p>
      <nuxt-link
        :to="`/post/${item.id}`"
        class="inline-flex items-center transition ease-out px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg
          aria-hidden="true"
          class="w-4 h-4 ml-2 -mr-1"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg">
          <path
            fill-rule="evenodd"
            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
            clip-rule="evenodd"></path>
        </svg>
        بیشتر بخون
      </nuxt-link>
      <div class="flex flex-wrap w-full">
        <div class="flex gap-3 items-center space-x-4">
          <img
            :src="props.item.source.source.icon"
            :alt="props.item.source.source.name"
            class="flex w-8 h-8 bg-white rounded-full p-2 ease-out transition group-hover:ring-4 ring-0 ring-primary/60" />
          <div class="font-medium dark:text-white">
            <span class="w-full text-center dir-ltr block font-light text-sm"
              >#{{ props.item.source.source.name }}</span
            >
            <div class="text-sm text-gray-500 dark:text-gray-400">
              {{ props.item.created_at.shamsi }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
