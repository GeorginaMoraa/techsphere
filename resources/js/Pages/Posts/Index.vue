<script setup>
import Pagination from '@/Components/Pagination.vue';
import SearchFilter from '@/Components/SearchFilter.vue';
import ConsoleLayout from '@/Layouts/ConsoleLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/vue3';
import pickBy from 'lodash/pickBy';
import throttle from 'lodash/throttle';
import { reactive, watch } from 'vue';

const props = defineProps({
    filters: Object,
    posts: Object,
});

// Reactive form state with safe defaults
const form = reactive({
    search: props.filters?.search || '',
    category: props.filters?.category || null,
});

// Throttle function to optimize search requests
const throttledHandler = throttle(() => {
    Inertia.get('/posts', pickBy(form), { preserveState: true, replace: true });
}, 200);

// Watch both form fields efficiently
watch(() => [form.search, form.category], throttledHandler, { deep: true });

// Reset form and reload posts
// const reset = () => {
//     form.search = '';
//     form.category = null;
//     Inertia.get('/posts', {}, { preserveState: true, replace: true });
// };
</script>

<template>
    <Head title="Post A Blog" />
    <ConsoleLayout />
    <!-- Page Header -->
    <div class="flex justify-between pr-8 pt-14">
        <span
            class="pl-8 text-4xl font-semibold leading-tight text-blue-500 dark:text-yellow-400"
        >
            <span class="hidden md:inline">All</span>
            <span>&nbsp;Posts</span>
        </span>
    </div>

    <!-- Search & Filter Section -->
    <div class="flex justify-between pb-7 pl-4 pr-8 pt-7">
        <SearchFilter v-model="form.search" class="mr-4 w-full max-w-md">
            <label class="block text-white">Category:</label>
            <select v-model="form.category" class="form-select mt-1 w-full">
                <option :value="null">All Categories</option>
                <option value="tech-news">Tech News</option>
                <option value="reviews">Reviews</option>
                <option value="tutorials">Tutorials</option>
            </select>
        </SearchFilter>

        <Link
            class="bg-gold rounded px-6 py-3 font-semibold text-white hover:bg-blue-500"
            href="/posts/create"
        >
            <span>Create</span>
            <span class="hidden md:inline">&nbsp;Post</span>
        </Link>
    </div>

    <!-- Posts Table -->
    <div class="relative h-screen overflow-x-auto px-4 shadow-md sm:rounded-lg">
        <table
            class="w-full rounded text-left text-base text-gray-500 dark:text-gray-400"
        >
            <thead
                class="dark:bg-navy bg-navy text-gold rounded-t text-base uppercase"
            >
                <tr>
                    <th scope="col" class="px-6 py-3">Title</th>
                    <th scope="col" class="px-6 py-3">Category</th>
                    <th scope="col" class="px-6 py-3">Author</th>
                    <th scope="col" class="px-6 py-3">Published</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="post in posts?.data"
                    :key="post.id"
                    class="bg-grey border-b hover:bg-gray-50 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600"
                >
                    <th class="px-6 py-4">
                        <Link
                            class="flex items-center"
                            :href="`/posts/blog/${post.id}`"
                        >
                            {{ post.title }}
                        </Link>
                    </th>
                    <td class="px-6 py-4">{{ post.category }}</td>
                    <td class="px-6 py-4">{{ post.author }}</td>
                    <td class="px-6 py-4">{{ post.published_at }}</td>
                </tr>
                <tr v-if="posts?.data?.length === 0">
                    <td
                        colspan="4"
                        class="border-x border-b bg-white px-6 py-4 text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400"
                    >
                        No Blog Posts Found
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination -->
        <div id="pagination-section" class="mt-6">
            <Pagination :links="posts?.links || []" />
        </div>
    </div>
    <!-- End of Posts Table -->
    <footer class="bg-gray-900 py-8 text-white">
        <div class="position-relative container mx-auto px-6 text-center">
            <p>
                &copy; {{ new Date().getFullYear() }} TechSphere. All rights
                reserved.
            </p>
        </div>
    </footer>
</template>
<style>
body {
    font-family: 'Arial', sans-serif;
    /* background-color: #001f3f; */
    /* background-image:; */
    margin: 0;
    padding: 0;
}
.bg-navy {
    background-color: #001f3f;
}
.text-navy {
    color: #001f3f;
}
.bg-gold {
    background-color: #d6a037;
}
.text-gold {
    color: #d6a037;
}
</style>
