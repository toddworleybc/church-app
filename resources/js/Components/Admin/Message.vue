<script setup>
import { computed, onBeforeMount, onMounted, onUpdated, ref, watch } from 'vue';
import { HalfCircleSpinner } from 'epic-spinners';

/* 
    - big: enlarge message
    - loader: add loader to message
    - text: custom message else "Loading..." is default
    - type: message type ['warning', 'success', 'info', 'error'] 
*/

//============ Props ============/
    const props = defineProps({
        big: String,
        loader: Boolean,
        text: String,
        type: String,
        html: Boolean
    });




//========== Variables =========/
    const color = ref(null);
    const loaderFill = ref(null);



//====== Computed ===============/

    const messageSize = computed( () => {
        return props.big ? "text-lg" : "";
    } );


//========== OnMounted ================/
onMounted(loaderSet);


//============ OnUpdated ===============/
onUpdated( loaderSet );


//============== Functions ===============/


function loaderSet() {

    switch(props.type) {
        case "warning":
            color.value = "border border-2 bg-yellow-100 border-yellow-200 text-yellow-800";
            loaderFill.value = "#854d0e";
            break;
        
        case "success":
            color.value = "border border-2 bg-emerald-100 border-emerald-200 text-emerald-800";
            loaderFill.value = "#065f46"
            break;

        case "error":
            color.value = "border border-2 bg-rose-100 border-rose-200 text-rose-800";
            loaderFill.value = "#9f1239"
            break;

        case "info":
            color.value = "border border-2 bg-sky-100 border-sky-200 text-sky-800";
            loaderFill.value = "#075985"
            break;

        default : 
            color.value = "text-gray-600";
            loaderFill.value = "initial";
            break;
    }

}

</script>
<template>
    <div class="my-3">
        

        <div class="py-2 px-4 rounded flex items-center" :class="[color, messageSize]">
            
            <span v-if="!html">{{text ?? "Loading..."}}</span>
            <span v-else v-html="text"></span>
            <HalfCircleSpinner v-if="loader" class="ml-1" :color="loaderFill" :size="20" />
                        
        </div>

    </div>
</template>


