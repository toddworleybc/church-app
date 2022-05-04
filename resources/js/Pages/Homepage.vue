<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <nav class="bg-gray-400 py-4">
        <ul role="navigation" class="w-4/5 mx-auto flex justify-end space-x-3">
            <li class="text-gray-800 hover:text-gray-600 active:text-blue-400"><Link :href="route('admin')">Admin</Link></li>
            <li class="text-gray-800 hover:text-gray-600 active:text-blue-400"><Link href="#">Login</Link></li>
            <li class="text-gray-800 hover:text-gray-600 active:text-blue-400"><Link href="#">Register</Link></li>
        </ul>
    </nav>
</template>