<script lang="ts" setup>
import { usePosts } from "~/stores/posts";
import { useGetIndexPosts } from "~/composables/useGetIndexPosts";
// import Swiper core and required modules
import { Pagination, Autoplay } from "swiper";

// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/scrollbar";
import "swiper/css/autoplay";

await useGetIndexPosts();
const index_data = await usePosts();
const banner_posts = index_data.data.bannerPosts;
const main_posts = index_data.data.indexPosts.data;
const modules = [Pagination, Autoplay];
const options = {
    slidesPerView: "auto",
    spaceBetween: 10,
};
</script>
<template>
    <div class="grid grid-cols-12 w-full gap-3">
        <div class="flex flex-wrap col-span-3">3</div>
        <div class="flex flex-wrap col-span-6 gap-6">
            <div class="flex flex-wrap w-full dir-ltr">
                <swiper
                    class="rounded-3xl w-full"
                    :slides-per-view="1"
                    :space-between="50"
                    :modules="modules"
                    :options="options"
                    :loop="true"
                    :pagination="{ clickable: true, dynamicBullets: true }"
                >
                    <swiper-slide
                        class="w-full"
                        :virtualIndex="index"
                        v-for="(post, index) in banner_posts"
                        :key="index"
                    >
                        <div class="flex w-full flex-wrap">
                            <div
                                class="flex rounded-3xl bg-center bg-cover bg-no-repeat bg-sca flex-wrap w-full h-[320px]"
                                :style="`background-image:url(${post.image.large})`"
                            >
                                <div
                                    class="absolute items-stretch dir-rtl grid grid-cols-6 w-full h-full bottom-0 right-0 bg-gradient-to-l from-base-100/90 p-3"
                                >
                                    <div
                                        class="flex flex-wrap gap-3 col-span-3"
                                    >
                                        <h2
                                            class="flex w-full text-right flex-wrap content-color text-3xl leading-10"
                                        >
                                            {{ post.title }}
                                        </h2>
                                        <div class="flex w-full flex-wrap">
                                            <p
                                                class="content-color truncate text-ellipsis"
                                            >
                                                {{ post.text }}
                                            </p>
                                        </div>
                                        <div
                                            class="flex self-end w-full flex-wrap"
                                        >
                                            <div
                                                class="flex rounded-2xl text-primary-content items-center gap-2 border-1 border-primary/60 bg-primary p-1"
                                            >
                                                <span class="text-xs">
                                                    {{ post.created_at.shamsi }}
                                                </span>
                                                <div
                                                    class="flex rounded-2xl text-primary-content bg-primary-focus p-2 hover:shadow hover:-translate-y-[3px] ease-in transition"
                                                >
                                                    <span
                                                        class="dir-ltr text-sm font-bold"
                                                    >
                                                        @{{
                                                            post.source.source
                                                                .name
                                                        }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </swiper-slide>
                </swiper>
            </div>

            <div class="flex flex-wrap w-full px-3">
                <span class="text-3xl font-bold content-color"
                    >آخرین اخبار</span
                >
            </div>

            <div v-if="main_posts" class="grid grid-cols-2 w-full gap-4">
                <post-item
                    v-for="(post, index) in main_posts"
                    :item="post"
                    :key="index"
                />
            </div>
        </div>
        <div class="flex flex-wrap col-span-3">3</div>
    </div>
</template>
<style>
.swiper-pagination-bullet-active {
    @apply bg-primary !important;
}

.swiper-pagination-bullet {
    @apply opacity-100 bg-base-300;
}
</style>
