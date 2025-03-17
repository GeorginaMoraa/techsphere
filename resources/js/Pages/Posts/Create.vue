<script setup>
import TextAreaInput from '@/Components/TextAreaInput.vue';
import ConsoleLayout from '@/Layouts/ConsoleLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const imagePreview = ref(null);
const successMessage = ref('');

const form = useForm({
    title: '',
    image: null,
    body: '',
    category: '', // Added category field
});

const submitPost = () => {
    form.post(route('posts.store'), {
        onSuccess: () => {
            successMessage.value = 'Post created successfully!';
            form.reset();
            imagePreview.value = null;
            setTimeout(() => (successMessage.value = ''), 3000);
        },
    });
    form.processing = false;
};

const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        if (!file.type.startsWith('image/')) {
            form.errors.image =
                'Please upload a valid image file (e.g., JPEG, PNG).';
            return;
        }
        if (file.size > 2 * 1024 * 1024) {
            form.errors.image = 'The image size must be less than 2MB.';
            return;
        }
        form.image = file;

        const reader = new FileReader();
        reader.onload = () => (imagePreview.value = reader.result);
        reader.readAsDataURL(file);
    }
};

const deletePost = (id) => {
    if (
        confirm(
            'Are you sure you want to delete this post? This action cannot be undone.',
        )
    ) {
        form.delete(route('posts.destroy', id));
    }
};
</script>

<template>
    <ConsoleLayout />
    <Head title="Create a New Post" />

    <header class="text-gold mt-4 py-10 text-center">
        <h1 class="text-2xl font-bold">Create a New Post</h1>
    </header>

    <div class="mx-auto max-w-4xl p-6 sm:px-6 lg:px-8">
        <div
            class="border-navy overflow-hidden rounded-xl border bg-white p-10 shadow-lg"
        >
            <form @submit.prevent="submitPost">
                <!-- Title -->
                <div>
                    <InputLabel
                        for="title"
                        value="Title"
                        class="text-navy font-semibold"
                    />
                    <TextAreaInput
                        id="title"
                        type="text"
                        class="border-navy focus:ring-gold mt-1 block h-10 w-full rounded-lg p-0 px-2 placeholder-gray-400 shadow-md"
                        placeholder="Title..."
                        v-model="form.title"
                        required
                    />
                    <InputError
                        class="mt-2 text-red-500"
                        :message="form.errors.title"
                    />
                </div>

                <!-- Category -->
                <div class="mt-4">
                    <InputLabel
                        for="category"
                        value="Category"
                        class="text-navy font-semibold"
                    />
                    <select
                        id="category"
                        class="border-navy focus:ring-gold mt-1 block w-full rounded-lg p-2 shadow-md"
                        v-model="form.category"
                        required
                    >
                        <option value="" disabled>Select a category</option>
                        <option value="technology">Technology</option>
                        <option value="programming">Programming</option>
                        <option value="cybersecurity">Cybersecurity</option>
                        <option value="ai-ml">AI & Machine Learning</option>
                        <option value="web-development">Web Development</option>
                        <option value="mobile-development">
                            Mobile Development
                        </option>
                        <option value="cloud-computing">Cloud Computing</option>
                        <option value="networking">Networking</option>
                        <option value="gadgets">Gadgets</option>
                        <!-- <option value="lifestyle">Lifestyle</option>
                        <option value="business">Business</option>
                        <option value="startups">Startups</option>
                        <option value="finance">Finance</option>
                        <option value="health">Health</option>
                        <option value="science">Science</option>
                        <option value="education">Education</option>
                        <option value="gaming">Gaming</option> -->
                        <option value="reviews">Tech Reviews</option>
                    </select>
                    <InputError
                        class="mt-2 text-red-500"
                        :message="form.errors.category"
                    />
                </div>

                <!-- Image Upload -->
                <div class="mt-4">
                    <InputLabel
                        for="image"
                        value="Upload Image"
                        class="text-navy font-semibold"
                    />
                    <input
                        id="image"
                        type="file"
                        class="border-navy focus:ring-gold mt-1 block w-full cursor-pointer rounded-lg shadow-md"
                        @change="handleFileChange"
                        accept="image/*"
                        required
                    />
                    <InputError
                        class="mt-2 text-red-500"
                        :message="form.errors.image"
                    />
                    <div v-if="imagePreview" class="mt-4">
                        <p class="text-sm text-gray-600">Image Preview:</p>
                        <img
                            :src="imagePreview"
                            class="border-gold mt-2 w-full max-w-xs rounded-lg border shadow-lg"
                        />
                    </div>
                </div>

                <!-- Content -->
                <div class="mt-4">
                    <InputLabel
                        for="body"
                        value="Content"
                        class="text-navy font-semibold"
                    />
                    <textarea
                        id="body"
                        class="border-navy focus:ring-gold mt-1 block w-full rounded-lg p-2 shadow-md"
                        rows="5"
                        v-model="form.body"
                        required
                    ></textarea>
                    <InputError
                        class="mt-2 text-red-500"
                        :message="form.errors.body"
                    />
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex items-center justify-between">
                    <PrimaryButton
                        class="bg-navy hover:bg-gold hover:text-navy rounded-lg px-4 py-2 font-bold text-white shadow-lg transition"
                        :disabled="form.processing"
                        @click="submitPost"
                        :class="{ 'opacity-25': form.processing }"
                    >
                        Submit Post
                    </PrimaryButton>
                    <DangerButton
                        v-if="form.id"
                        class="rounded-lg bg-red-600 px-4 py-2 font-bold text-white shadow-lg transition hover:bg-red-700"
                        @click="deletePost(form.id)"
                    >
                        Delete Post
                    </DangerButton>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Message -->
    <div
        v-if="successMessage"
        class="fixed bottom-4 right-4 rounded-lg bg-green-500 px-4 py-2 text-white shadow-md"
    >
        {{ successMessage }}
    </div>

    <!-- Footer -->
    <footer
        class="bg-navy text-gold position-bottom mt-1 px-0 py-0 text-center"
    >
        <p>&copy; 2025 TechSphere. All rights reserved.</p>
        <p class="mt-2">
            <a href="/posts" class="hover:text-gold"> Back to Posts</a>
        </p>
    </footer>
</template>

<style>
/* Your existing styles */
</style>
