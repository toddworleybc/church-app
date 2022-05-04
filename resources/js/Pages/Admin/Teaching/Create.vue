<script setup>

// imports ============== //
import AdminLayout from '@/Layouts/Admin.vue';
import Group from '@/Components/Admin/FormGroup.vue';
import Input from '@/Components/Admin/FormInput.vue';
import Message from '@/Components/Admin/Message.vue';
import Modal from '@/Components/Admin/Modal.vue';
import VideoUpload from '@/Components/Admin/ModalTemplates/videoUpload.vue';
import Well from '@/Components/Admin/Well.vue';
import moment from "moment";
import modalControl from '@/Functions/modal.js';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref, onBeforeMount, onMounted } from 'vue';

//======== VARIABLES ========/
// ============================== 

const videoReady = ref(false);

// sets and controls window modal
const modal = ref(new modalControl());


// USED FOR YOUTUBE ===/
// const yt = ref({
//     loading: false,
//     text: null,
//     status: null
// });


// primary form being submited
let form = useForm('CreateTeaching', {
        title: null,
        title_type: null,
        speaker: null,
        description: null,
        video_url: null,
        audio_url: null,
        primary_text: null,
        scripture: `<h3>Genesis 3:14</h3><p>In the begining God created the heavens and the earth</p><p>Earth was and endless void</p>`,
        secondary_text: null,
        publish_date: moment().format('YYYY-MM-DD'),
        featured_img: '/public/yourpic.jpg',
});


// title radios ===========//
const titleRadios = {
    radio1: {
        label: 'Topical',
        name: 'title_option',
        value: 'topical',
        default: true,
        idU: true
    },

    radio2: {
        label: 'Scripture',
        name: 'title_option',
        value: 'scripture',
        idU: true
    }
} // end of radios




//====== BEFORE MOUNT =======================/
onBeforeMount(restoreRadios);
// onBeforeMount(submitYtVideo); // youtube function





//=========== MOUNTED =======================/
// onMounted(restoreTempTeaching); // Youtube function





//========== FUNCTIONS ==========================/



function formSubmit() {
    form.post(route('teachings.store'));
}


function restoreRadios()  {

        if(form.title_type) {

            for (const key in titleRadios) {

                if (Object.hasOwnProperty.call(titleRadios, key)) {

                    const radio = titleRadios[key];
                    
                    radio.default = form.title_type === radio.value ? true : false;

                }
            }

        }
}


// Youtube Functions to set and restore video ===============================/

// function restoreTempTeaching() {

//         const queryParams = new URLSearchParams(location.search),
//               keyArr = [...queryParams.keys()];
    

//           if(
//               keyArr.includes('code') && 
//               keyArr.includes('scope')
//             ) {

//                 const savedForm = localStorage.getItem('ebd_tsd'),
//                       formJson = JSON.parse(savedForm);


//                     for (const key in formJson) {

//                         if (Object.hasOwnProperty.call(formJson, key)) {
//                             const formField = formJson[key];

//                             if(formField) form[key] = formJson[key];

//                         }

//                     }

//                     localStorage.removeItem('ebd_tsd');
//                     restoreRadios();
//             }
// }



// function saveTempTeaching() {
//     const saveForm = JSON.stringify(form);
//     localStorage.setItem('ebd_tsd', saveForm);
// }


// function setYtVideo(video) {

    

//     const player =  document.getElementById("video-player"),
//           input  = document.getElementById('video-upload'),
//           id = video.id,
//           kind = video.kind;

//     if(kind === "youtube#video") {
        
//         const ytEmbedUrl = `http://www.youtube.com/embed/${id}?enablejsapi=1&origin=${window.location.origin}`,
//              ytNormalUrl = `https://youtu.be/${id}`;

        

//         player.src = ytEmbedUrl;
//         input.value = ytNormalUrl;
//         videoReady.value = true;  

//     } // end if


// }


// function submitYtVideo() {

//     const queryParams = new URLSearchParams(location.search),
//           queryKeys = [...queryParams.keys()];

//     if(queryKeys.length === 0) return;


//     if(
//         !queryKeys.includes('code') ||
//         !queryKeys.includes('scope')
//     ) return;


//     yt.value.loading = true;
//     yt.value.status = "warning";
//     yt.value.text = "Video uploading to Youtube! This may take a few minutes depending on your video size!";

//     // Scroll window to video load section
//         window.addEventListener('load', () => {
//            document.getElementById('video').scrollIntoView();
//         } );


//     const code = {authCode: [...queryParams.entries()][0][1]};

       
//        axios.post(route('upload_video_yt'),code)
//         .then( videoInfo => {

//             const video = videoInfo.data;

//             yt.value.text = "Video successfully uploaded to Youtube! Video will render in a minute";
            
//             yt.value.status = "success";
//             yt.value.loading = false;
            
//             setYtVideo(video);
         
//         } )
//         .catch( error => {
           
//                 let message = "";

//                 console.log(error.response);

//                 try {
                    
//                     const jsonError = JSON.parse(error.response.data.message);

//                     message = jsonError.error.message;
                  
//                 } catch (err) {
                    
//                     message = error.response.data.message;

//                 }

//                 yt.value.status = "error";
//                 yt.value.text = message;

//         } )
//         .then( () => {
//             yt.value.loading = false;
//         } );
    
// }

</script>

<template>

 <div id="teaching-create">

    <!-- <Modal :modal="modal">
        <VideoUpload @save-teaching="saveTempTeaching"/>
    </Modal> -->

    <AdminLayout>
        
        <h1 class="mb-10">Create Teaching</h1>

            <form @submit.prevent="formSubmit" enctype="multipart/form-data" class="flex justify-between items-start space-x-4">
                <div class="w-2/3">

                    <Well id="information" heading="Information">

                        <Group :border="true">
                            <Input id="title" type="text" label="Enter Title" v-model="form.title" :errors="form.errors.title" :idu="true"/>
                            <Input v-model="form.title_type" type="radios" :radios="titleRadios" :radioInline="true"/>
                        </Group>


                        <Input id="speaker" type="text" label="Speaker" v-model="form.speaker" :idu="true"/>
                        <Input id="description" type="textarea" label="Description" v-model="form.description" :idu="true"/>

                    </Well>
                    <!-- #/teaching-meta  -->


                    <Well id="media" heading="Media">
                        <Group :border="true">


                            <div id="video">

                                <Message
                                    v-if="yt.text" 
                                    :loader="yt.loading" 
                                    :type="yt.status" 
                                    :text="yt.text"
                                    :html="true" 
                                />
                                

                                <div  class="flex justify-between space-x-2 items-end">


                                <div id="video-container" class="w-1/2">
                                    
                                    <img class="w-full" src="//via.placeholder.com/1920x1080" alt="video">



                                    <video src=" https://ebd-church-app.sfo3.digitaloceanspaces.com/video/video.mp4" controls="true"></video>


                                    <!-- <iframe 
                                        v-if="videoReady"
                                        class="w-full"
                                        id="video-player" 
                                        type="text/html"
                                        frameborder="0"
                                    ></iframe> -->

                                </div>
                                <!-- #/video-container  -->

                                <div id="video-data" class="w-1/2">

                                    <div class="flex flex-wrap space-x-2">
                                        <button @click.prevent="modal.open" class="mb-2 text-blue-600 hover:text-blue-800" data-template="videoUpload" data-heading="Upload Video">Upload Video</button>
                                    </div>

                                    <Input id="video-upload" inputClass="mb-0" type="url" label="Video Url" v-model="form.video_url" :idu="true" />

                                </div>
                                <!-- #/video-data  -->

                                </div> 
                                <!-- flex  -->
                            </div>
                        </Group>
                        <!-- #/video -->

                        <div id="audio" class="flex justify-between space-x-2 items-end">

                            <div id="audio-container" class="w-1/2">
                                    
                                <img class="w-full" src="//via.placeholder.com/1920x1080" alt="audio">

                            </div>
                            <!-- #/audio-container  -->

                            <div id="audio-data" class="w-1/2">

                                <Input inputClass="mb-0" type="url" label="Audio Url" v-model="form.audio_url"/>

                            </div>
                            <!-- #/audio-data  -->

                        </div>
                        <!-- #/audio -->

                    </Well>


                    <Well id="main-text" heading="Teaching Text">

                        <Input type="textarea" label="Primary Text" v-model="form.primary_text"/>

                        <div class="border border-black">
                            <h3>Genesis 3:14</h3><p>In the begining God created the heavens and the earth</p><p>Earth was and endless void</p>
                        </div>
                        
                        <textarea v-model="form.scripture" id="" cols="30" rows="10"></textarea>
                        

                        <Input type="textarea" label="Secondary Text" v-model="form.secondary_text" />

                    </Well>
                    <!-- #/main-text  -->

                </div>
                <!-- end of main area  -->
                

                <div class="w-1/3">

                

                <Well id="teaching-destination" heading="Select Save destionation">
                    
                    <ul>
                        <li class="mb-2 text-blue-600 hover:text-blue-800"><button href="#">Save Draft</button></li>
                        <li class="mb-2 text-blue-600 hover:text-blue-800"><button href="#">Publish</button></li>

                        <Input id="publish-date" type="date" label="Enter Publish Date" v-model="form.publish_date"/>

                        <li class="mb-2 text-blue-600 hover:text-blue-800"><button href="#">Preview</button></li>
                    </ul>

                </Well>

                <Well>
                    <div id="img-container" class="mb-4">
                        <img src="//via.placeholder.com/1920x1080" alt="featured image">
                    </div>
                    <button class="mb-2 text-blue-600 hover:text-blue-800">Upload Image</button>
                </Well>

                </div>
                <!-- End of sidebar  -->
            </form>
            
    </AdminLayout>

 </div>


</template>