<script setup>
import ConsoleLayout from '@/Layouts/ConsoleLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="About Us - TechSphere" />
    <ConsoleLayout />
    <div class="container mx-auto px-6 py-12">
        <h1
            class="mb-6 mt-12 text-center text-5xl font-extrabold text-gray-900 dark:text-black"
        >
            About TechSphere
        </h1>
        <p
            class="mx-auto max-w-2xl text-center text-lg text-gray-600 dark:text-gray-500"
        >
            Empowering the future of technology through insightful articles,
            tutorials, and community discussions.
        </p>

        <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-2">
            <div
                class="dark:bg-gold-800 transform rounded-xl bg-gray-100 p-8 shadow-lg transition-transform hover:scale-105"
            >
                <h2 class="text-3xl font-bold text-gray-900 dark:text-black">
                    Our Mission
                </h2>
                <p class="mt-4 text-gray-700 dark:text-gray-400">
                    At TechSphere, our mission is to provide tech enthusiasts,
                    developers, and entrepreneurs with high-quality content that
                    helps them stay ahead in the ever-evolving tech world.
                </p>
            </div>

            <div
                class="transform rounded-xl bg-gray-100 p-8 shadow-lg transition-transform hover:scale-105 dark:bg-gray-800"
            >
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Why TechSphere?
                </h2>
                <p class="mt-4 text-gray-700 dark:text-gray-400">
                    Whether you're a beginner or an experienced professional,
                    our content is curated to be informative, practical, and
                    relevant to the latest industry trends.
                </p>
            </div>
            <div
                class="transform rounded-xl bg-gray-100 p-8 shadow-lg transition-transform hover:scale-105 dark:bg-gray-800"
            >
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Join Our Community
                </h2>
                <p class="mt-4 text-gray-700 dark:text-gray-400">
                    Connect with like-minded individuals, share your knowledge,
                    and learn from others in our vibrant and inclusive
                    community.
                </p>
                <a
                    href="/register"
                    class="bg-navy hover:text-gold mt-6 w-full rounded-md px-4 py-2 text-white"
                >
                    Join Now
                </a>
            </div>
            <div
                class="transform rounded-xl bg-gray-100 p-8 shadow-lg transition-transform hover:scale-105 dark:bg-gray-100"
            >
                <h2 class="text-3xl font-bold text-gray-900 dark:text-black">
                    More from Us...
                </h2>
                <p class="mt-4 text-gray-700 dark:text-gray-400">
                    Have a question or feedback? Reach out to us using the
                    contact form below, and we'll get back to you as soon as
                    possible.
                </p>
            </div>
        </div>
    </div>
    <div class="container mx-auto px-6 py-12">
        <h2
            class="mb-6 text-center text-4xl font-extrabold text-gray-900 dark:text-black"
        >
            contact us
        </h2>
        <p
            class="mx-auto max-w-2xl text-center text-lg text-gray-600 dark:text-black"
        >
            If you have any questions or feedback, feel free to reach out to us
            using the form below.
        </p>
        <form class="mx-auto mt-8 max-w-lg">
            <div class="grid grid-cols-1 gap-6">
                <label class="block">
                    <span class="text-gray-700 dark:text-black">Name:</span>
                    <input
                        type="text"
                        class="mt-1 block w-full rounded-md bg-gray-100 p-2 dark:bg-gray-100"
                    />
                </label>
                <label class="block">
                    <span class="text-gray-700 dark:text-black">Email:</span>
                    <input
                        type="email"
                        class="mt-1 block w-full rounded-md bg-gray-100 p-2 dark:bg-gray-100"
                    />
                </label>
                <label class="block">
                    <span class="text-gray-700 dark:text-black">Message:</span>
                    <textarea
                        class="mt-1 block w-full rounded-md bg-gray-100 p-2 dark:bg-gray-100"
                    ></textarea>
                </label>
                <button
                    type="submit"
                    class="bg-gold hover:text-gold w-full rounded-md px-4 py-2 text-black"
                >
                    Submit
                </button>
            </div>
        </form>
    </div>
    <footer class="text-gold bg-gray-900 py-8">
        <div class="position-relative container mx-auto px-6 text-center">
            <p>
                &copy; {{ new Date().getFullYear() }} TechSphere. All rights
                reserved.
            </p>
        </div>
    </footer>
</template>
<style>
.bg-gold {
    background-color: #d6a037;
}
.bg-navy {
    background-color: #001f3f;
}
.text-gold {
    color: #d6a037;
}
</style>
