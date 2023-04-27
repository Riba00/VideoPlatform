<?php

namespace App\Http\Controllers;

use App\Events\VideoCreated;
use App\Models\Video;
use Doctrine\DBAL\Exception\DatabaseDoesNotExist;
use Illuminate\Http\Request;
use Tests\Feature\Videos\VideosManageControllerTest;

class VideosManageController extends Controller
{
    public function index()
    {
        return view('videos.manage.index', [
            'videos' => Video::all()
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'required',
        ]);

        $video = Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'serie_id' => $request->serie_id,
            'user_id' => $request->user_id
        ]);

        session()->flash('status', 'Successfully created');

        VideoCreated::dispatch($video);

        return redirect()->route('manage.videos');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('videos.manage.edit', ['video' => Video::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);
        $video->title = $request->title;
        $video->description = $request->description;
        $video->url = $request->url;
        $video->save();

        session()->flash('status', 'Successfully updated');
        return redirect()->route('manage.videos');
    }

    public function destroy($id)
    {
        Video::find($id)->delete();
        session()->flash('status', 'Successfully removed');

        return redirect()->route('manage.videos');
    }
}
