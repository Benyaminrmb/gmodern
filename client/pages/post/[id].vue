<script lang="ts" setup>
import {useGetPost} from "~/composables/post/useGetPosts";

const route = useRoute()
const post_id=route.params.id
let post = await useGetPost(post_id)
</script>
<template>
ddd {{ post }} ddds
</template>
