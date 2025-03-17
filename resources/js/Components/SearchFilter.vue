<template>
    <div class="flex items-center">
        <div class="flex w-full rounded shadow">
            <dropdown
                :auto-close="false"
                class="to-gold-500 rounded-l border-r border-gray-500 bg-gradient-to-r from-black px-4 hover:bg-opacity-80 focus:z-10 focus:border-gray-300 focus:ring md:px-6"
                placement="bottom-start"
            >
                <template #default>
                    <div class="flex items-baseline">
                        <span
                            class="text-gold-500 dark:text-gold-400 hidden font-bold md:inline"
                            >Category</span
                        >
                        <svg
                            class="h-2 w-2 fill-gray-300 md:ml-2"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 961.243 599.998"
                        >
                            <path
                                d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z"
                            />
                        </svg>
                    </div>
                </template>
                <template #dropdown>
                    <div
                        class="mt-2 w-screen max-w-3xl rounded-lg bg-white px-6 py-6 shadow-2xl transition-all duration-300 ease-in-out dark:bg-gray-800 dark:text-gray-300 dark:shadow-lg"
                        :style="{ maxWidth: `${maxWidth}px` }"
                    >
                        <slot />
                    </div>
                </template>
            </dropdown>

            <input
                class="dark:text-gold-300 dark:focus:border-gold-400 dark:focus:ring-gold-400 relative w-full rounded-r border-gray-300 px-6 py-3 text-gray-800 shadow-sm dark:border-gray-700 dark:bg-gray-900"
                autocomplete="on"
                type="text"
                name="search"
                placeholder="Search TechSphere Blogs…"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
            />
        </div>
        <button
            class="text-gold hover:text-gold-600 dark:hover:text-gold-300 from-gold ml-3 rounded-lg bg-gradient-to-r to-gray-100 px-4 py-2 text-sm font-bold shadow-lg transition dark:from-gray-800 dark:to-gray-700 dark:text-white"
            type="button"
            @click="$emit('reset')"
        >
            Clear
        </button>
    </div>
</template>

<script>
import Dropdown from '@/Components/Dropdown.vue';

export default {
    components: {
        Dropdown,
    },
    props: {
        modelValue: String,
        maxWidth: {
            type: Number,
            default: 300,
        },
    },
    emits: ['update:modelValue', 'reset'],
};
</script>
