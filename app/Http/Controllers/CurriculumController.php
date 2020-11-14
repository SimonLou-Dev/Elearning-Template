<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Managers\VideoManager;
use App\Section;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CurriculumController extends Controller
{
    public function __construct(VideoManager $videoManager){
        $this->videoManager = $videoManager;
    }

    public function index($id)
    {
        $course = Course::find($id);
        return view('instructor.curriculum.index', ['course'=>$course]);
    }
    public function create($id){
        $course = Course::find($id);
        return view('instructor.curriculum.create', ['course'=>$course]);
    }

    public function store($id, Request $request){
        $section = new Section();
        $slug = new Slugify();
        $course = Course::find($id);
        $section->name = $request->input('section_name');
        $section->slug = $slug->slugify($section->name);
        $path = 'public/courses_sections/'. Auth::user()->id;
        $finename = $this->videoManager->viedoStrorage($request->file('section_video'),$path);



        $section->video = $finename;
        $section->course_id = $id;

        $getID3 = new \getID3();
        $path2 = 'storage/courses_sections/'. Auth::user()->id;
        $fileAnalyse = $getID3->analyze($path2 . '/'. $finename);
        $playtime = $fileAnalyse['playtime_string'];

        $section->playtime_seconds = $playtime;
        $section->save();

        return redirect()->route('instructor.curriculum.index', $course->id);

    }

    public function edit($id, $sectionID){
        $course = Course::find($id);
        $section = Section::find($sectionID);

        return view('instructor.curriculum.edit', ['course'=>$course, 'section'=>$section]);
    }

    public function update(Request $request, $id, $sectionID){
        $slug = new Slugify();
        $course = Course::find($id);
        $section = Section::find($sectionID);

        if($request->input('section_name')){
            //update section name
            $section->name = $request->input('section_name');
            $section->slug= $slug->slugify($section->name);
        }

        if($request->file('section_video')){
            $path = 'public/courses_sections/'. Auth::user()->id;
            $finename = $this->videoManager->viedoStrorage($request->file('section_video'),$path);

            $section->video = $finename;
            $getID3 = new \getID3();
            $path2 = 'storage/courses_sections/'. Auth::user()->id;
            $fileAnalyse = $getID3->analyze($path2 . '/'. $finename);
            $playtime = $fileAnalyse['playtime_string'];

            $section->playtime_seconds = $playtime;
        }

        $section->save();

        return redirect()->route('instructor.curriculum.index', $course->id)->with('success', 'La section a bien été modifiée');
    }

    public function destroy($id, $sectionID){
        $section = Section::find($sectionID);
        $course = Course::find($id);
        $pathname = 'public/courses_sections/'. Auth::user()->id . '/'. $section->video;
        if(Storage::exists($pathname)){
            Storage::delete($pathname);
        }
        $section->delete();
        return redirect()->route('instructor.curriculum.index', $course->id)->with('success', 'La section a bien été supprimée');



    }


}
