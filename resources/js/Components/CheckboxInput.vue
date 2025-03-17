<template>
    <div class="checkbox-group">
        <label
            v-for="category in categories"
            :key="category"
            class="checkbox-label"
        >
            <input
                type="checkbox"
                :value="category"
                v-model="selectedCategories"
            />
            {{ category }}
        </label>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: Array, // Sync with parent component
    },
    data() {
        return {
            categories: [
                'AI & Machine Learning',
                'Software Development',
                'Cybersecurity',
                'Gadgets & Devices',
                'Web & Mobile Development',
                'Blockchain & Cryptocurrency',
                'Cloud Computing',
                'Data Science & Big Data',
                'Networking & Infrastructure',
                'Tech Business & Startups',
                'Open Source & DevOps',
                'Programming Languages',
                'Gaming & Esports',
                'Virtual & Augmented Reality',
                'Tech Reviews & Comparisons',
                'Green Tech & Sustainability',
                'Innovation & Emerging Tech',
                'Tech Laws & Policies',
                'Science & Space Tech',
                'UI/UX & Design Trends',
                'Wearable Tech & IoT',
                'Hacking & Ethical Hacking',
                'Tech Culture & Society',
                'Programming Tips & Tutorials',
                'Future Tech & Predictions',
                'Coding Challenges & Projects',
                'Tech News & Opinions',
                'Tech Events & Conferences',
                'Other',
            ],
            selectedCategories: this.modelValue || [],
        };
    },
    watch: {
        selectedCategories(newVal) {
            this.$emit('update:modelValue', newVal);
        },
    },
};
</script>

<style scoped>
.checkbox-group {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
.checkbox-label {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 14px;
}
</style>
