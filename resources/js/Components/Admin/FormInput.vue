<script setup>
import uuid from "@/Functions/randomId.js";
import { computed, ref, onMounted } from "vue";

const emit = defineEmits(['fileUploaded', 'update:modelValue']);


   const props = defineProps({
        checkboxes: Object,
        checkboxesInline: Boolean,
        cols: String,
        disabled: Boolean,
        id: String,
        inputClass: String,
        hidden: Boolean, 
        label: String,
        modelValue: String|Array,
        name: String,
        options: Object,
        placeholder: String,
        radios: Object,
        radioInline: Boolean,
        rows: String,
        selectPlaceholder: String,
        type: String,
        width: String,
        errors: String,
        idu: Boolean,
    });


const uid = uuid();
  
const id = !props.idu ? `${props.id}` : `${props.id}-${uid}`;

const checkboxesSelected = ref([]);

let selectPlaceholder = props.selectPlaceholder;

const setCheckboxRadiosDefaults = onMounted( () => {

    const types = ['checkboxes', 'radios'];

    if(!types.includes(props.type)) return;

    const checkboxRadioObject = props.type === 'checkboxes' ? props.checkboxes : props.radios;    

    for (const box in checkboxRadioObject) {

        if (Object.hasOwnProperty.call(checkboxRadioObject, box)) {

            const boxProps = checkboxRadioObject[box];

            if(props.type === "radios")  if(boxProps.default) emit("update:modelValue", boxProps.value);
            

            if(props.type === "checkboxes") {
                
                if(boxProps.default) checkboxesSelected.value.push(boxProps.value);
                
                emit("update:modelValue", checkboxesSelected);
            }
            
        }
    }

});


const setSelectOptionDefault = onMounted( () => {

    for (const option in props.options) {
        if (Object.hasOwnProperty.call(props.options, option)) {
            const optionProps = props.options[option];

                if(optionProps.selected === true) {
                    selectPlaceholder = false;
                    emit("update:modelValue", optionProps.value);
                }
        
        }
    }

} );


const marginClass = computed( () => {
        
        let iClass = 'mb-4';

       if(props.inputClass) return props.inputClass;


       if(props.errors) iClass = 'mb-2';

        return iClass;

    } );
    

    const inputType = computed( () => {

        let type = props.type;

        if(
            type === 'text' ||
            type === 'email' ||
            type === 'phone' ||
            type === 'url'
        ) {
            return 'text';
        }

        return type;

    } );
    

// FUNCTIONS ===============/

    function removeSelectPlaceholderClass(e) {

            if(!props.selectPlaceholder) return;

            const select = e.target;

            if(select.classList.contains('text-gray-400')) select.classList.remove('text-gray-400');
    }

</script>

<template>

<div>
        <!-- DATE  -->
    <div v-if="inputType === 'date'" :class="inputClass ?? 'mb-6'">
        <label v-if="!hidden && label" :class="['block', marginClass]" :for="id">{{ label }}</label>
        <p v-if="!hidden && errors" class="text-red-600">{{ errors }}</p>
            <input 
                :id="id" 
                :type="type" 
                :name="name" 
                :class="width ?? 'w-full'"
                :disabled="disabled"
                :hidden="hidden"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
            >
    </div>



    <!-- RADIO -->
        <div v-if="inputType === 'radios'" :class="{'flex justify-start space-x-4': radioInline}">
            <p v-if="!hidden && errors" class="text-red-600">{{ errors }}</p>
            <div class="mb-2" v-for="(radio, i) in radios" :key="`${i}-${uid}`" >
                <label v-if="!hidden && radio.label" class="mr-2 cursor-pointer" :for="`${i}-${uid}`">{{ radio.label }}</label>
                <input 
                :id="`${i}-${uid}`" 
                class="cursor-pointer" 
                type="radio" 
                :value="radio.value"
                :name="radio.name" 
                :checked="radio.default"
                @input="$emit('update:modelValue', $event.target.value)"
            >
            </div>
        </div>

    <!-- Checkboxes -->
        <div v-if="inputType === 'checkboxes'" :class="{'flex justify-start space-x-4': checkboxesInline}">
            <p v-if="!hidden && errors" class="text-red-600">{{ errors }}</p>
            <div class="mb-2" v-for="(checkbox, i) in checkboxes" :key="`${i}-${uid}`" >
                <label v-if="!hidden && checkbox.label" class="mr-2 cursor-pointer" :for="`${i}-${uid}`">{{ checkbox.label }}</label>
                <input 
                :id="`${i}-${uid}`" 
                class="cursor-pointer" 
                type="checkbox" 
                :value="checkbox.value"
                :name="checkbox.name"
                v-model="checkboxesSelected"
                @change="$emit('update:modelValue', checkboxesSelected)"
            >
            </div>
        </div>


    <!-- TEXT  -->
        <div v-if="inputType === 'text'" :class="inputClass ?? 'mb-6'">
            <label v-if="!hidden && label" :class="['block', marginClass]" :for="id">{{ label }}</label>
            <p v-if="!hidden && errors" class="text-red-600">{{ errors }}</p>
            <input 
                :id="id" 
                type="text" 
                :name="name" 
                :class="width ?? 'w-full'" 
                :placeholder="placeholder"
                :disabled="disabled"
                :hidden="hidden"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
            >
        </div>

    <!-- TEXTAREA  -->
        <div v-if="inputType === 'textarea'" :class="inputClass ?? 'mb-6'">
            <label v-if="!hidden && label" :class="['block', marginClass]" :for="id">{{ label }}</label>
            <p v-if="!hidden && errors" class="text-red-600">{{ errors }}</p>
            <textarea 
                :name="name" 
                :id="id" 
                :cols="cols"
                :class="width ?? 'w-full'" 
                :rows="rows ?? '10'"
                :disabled="disabled"
                :hidden="hidden"
                :placeholder="placeholder"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
            ></textarea>
        </div>



    <!-- FILE  -->

    <div v-if="inputType === 'file'" :class="inputClass ?? 'mb-6'">
            <label v-if="!hidden && label" :class="['block', marginClass]" :for="id">{{ label }}</label>
            <p v-if="!hidden && errors" class="text-red-600">{{ errors }}</p>
            <input 
                :name="name" 
                :id="id"
                type="file" 
                :class="width ?? 'w-full'" 
                :disabled="disabled"
                :hidden="hidden"
                :value="modelValue"
                @change="$emit('fileUploaded', $event.target.files[0])"
            >
        </div>

        <!-- SELECT  -->
    <div v-if="inputType === 'select'" :class="inputClass ?? 'mb-6'">
        <label v-if="!hidden && label" :class="['block', marginClass]" :for="id">{{ label }}</label>
        <p v-if="!hidden && errors" class="text-red-600">{{ errors }}</p>
        
        <select 
            :name="name" 
            :id="id"
            :class="[
                width ?? 'w-full', 
                {'text-gray-400': selectPlaceholder},
            ]"
            :disabled="disabled"
            @change.stop="removeSelectPlaceholderClass"
            @input="$emit('update:modelValue', $event.target.value)"
        >
        
        <!-- placeholder option  -->
            <option v-if="selectPlaceholder" selected disabled hidden>-- {{ selectPlaceholder }} --</option>

            <option v-for="(option,i) in options" :value="option.value" class="text-gray-800" :key="i" :selected="option.selected && !selectPlaceholder">{{ option.label }}</option>
        </select>


    </div>
    <!-- select  -->

     <button v-if="inputType === 'submit'" type="submit" class="mb-2 text-blue-600 hover:text-blue-800 cursor-pointer">{{ label }}</button>

</div>
 
</template>