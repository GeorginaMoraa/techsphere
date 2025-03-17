<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const textarea = ref(null);

onMounted(() => {
    if (textarea.value.hasAttribute('autofocus')) {
        textarea.value.focus();
    }
});

defineExpose({ focus: () => textarea.value.focus() });
</script>

<template>
    <textarea
        class="border-navy-500 text-gold-500 dark:border-navy-700 dark:bg-navy-900 dark:text-gold-400 focus:border-gold-500 dark:focus:border-gold-600 focus:ring-gold-500 dark:focus:ring-gold-600 w-full rounded-md shadow-sm"
        v-model="model"
        ref="textarea"
        rows="4"
    ></textarea>
</template>

<style scoped>
/* Define custom colors for TechSphere */
:root {
    --navy-500: #001f3f;
    --navy-700: #00132b;
    --navy-900: #000a1a;
    --gold-500: #ffd700;
    --gold-400: #ffcc00;
    --gold-600: #e6b800;
}
</style>
