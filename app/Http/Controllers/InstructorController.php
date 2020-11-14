<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('instructor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return  view('instructor.create', [
            'categories'=> $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = new Course();
        $slug = new Slugify();
        $course->title = $request->input('title');
        $course->subtitle = $request->input('subtitle');
        $course->description = $request->input('description');
        $course->slug = $slug->slugify($course->title);
        $course->category_id=$request->input('category');
        $course->user_id= Auth::user()->id;

        $image = $request->file('image');
        $imgFullName = $image->getClientOriginalName();
        $imgName = pathinfo($imgFullName, PATHINFO_FILENAME);
        $imgExt = $image->getClientOriginalExtension();
        $file = time() . '_' . $imgName . '.' . $imgExt;
        $course->image = $file;
        $course->save();
        $image->storeAs('public/courses/'. Auth::user()->id, $file);
        return redirect()->route('instructor.index')->with('success', 'Votre cours à bien été créé.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $course = Course::find($id);
        return view('instructor.edit', ['course'=> $course, 'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        $slug = new Slugify();
        $course->title = $request->input('title');
        $course->subtitle = $request->input('subtitle');
        $course->description = $request->input('description');
        $course->slug = $slug->slugify($course->title);
        $course->category_id=$request->input('category');
        if($request->file('image')){
            $image = $request->file('image');
            $imgFullName = $image->getClientOriginalName();
            $imgName = pathinfo($imgFullName, PATHINFO_FILENAME);
            $imgExt = $image->getClientOriginalExtension();
            $file = time() . '_' . $imgName . '.' . $imgExt;
            $course->image = $file;
            $image->storeAs('public/courses/'. Auth::user()->id, $file);
        }

        $course->save();
        return redirect()->route('instructor.index')->with('success', 'Vos modifications ont été apportées avec succes.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        return redirect()->route('instructor.index')->with('success', 'Le cours a bien été supprimé!');

    }

    public function publish($id){
        $course = Course::find($id);
        if($course->price && count($course->sections) >0){
            $course->is_published = true;
            $course->save();
            return redirect()->back()->with('success', 'Votre cours '. $course->name . ' a bien été publié');
        }else{
            return redirect()->back()->with('danger', 'Votre cours doit avoir un prix et au moins une section avant d\'être publiable');
        }


    }
}
