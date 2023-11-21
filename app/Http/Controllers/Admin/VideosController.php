<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Video;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideosController extends Controller
{
    public function index()
    {
        $videos = Video::with('Classes')->get();
        return view('Admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::all(); // Fetch classes from your model
        return view('Admin.videos.create', compact('classes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'video_subject' => 'required',
            'video_date' => 'required',
            'video_file' => 'required|file|mimes:mp4',
            'class_id' => 'required|exists:classes,id',
        ]);

        $videoData = $request->except('video_file');

        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $folder = public_path('videos');
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $file->move($folder, $filename);
            $videoData['video_file'] = 'videos/' . $filename;
        }

        $videoData['video_date'] = Carbon::createFromFormat('d F, Y', $videoData['video_date'])->format('Y-m-d');
        Video::create($videoData);

        return redirect('admin/videos')->with('status', 'video created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(video $video)
    {

        return view('Admin.videos.show', compact('video'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    $video = video::findOrFail($id);
    $classes = Classes::all(); // Fetch classes from your model
    return view('Admin.videos.edit', compact('video', 'classes'));
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
        $request->validate([
            'video_subject' => 'required',
            'video_date' => 'required',
            'class_id' => 'required|exists:classes,id',
        ]);

        $videoData = $request->except(['video_file', '_method', '_token']);

        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $filePath = $file->store('videos', 'public');
            $videoData['video_file'] = $filePath;
        }

        $videoData['video_date'] = Carbon::createFromFormat('d F, Y', $videoData['video_date'])->format('Y-m-d');

        $video = video::findOrFail($id);
        $video->update($videoData);

        return redirect('admin/videos')->with('status', 'video updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(video $video)
    {
        $video->delete();

        return redirect('admin/videos')->with('status', 'video member deleted successfully.');
    }

}


