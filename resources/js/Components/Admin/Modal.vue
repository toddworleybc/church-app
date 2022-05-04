<script setup>
    import { computed, ref } from 'vue';
  
    const props = defineProps({ modal: Object });
  
    const modalToggle = computed( () => {
        if(props.modal.status === 'open') return true;
        if(props.modal.status === 'false') return false;
    } );

    const closeModal = function() {
        props.modal.status = 'false';
    }

</script>
<template>
<div v-if="modalToggle">

    <div id="modal" @click.self="closeModal" class="absolute w-full h-full bg-gray-900 bg-opacity-90 z-10">

        <div class="w-5/6 bg-white absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 h-5/6 overflow-y-scroll py-6 px-10 z-50">

            <div class="flex justify-between pb-4 border-b-1 border-gray-500 ">
                <h3>{{ modal.heading }}</h3>
                <span class="cursor-pointer" @click="closeModal">X</span>
            </div>

            <slot />
        </div>

    </div>

</div>
    
</template>
