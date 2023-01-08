<script lang="ts" setup>



import {useRunCrawler} from "~/composables/admin/crawl/useRunCrawler";

definePageMeta({
  layout: 'admin',
  middleware: ['admin'],
})
useHead({
  title: 'خزش -',
})
let crawl_loading=false
let crawl_result=null
const runCrawler =async ()=>{
    crawl_loading=true
    crawl_result = await useRunCrawler()
    crawl_loading=false
}
</script>

<template>
    <div class="flex flex-wrap">
        <button @click="runCrawler"
                :disabled="crawl_loading"
            class="btn btn-primary">شروع خزش</button>
        {{ crawl_result }}
    </div>
</template>
