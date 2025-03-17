<!-- eslint-disable prettier/prettier -->
<template>
    <div class="bg-white text-gray-900">
        <!-- Navbar -->
        <nav class="bg-navy text-gold flex items-center justify-between px-6 py-4">
            <div class="flex items-center space-x-3">
                <img src="/images/pweeee.png" class="h-10" />
            </div>

            <!-- Search Bar -->
            <div class="hidden md:flex items-center space-x-4 bg-white rounded-lg shadow-md p-2">
                <input
                    type="text"
                    placeholder="Search articles..."
                    class="w-64 rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <button class="bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700">
                    <i class="fa-solid fa-search"></i> Search
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-6">
                <Link href="/" class="hover:text-gold text-white">Home</Link>
                <Link href="/about" class="hover:text-gold text-white">About Us</Link>
                <Link href="/blogs" class="hover:text-gold text-white">Blog</Link>
                <Link href="/posts" class="hover:text-gold text-white">Post A Blog</Link>
            </div>

            <!-- Authentication Buttons -->
            <div class="flex space-x-4">
                <Link href="/login" class="bg-white text-black rounded-md px-4 py-2 hover:bg-gray-200">
                    Login <i class="fa-solid fa-right-to-bracket"></i>
                </Link>
                <Link href="/register" class="bg-gold text-white rounded-md px-4 py-2 hover:bg-yellow-500">
                    Register
                </Link>
            </div>
        </nav>

        <!-- Hero Section -->
        <section
            class="bg-cover bg-center py-20 text-center text-white"
            style="background-image: url('/images/bg.jpg')"
        >
            <h1 class="text-4xl font-bold">Welcome to TechSphere</h1>
            <p class="mt-4 text-lg font-semibold">Stay informed with the latest breakthroughs in technology.</p>
            <button class="bg-gold mt-6 rounded-lg px-6 py-3 font-semibold hover:bg-yellow-500">
               <a href="/blogs">Get Started</a>
            </button>
        </section>

        <!-- Blog Sections -->
        <section class="px-6 py-10">
            <legend class="text-center text-3xl font-bold">New Blogs</legend>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 mt-6">
                <BlogCard v-for="post in posts" :key="post.id" :post="post" />
            </div>

            <legend class="text-center text-3xl font-bold mt-10">Popular Blogs</legend>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 mt-6">
                <BlogCard v-for="post in popularPosts" :key="post.id" :post="post" />
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-navy text-white px-6 py-10 mt-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h3 class="text-lg font-bold">Use Cases</h3>
                    <ul>
                        <li>UI Design</li>
                        <li>UX Design</li>
                        <li>Technology News</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold">Explore</h3>
                    <ul>
                        <li>Cyber Security</li>
                        <li>Software Development</li>
                        <li>Artificial Intelligence</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold">Resources</h3>
                    <ul>
                        <li>Blog</li>
                        <li>Developers</li>
                        <li>Support</li>
                    </ul>
                </div>
            </div>

            <div class="mt-6 flex justify-center space-x-4">
                <i class="fab fa-twitter">Twitter</i>
                <i class="fab fa-youtube">Youtube</i>
                <i class="fab fa-linkedin">Linkedin</i>
            </div>
            <p class="text-center mt-4">
                &copy; {{ new Date().getFullYear() }} TechSphere. All rights reserved.
            </p>
        </footer>
    </div>
</template>

<script>
import BlogCard from '@/Components/BlogCard.vue';
import { Link } from '@inertiajs/vue3';

export default {
    components: { Link, BlogCard },
    data() {
        return {
            posts: [
                {
                    id: 1,
                    title: 'Exploring Vue 3',
                    body: 'A deep dive into Vue 3 features...',
                },
                {
                    id: 2,
                    title: 'Mastering Inertia.js',
                    body: 'A complete guide to Inertia.js in Laravel',
                },
                {
                    id: 3,
                    title: 'Tailwind CSS Tricks',
                    body: 'Essential Tailwind CSS techniques for devs',
                },
            ],
            popularPosts: [
                {
                    id: 4,
                    title: 'React vs Vue',
                    body: 'Comparing two powerful frontend frameworks',
                },
                {
                    id: 5,
                    title: 'Best JavaScript Libraries',
                    body: 'Top JS libraries to enhance your projects',
                },
                {
                    id: 6,
                    title: 'Security in Web Apps',
                    body: 'Understanding authentication and encryption',
                },
            ],
        };
    },
};
</script>

<style scoped>
.bg-navy {
    background-color: #001f3f;
}
.text-navy {
    color: #001f3f;
}
.bg-gold {
    background-color: #d6a037;
}
.hover\:text-gold:hover {
    color: #ffd700;
}
</style>
