<template>
    <Head title="TechSphere - Blog Posts" />
    <div class="container mx-auto p-4">
        <h1 class="mb-4 text-center text-2xl font-bold">
            TechSphere - Blog Posts
        </h1>
        <form @submit.prevent="submitPost" class="space-y-4">
            <input
                type="text"
                class="w-full rounded border p-2"
                placeholder="Post Title"
                v-model="form.title"
                required
            />
            <input
                type="text"
                class="w-full rounded border p-2"
                placeholder="Author Name"
                v-model="form.author"
                required
            />
            <textarea
                class="w-full rounded border p-2"
                placeholder="Post Content"
                v-model="form.content"
                required
            ></textarea>
            <button
                type="submit"
                class="rounded bg-blue-500 px-4 py-2 text-white"
            >
                Submit
            </button>
        </form>

        <div v-if="posts && posts.length" class="mt-6">
            <div
                v-for="post in posts"
                :key="post.id"
                class="mb-4 rounded border p-4 shadow"
            >
                <h3 class="text-lg font-bold">{{ post.title }}</h3>
                <p class="text-sm text-gray-500">By: {{ post.author }}</p>
                <p class="mt-2">{{ post.content }}</p>
            </div>
        </div>
        <p v-else class="mt-4 text-center text-gray-500">No posts available.</p>
    </div>
    <footer
        class="bg-gray-800 py-4 text-center text-white"
        style="position: fixed; bottom: 0; width: 100%"
    >
        <p>
            &copy; {{ new Date().getFullYear() }} TechSphere. All rights
            reserved.
        </p>
    </footer>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import { defineComponent } from 'vue';

export default defineComponent({
    props: {
        posts: {
            type: Array,
            required: true,
            default: () => [],
        },
    },
    setup() {
        const form = useForm({
            title: '',
            author: '',
            content: '',
        });

        const submitPost = () => {
            form.post(route('posts.store'));
        };

        return { form, submitPost };
    },
});
</script>

<style scoped>
.container {
    max-width: 800px;
}
</style>
