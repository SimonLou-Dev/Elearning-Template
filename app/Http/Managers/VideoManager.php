<?php

namespace App\Http\Managers;

class VideoManager {

    public function viedoStrorage($video,  string $finalpath){
        $FullFile= $video->getClientOriginalName();
        $fileext= '.'.$video->getClientOriginalExtension();
        $file = md5(uniqid(rand(), true)) . $fileext;
        $video->storeAs($finalpath, $file);
        return $file;
    }


}