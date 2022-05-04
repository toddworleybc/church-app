<?php

namespace App\Http\Controllers;

use App\Models\VideoUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;



// Classes for Youtube video upload to work are below. Currently not using this feature but using Digital Ocean Spaces instead. [========================================================================================================================================]
// use Google\Client as Google_Client;
// use Google\Service\Youtube as Google_Service_YouTube;
// use Google\Service\YouTube\Video as Google_Service_YouTube_Video;
// use Google\Service\Youtube\VideoSnippet as Google_Service_YouTube_VideoSnippet;
// use Google\Service\YouTube\VideoStatus as Google_Service_YouTube_VideoStatus;

class VideoUploadController extends Controller
{


    public function teaching_upload_video(Request $request) {





    }


//CODE BELOW IS USED FOR YOUTUBE VIDEO UPLOAD! MAY NOT USE THIS FEATURE!!! ==========================================================================/


    // public function upload_temp_video(Request $request) {

    //     // Makes sure all videos are cleared from youtube temp storage
    //         $this->clearTempVideos();
        


    //     // Store youtube temp video
    //         $videoStored = $this->store_video($request);


    //     $youtubeApiJson = json_decode(config('services.youtube_auth.json'), true);

        
    //     $client = new Google_Client();
    //     $client->setApplicationName('Church App');
    //     $client->setScopes([
    //         'https://www.googleapis.com/auth/youtube.upload',
    //     ]);
        
    
    //     $client->setAuthConfig($youtubeApiJson);
    //     $client->setAccessType('offline');
        
    //     // Request authorization from the user.
    //     $authUrl = $client->createAuthUrl();

    //     return Inertia::location($authUrl);
    

    // }



    // public function upload_video_yt(Request $request) {

    //     $videoInfo = VideoUpload::get()->last();

    //     $title = $videoInfo->title;
    //     $description = $videoInfo->description;
    //     $file = Storage::path($videoInfo->path);
       


    //     $authCode = $request->authCode;
    //     $youtubeApiJson = json_decode(config('services.youtube_auth.json'), true);


    //     $client = new Google_Client();


    //     $client->setAuthConfig($youtubeApiJson);
            
    //     // Exchange authorization code for an access token.
    //     $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
    //     $client->setAccessToken($accessToken);

        
    //     // Define service object for making API requests.
    //     $service = new Google_Service_YouTube($client);

    //     // Define the $video object, which will be uploaded as the request body.
    //     $video = new Google_Service_YouTube_Video();


    //     // Add 'snippet' object to the $video object.
    //     $videoSnippet = new Google_Service_YouTube_VideoSnippet();
    //     $videoSnippet->setCategoryId('22');
    //     $videoSnippet->setDescription($description);
    //     $videoSnippet->setTitle($title);
    //     $video->setSnippet($videoSnippet);


    //     // Add 'status' object to the $video object.
    //     $videoStatus = new Google_Service_YouTube_VideoStatus();
    //     $videoStatus->setPrivacyStatus('private');
    //     $video->setStatus($videoStatus);
        
       
        
    //     // TODO: For this request to work, you must replace "YOUR_FILE"
    //     //       with a pointer to the actual file you are uploading.
    //     //       The maximum file size for this operation is 274877906944.
    //     $response = $service->videos->insert(
    //         'snippet,status',
    //         $video,
    //         array(
    //         'data' => file_get_contents($file),
    //         'mimeType' => 'application/octet-stream',
    //         'uploadType' => 'multipart'
    //         )
    //     );
        
    //     return response()->json($response);
       
    // }


    // private function store_video($request) {

    //     $validated = $request->validate([
    //         'title' => 'required',
    //         'description' => 'required',
    //         'video_file' => 'required|mimes:mp4,avi,mpeg'
    //     ]);

    //     $title = $request->title;
    //     $description = $request->description;
    //     $file = $request->file('video_file');
    //     $privacy = $request->privacy;
    //     $path = $file->store('youtube_temp');
    //     $filename = $file->getClientOriginalName();
    //     $filesize = Storage::size($path);
        

    //    $videoUploaded = VideoUpload::create([
    //         'title' => $title,
    //         'description' => $description,
    //         'path' => $path,
    //         'size' => $filesize,
    //         'name' => $filename,
    //         'privacy' => $privacy
    //     ]);


    //     return $videoUploaded ? true : false;

    // }


    // private function clearTempVideos() {

    //     $videosToClear = VideoUpload::all();

    //     if(!empty($videosToClear)) {

    //         if(collect(Storage::directories())->contains('youtube_temp')) 
    //             Storage::deleteDirectory('youtube_temp');

    //         foreach( $videosToClear as $video)  $video->delete();
    //     }

    //     return;
    // }


}
