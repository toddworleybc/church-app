<script setup>
import AdminLayout from "@/Layouts/Admin.vue";
import { Link } from "@inertiajs/inertia-vue3";
</script>


<template>
    <AdminLayout>
        <h1>Teachings</h1>
        <div v-if="$page.props.flash.message === 'success'" class="bg-green-600 text-white border  border-green-800">Success</div>
        <div class="mt-10">
            <ul>
                <li><Link :href="route('teachings.create')">Create</Link></li>
            </ul>
        </div>
    </AdminLayout>
</template>