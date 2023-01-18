<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Tests\Feature\Videos\VideosManageControllerTest;

class VideosManageController extends Controller
{
    public static function testedBy()
    {
        return VideosManageControllerTest::class;
    }
    public function index()
    {
        return view('videos.manage.index',[
            'videos' => Video::all()
        ]);
    }

//    public function create()
//    {
//        //
//    }

    public function store(Request $request)
    {
//        return response()->view('videos.manage.index',['videos'=>[]],201);
        Video::create([
            'title' =>$request->title,
            'description' =>$request->description,
            'url' =>$request->url,
        ]);

        session()->flash('status', 'Successfully created');

        return redirect()->route('manage.videos');



    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
