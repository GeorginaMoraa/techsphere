<template>
    <div class="bg-navy items flex justify-between px-6 py-4 text-white">
        <div class="text-xl font-bold">TechSphere</div>
        <div
            class="hidden items-center space-x-4 rounded-lg bg-white p-2 shadow-md md:flex dark:bg-gray-800"
        >
            <input
                type="text"
                name="search"
                placeholder="Search articles..."
                class="w-64 rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <button
                class="rounded-lg bg-blue-600 p-2 text-white transition hover:bg-blue-700"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    class="h-5 w-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-4.35-4.35M15 11a4 4 0 10-8 0 4 4 0 008 0z"
                    />
                </svg>
            </button>
        </div>

        <div class="flex space-x-6">
            <Link href="/" class="hover:text-gold">Home</Link>
            <Link href="/about" class="hover:text-gold">About Us</Link>
            <Link href="/blogs" class="hover:text-gold">Blog</Link>
            <Link href="/posts" class="hover:text-gold">Post A Blog</Link>
        </div>

        <div class="flex space-x-4">
            <button
                class="bg-gold hover:bg-gold hover:text-gold flex items-center space-x-2 rounded-md px-4 py-2 text-white"
            >
                <Link href="/login" class="hover:text-gold"
                    >Login <i class="fa-solid fa-right-to-bracket"></i
                ></Link>
            </button>
            <button
                class="bg-gold flex items-center space-x-2 rounded-md px-4 py-2"
            >
                <Link
                    href="/register"
                    class="bg-gold rounded-md px-4 py-2 hover:bg-white hover:text-black"
                    >Register</Link
                >
            </button>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

// Define props
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

// Define emits
defineEmits(['logout']);
</script>

<style>
.bg-navy {
    background-color: #0c006e;
}
.bg-gold {
    background-color: #d6a037;
}
</style>
