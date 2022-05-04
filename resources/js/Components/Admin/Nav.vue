<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>


<template>
    
    <nav class="h-screen md:w-40 bg-gray-900 shadow shadow-gray-500">
        <ul role="navigation" class="w-full space-y-5 py-6 px-2" >
            <li class="text-white"><Link :href="route('admin')">Dashboard</Link></li>
            <li class="text-white"><Link :href="route('teachings.index')">Teachings</Link></li>
        </ul>
    </nav>


</template>