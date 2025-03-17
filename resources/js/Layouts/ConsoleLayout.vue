<template>
    <nav class="bg-navy fixed top-0 z-50 w-full p-4 shadow-md">
        <div class="container mx-auto flex items-center justify-between">
            <!-- <h1 class="text-gold text-2xl font-bold">TechSphere</h1> -->
            <img
                src="/images/pweeee.png"
                alt="The text over here"
                width="100"
            />
            <ul class="flex space-x-6">
                <li>
                    <Link href="/" class="text-gold hover:text-white"
                        >Home</Link
                    >
                </li>
                <li>
                    <Link href="/blogs" class="text-gold hover:text-white"
                        >Blogs</Link
                    >
                </li>
                <li>
                    <Link href="/about" class="text-gold hover:text-white"
                        >About Us</Link
                    >
                </li>
                <li>
                    <Link href="/posts" class="text-gold hover:text-white"
                        >Post A Blog</Link
                    >
                </li>
            </ul>
        </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
.bg-navy {
    background-color: #001f3f;
}
.text-gold {
    color: #d6a037;
}
</style>
