<script setup>
    const props = defineProps({
        border: Boolean
    });
</script>

<template>
    <div :class="[{'border-b border-gray-300 pb-2' : border}, 'mb-6']">
        <slot />
    </div>
</template>