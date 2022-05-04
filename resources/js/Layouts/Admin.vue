<script setup>
import Nav from "@/Components/Admin/Nav.vue";
</script>


<template>
    <div id="admin" class="relative flex justify-start bg-gray-200 overflow-hidden">
        <Nav />
        <div class="w-60 flex-grow px-10 overflow-y-auto h-screen py-6 text-gray-600">
            <slot />
        </div>
    </div>
</template>