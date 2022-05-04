<script setup>
    defineProps({
        heading: String,
        width: String
    });

</script>

<template>
    <div class="shadow-lg" :class="[width, 'mb-8']">
        <div class="bg-white shadow-inline px-6 rounded shadow-inner h-full py-6">
            <h3 class="mb-10 text-lg">{{ heading }}</h3>
            <slot />
        </div>
    </div>
</template>