<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center pl-3 w-full text-md font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
        : 'inline-flex items-center w-full text-md font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true" v-if="active"></span>
        <slot />
    </Link>
</template>
