<script setup>
import ConsoleLayout from '@/Layouts/ConsoleLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed, toRefs } from 'vue';

// Props from the backend
const props = defineProps({
    post: Object,
    comments: Array,
    auth: Object, // Ensure auth data is passed from Laravel
});

const { post, auth } = toRefs(props);
const postId = computed(() => post.value?.id || '');
const userId = computed(() => auth.value?.user?.id || ''); // Get logged-in user ID
console.log('User ID:', userId.value);
const form = useForm({
    post_id: postId.value,
    user_id: userId.value, // Use authenticated user ID dynamically
    name: '',
    body: '',
});

const submitComment = () => {
    form.post(route('comments.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head :title="post.title" />
    <ConsoleLayout />

    <div class="container mx-auto px-6 py-12">
        <h2
            class="mb-4 py-12 text-center text-4xl font-bold text-gray-800 dark:text-black"
        >
            {{ post.title }}
        </h2>
        <p class="text-center text-gray-500">{{ post.published_at }}</p>

        <img
            :src="
                post.image ||
                'https://images.unsplash.com/photo-1703002574613-f417e7284e3d?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxleHBsb3JlLWZlZWR8OHx8fGVufDB8fHx8fA%3D%3D'
            "
            alt="Post Image"
            class="mx-auto mt-6 h-80 w-full rounded-lg object-cover shadow-md"
        />

        <div class="mt-6 text-lg text-gray-700 dark:text-black">
            <p v-html="post.body"></p>
        </div>

        <!-- Comments Section -->
        <div class="mt-10">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-black">
                Comments
            </h2>

            <div v-if="comments.length > 0" class="mt-4 space-y-4">
                <div
                    v-for="comment in comments"
                    :key="comment.id"
                    class="rounded-lg bg-gray-100 p-4 dark:bg-gray-100"
                >
                    <p class="font-semibold text-gray-800 dark:text-black">
                        {{ comment.name }}
                    </p>
                    <p class="text-gray-600 dark:text-black">
                        {{ comment.body }}
                    </p>
                    <p class="text-sm text-gray-500">
                        {{ comment.created_at }}
                    </p>
                </div>
            </div>
            <p v-else class="mt-4 text-gray-500">
                No comments yet. Be the first to comment!
            </p>

            <!-- Add Comment Form -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-black">
                    Add a Comment
                </h3>

                <form @submit.prevent="submitComment" class="mt-4">
                    <input type="hidden" v-model="form.post_id" />
                    <input type="hidden" v-model="userId.value" />

                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-black"
                            >Your Name:</label
                        >
                        <input
                            v-model="form.name"
                            type="text"
                            required
                            class="mt-1 w-full rounded-lg border-gray-300 p-2 dark:bg-gray-100 dark:text-black"
                        />
                    </div>

                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-black"
                            >Your Comment:</label
                        >
                        <textarea
                            v-model="form.body"
                            required
                            class="mt-1 w-full rounded-lg border-gray-300 p-2 dark:bg-gray-100 dark:text-black"
                        ></textarea>
                    </div>

                    <button
                        type="submit"
                        class="bg-navy text-gold rounded-lg px-4 py-2 hover:text-white"
                    >
                        Submit Comment
                    </button>
                </form>
            </div>
        </div>
    </div>
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
    background-color: #f9f9f9;
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
