<script setup lang="ts">
let props = defineProps({
    categories: {
        required: true,
        type: Object,
    },
})
</script>
<template>
    <nuxt-link
        v-for="(category, index) in props.categories.slice(0, 2)"
        :key="index"
        class="bg-accent hover:bg-accent-focus self-start flex transition ease-out text-accent-content px-1 py-0.5 rounded-md flex flex-wrap whitespace-nowrap text-sm">
        {{ category.name }}
    </nuxt-link>
</template>
