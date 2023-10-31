<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Video; // Import the Video model

class VideosController extends Controller
{
    public function index()
    {
        // Retrieve all videos from the database
        $videos = Video::all();

        // Return the videos as a JSON response
        return response()->json(['videos' => $videos], 200);
    }

    public function show($videoId)
    {
        // Retrieve a specific video based on its ID
        $video = Video::find($videoId);

        // If the video is not found, return a 404 response
        if (!$video) {
            return response()->json(['message' => 'Video not found'], 404);
        }

        // Return the video details as a JSON response
        return response()->json(['video' => $video], 200);
    }
    public function classVideos(Request $request, $classId)
{
    // Get the authenticated user
    $user = Auth::user();

    // Retrieve the class based on the ID
    $class = Classes::find($classId);

    // Check if the class exists
    if (!$class) {
        return response()->json(['message' => 'Class not found'], 404);
    }

    // Check if the user is enrolled in the course of the class
    if (!$user->courses->contains($class->course)) {
        return response()->json(['message' => 'You are not enrolled in this course'], 403);
    }

    // Retrieve all videos for the class from the database
    $videos = $class->videos;

    // Return the videos as a JSON response
    return response()->json(['videos' => $videos], 200);
}

}
