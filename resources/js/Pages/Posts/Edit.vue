<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import CustomDropdown from '@/Components/CustomDropdown.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import NavigationBar from '@/Components/NavigationBar.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ConsoleLayout from '@/Layouts/ConsoleLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const confirmingPostDeletion = ref(false);
const { props } = usePage();
const post = props.post;
const categories = props.categories;

const form = useForm({
    title: post.title || '',
    body: post.body || '',
    category: post.category || '',
    is_published: Boolean(post.is_published),
    author: post.author || '',
    tags: post.tags || '',
});

const update = () => {
    form.put(`/posts/${post.id}`, {
        onSuccess: () => alert('Post updated successfully!'),
    });
};

const confirmPostDeletion = () => {
    confirmingPostDeletion.value = true;
};

const deletePost = () => {
    form.delete(`/posts/${post.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            confirmingPostDeletion.value = false;
            alert('Post deleted successfully!');
        },
    });
};
</script>

<template>
    <Head title="Edit Post" />
    <NavigationBar />

    <ConsoleLayout>
        <div class="bg-navy-100 dark:bg-navy-800 min-h-screen px-10 py-14">
            <div class="flex pb-7">
                <Link
                    href="/posts"
                    class="dark:text-gold-600 text-4xl font-semibold text-blue-500"
                >
                    Blog Posts&nbsp;
                </Link>
                <span
                    class="text-gold-700 dark:text-golden-300 text-4xl font-semibold"
                    >/&nbsp;Edit</span
                >
            </div>

            <div class="max-w-3xl rounded-md">
                <form @submit.prevent="update">
                    <div class="py-2">
                        <InputLabel for="title" value="Post Title" />
                        <TextInput
                            id="title"
                            v-model="form.title"
                            class="mt-1 block w-full"
                        />
                        <InputError :message="form.errors.title" />
                    </div>

                    <div class="py-2">
                        <InputLabel for="category" value="Category" />
                        <CustomDropdown v-model="form.category">
                            <option
                                v-for="category in categories"
                                :key="category"
                                :value="category"
                            >
                                {{ category }}
                            </option>
                        </CustomDropdown>
                        <InputError :message="form.errors.category" />
                    </div>

                    <div class="py-2">
                        <InputLabel for="content" value="Post Content" />
                        <TextareaInput id="content" v-model="form.content" />
                        <InputError :message="form.errors.content" />
                    </div>

                    <div class="py-2">
                        <InputLabel for="tags" value="Tags (comma-separated)" />
                        <TextInput
                            id="tags"
                            v-model="form.tags"
                            class="mt-1 block w-full"
                        />
                        <InputError :message="form.errors.tags" />
                    </div>

                    <div class="py-2">
                        <InputLabel for="author" value="Author Name" />
                        <TextInput
                            id="author"
                            v-model="form.author"
                            class="mt-1 block w-full"
                        />
                        <InputError :message="form.errors.author" />
                    </div>

                    <div class="flex items-center py-2">
                        <Checkbox v-model:checked="form.is_published" />
                        <span
                            class="ms-2 text-sm text-gray-600 dark:text-gray-400"
                        >
                            Publish Now?
                        </span>
                    </div>

                    <InputError :message="form.errors.is_published" />

                    <div class="flex justify-between gap-4 py-10">
                        <DangerButton @click.prevent="confirmPostDeletion">
                            Delete Post
                        </DangerButton>
                        <PrimaryButton :disabled="form.processing">
                            Save Changes
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </ConsoleLayout>

    <Modal
        :show="confirmingPostDeletion"
        @close="confirmingPostDeletion = false"
    >
        <div class="p-6 text-center">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Are you sure you want to delete this post?
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Once deleted, all associated data will be permanently removed.
            </p>
            <div class="mt-6 flex justify-center gap-4">
                <SecondaryButton @click="confirmingPostDeletion = false">
                    Cancel
                </SecondaryButton>
                <DangerButton @click="deletePost"> Delete </DangerButton>
            </div>
        </div>
    </Modal>
</template>
