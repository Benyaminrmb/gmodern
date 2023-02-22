<script lang="ts" setup>
import {ref} from 'vue'

useHead({
  htmlAttrs: {
    dir: 'rtl',
  },
  bodyAttrs: {
    class: 'h-full bg-base-200 dark:bg-base-300',
  },
})

import {
  Dialog,
  DialogOverlay,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue'

const navigation = [
  {name: 'Dashboard', href: '#', icon: '', current: true},
  {name: 'Team', href: '#', icon: '', current: false},
  {name: 'Projects', href: '#', icon: '', current: false},
  {name: 'Calendar', href: '#', icon: '', current: false},
  {name: 'Documents', href: '#', icon: '', current: false},
  {name: 'Reports', href: '#', icon: '', current: false},
]
const sidebarOpen = ref(false)
</script>
<template>
  <div class="flex flex-wrap w-full">
    <NuxtLoadingIndicator />

    <div class="drawer drawer-mobile">
      <input id="drawer" type="checkbox" class="drawer-toggle" />
      <div class="drawer-content gap-6 flex flex-col items-center">
        <app-header>
          <div class="drawer-content">
            <!-- Page content here -->
            <label for="drawer" class="drawer-button btn btn-primary"
              >Open drawer</label
            >
          </div></app-header
        >

        <!-- Page content here -->
        <div class="flex flex-wrap pb-16 px-6 w-full">
          <slot />
        </div>

        <app-admin-footer />
      </div>
      <app-admin-sidebar />
    </div>
  </div>
</template>
<style scoped>
.router-link-active {
  @apply bg-primary !important;
}
</style>
