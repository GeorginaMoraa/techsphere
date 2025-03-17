<template>
    <div
        class="rounded-lg border p-4 shadow-md transition-shadow hover:shadow-lg"
    >
        <!-- Blog Image -->
        <img
            v-if="post.image"
            :src="post.image"
            alt="Blog image"
            class="h-40 w-full rounded-md object-cover"
        />
        <div v-else class="h-40 w-full rounded-md bg-gray-300"></div>

        <!-- Blog Title & Content -->
        <h2 class="mt-2 text-xl font-semibold">{{ post.title }}</h2>
        <p class="mt-1 text-gray-600">{{ post.body }}</p>

        <!-- Read More Link -->
        <Link
            :href="`/blogs/${post.id}`"
            class="mt-2 inline-block text-blue-600 hover:underline"
        >
            Read more
        </Link>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: { Link },
    props: {
        post: Object,
    },
};
</script>
