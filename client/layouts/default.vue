<script lang="ts" setup>
definePageMeta({
  middleware: ['auth'],
  // or middleware: 'auth'
})
useHead({
  htmlAttrs: {
    dir: 'rtl',
  },
  bodyAttrs: {
    class: 'h-full bg-base-200 dark:bg-base-300',
  },
})
</script>
<template>
  <div class="flex flex-wrap gap-6">
    <NuxtLoadingIndicator />
    <appHeader />
    <slot />
    <appFooter />
  </div>
</template>
