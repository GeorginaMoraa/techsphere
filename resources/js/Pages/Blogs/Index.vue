<script setup>
import Pagination from '@/Components/Pagination.vue';
import ConsoleLayout from '@/Layouts/ConsoleLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    posts: Object,
});
</script>

<template>
    <Head title="Blog Posts" />

    <ConsoleLayout />

    <div class="container mx-auto px-6 py-12">
        <h1
            class="dark:text-navy mb-10 py-12 text-center text-4xl font-bold text-gray-800"
        >
            Latest Blog Posts
        </h1>

        <!-- Blog Cards Grid -->
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">
            <div
                v-for="post in posts.data"
                :key="post.id"
                class="transform overflow-hidden rounded-lg bg-white shadow-lg transition-transform hover:scale-105 dark:bg-white dark:text-gray-800"
            >
                <img
                    :src="post.image || '/images/bg.jpg'"
                    alt="Post Image"
                    class="h-48 w-full object-cover"
                />
                <div class="p-4">
                    <h2
                        class="text-xl font-semibold text-gray-800 dark:text-white"
                    >
                        {{ post.title }}
                    </h2>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        {{
                            post.excerpt ||
                            (post.body
                                ? post.body.substring(0, 100) + '...'
                                : 'No content available')
                        }}
                    </p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-sm text-gray-500">{{
                            post.published_at
                        }}</span>
                        <Link
                            :href="route('blogs.show', post.id)"
                            class="text-blue-500 hover:underline"
                        >
                            Read More →
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            <Pagination :links="posts.links" />
        </div>
    </div>
    <footer class="bg-gray-800 py-4 text-center text-white">
        <p>&copy; 2025 TechSphere. All rights reserved.</p>
    </footer>
</template>
<style>
.bg-navy {
    background-color: #001f3f;
}
text-navy {
    color: #001f3f;
}
.bg-gold {
    background-color: #d6a037;
}
.text-navy {
    color: #001f3f;
}
/* Add any custom styles here */
</style>
