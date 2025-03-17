<template>
    <div v-if="links.length > 3">
        <div class="-mb-1 flex flex-wrap">
            <template v-for="(link, key) in links">
                <div
                    v-if="link.url === null"
                    :key="key"
                    class="bg-gold-100 ms-0 flex h-8 items-center justify-center rounded-s-lg border border-blue-800 px-3 font-black leading-tight text-yellow-500 hover:bg-yellow-200 hover:text-blue-800 dark:border-blue-900 dark:bg-blue-800 dark:text-blue-900 dark:hover:bg-blue-700 dark:hover:text-yellow-300"
                    v-html="link.label"
                />
                <Link
                    v-else
                    :key="`link-${key}`"
                    class="flex h-8 items-center justify-center border border-blue-800 bg-yellow-100 px-3 leading-tight text-yellow-500 hover:bg-yellow-200 hover:text-blue-800 dark:border-blue-900 dark:bg-blue-800 dark:text-yellow-300 dark:hover:bg-blue-700 dark:hover:text-yellow-200"
                    :class="{
                        'bg-purplium-500': link.active,
                        'text-white': link.active,
                        'dark:bg-greenium-500': link.active,
                        'dark:text-white': link.active,
                    }"
                    :href="link.url"
                >
                    <span v-html="link.label"></span>
                </Link>
            </template>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

defineProps({
    links: {
        type: Array,
        default: () => [],
    },
});
</script>
