<script setup>
import Group from '@/Components/Admin/FormGroup.vue';
import Input from '@/Components/Admin/FormInput.vue';
import Message from '@/Components/Admin/Message.vue';
import Well from '@/Components/Admin/Well.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { onMounted, ref } from 'vue';

const emit = defineEmits(['save-teaching']);

const storageCheckboxes = {
    checkbox1: {
        label: 'Youtube',
        name: 'storage_option',
        value: 'youtube',
        default: true
    },
    checkbox2: {
        label: 'Cloud',
        name: 'storage_option',
        value: 'cloud'
    }
}


const videoPrivacyOptions = {
        option1: {
            value: 'private',
            label: 'Private',
            selected: true
        },
        option2: {
            value: 'public',
            label: 'Public'
        }
    
}


let showVideoInfo = ref(false);


const setVideoUpload = (file) => {

    const videoPlayer = document.getElementById('video-player'),
          videoName = document.getElementById('video-name'),
          videoSize = document.getElementById('video-size'),
          videoType = document.getElementById('video-type'),
          reader = new FileReader(),
          fileSize = (parseInt(file.size)*0.000001).toString().substring(0,4) + " MB";

         videoName.innerText = file.name;
         videoSize.innerText = fileSize;
         videoType.innerText = file.type.match(/(?<=video\/)\w+$/);


        reader.readAsDataURL(file);
        reader.onload = function() {
            videoPlayer.src = reader.result;
            showVideoInfo.value = true;
        }

        form.video_file = file;

}



// FORMS =======================/


const form = useForm({
    title: null,
    description: null,
    video_file: null,
    privacy: null,
    storage: []
});


function formSubmit() {
    emit('save-teaching');
    form.post(route('teaching_upload_video'));
}

</script>

<template>
    <div id="video-upload">
        
        <p class="text-red-600" v-if="form.errors.video_file">{{ form.errors.video_file }}</p>

        <div class="flex justify-between">

            <div id="video-preview" class="w-1/2 pr-2 border-r border-gray-400">

                <video id="video-player" type="video/mp4" class="w-full h-auto mb-4" controls="true"></video>
                
                <div class="mb-5">
                    <label for="video-file" class="mb-2 text-blue-600 hover:text-blue-800 cursor-pointer">Upload Video</label>
                </div>

                <ul v-show="showVideoInfo" class="space-y-4">
                    <li>Name: <span id="video-name"></span></li>
                    <li>Size: <span id="video-size"></span></li>
                    <li>Type: <span id="video-type"></span></li>
                </ul>

            </div>

            <div id="video-form" class="w-1/2 pl-2">

                <form @submit.prevent="formSubmit" enctype="multipart/form-data">

                    <Group>
                        <Input type="checkboxes" :checkboxes="storageCheckboxes" name="storage_option" :checkboxesInline="true" v-model="form.storage" :errors="form.errors.storage" />
                    </Group>

                    <Input id="video-privacy" type="select" label="Youtube Video Privacy" width="w-1/2" :options="videoPrivacyOptions" v-model="form.privacy" :errors="form.errors.privacy" />

                    <Input id="video-file" type="file" @file-uploaded="setVideoUpload" :hidden="true"/>

                    <Input id="video-title" type="text" label="Enter Title" name="video_title" v-model="form.title" :errors="form.errors.title"/>
                    <Input id="video-description" inputClass="mb-0" :idu="true" type="textarea" label="Enter Description" name="video_description" v-model="form.description"/>
                   

                    <Input type="submit" label="Submit" />

                </form>

            </div>



        </div>
  
    </div>
</template>