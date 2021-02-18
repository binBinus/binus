<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use App\Models\Video;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function videoUpload(Request $request)
    {
        $subject = Subject::find($request->input('subject_id'));
        $data = $request->all();
        $video = new Video($data);
        $video->file_path = str_replace('watch?v=', 'embed/', $video->file_path);
        $subject->videos()->save($video);

        return redirect()->back()->with('message2', 'Congratulations! Your Video has been saved.');
    }

    public function showVideo($id)
    {
        $user = User::find(Auth::id());
        $subject = Subject::find($id);
        if($user->role == 0) {
            return view('lecturer.viewvideo', ['data' => $subject->videos]);
        } else {
            return view('student.viewvideo', ['data' => $subject->videos]);
        }
    }
}
