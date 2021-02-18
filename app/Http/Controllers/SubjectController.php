<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Task;
use App\Models\Video;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;


class SubjectController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request) 
    {
        $data = $request->all();
        $subject = new Subject($data);
        $subject->save();

        $base_url = "http://application-development.test/class/"; //change this later when published to host
        $subject->image_path = "https://chart.googleapis.com/chart?cht=qr&chl=" . $base_url . $request->input('subject_name') . "/" . $request->input('subject_code') . "&chs=160x160&chld=L|0";
        
        

        $subject->save();

        return redirect()
            ->action([SubjectController::class, 'showSubject'], [$subject->subject_name, $subject->subject_code]);
    }

    public function showSubject($subject_name, $subject_code) {
        $data = Subject::where('subject_name', $subject_name)
            ->where('subject_code', $subject_code)->first();

        return view('lecturer.createclass', ['data'=>$data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function showTask($id)
    {
        $user = User::find(Auth::id());
        $subject = Subject::find($id);
        
        
        // $data = Task::where('subject_name', $subject_name)->where('subject_code', $subject_code)->get();
        // $data = $data->sortby('task_date');
        
        if ($user->role == 0) {
            return view('lecturer.viewtask', ['data' => $subject->tasks])->with('subject_name',$subject->subject_name);
        }   else {
            return view('student.viewtask', ['data' => $subject->tasks])->with('subject_name', $subject->subject_name);
        }

    }

    public function addTask(Request $request)
    {
        $subject = Subject::find($request->input('subject_id'));
        $data = $request->all();
        $task = new Task($data);
        $subject->tasks()->save($task);

        return redirect()->back()->with('message1', 'Congratulations! Your Task has been created.');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function findSubject() {
        $profile = User::find(Auth::id());
        
        if ($profile->role == 0) {
            $class = Subject::where('teacher_id', Auth::id())->get();
            return view('lecturer.lecturerprofile', ['class' => $class]);
        }   else {
            $class = $profile->subjects;
            return view('student.studentprofile', ['class' => $class]);
        }
        
    }

    public function edit(Request $request)
    {
        Subject::where('subject_code', $request->input('subject_code'))->update([
            'subject_day'=>$request->input('subject_day'),
            'time_from'=>$request->input('time_from'),
            'time_to'=>$request->input('time_to'),
            'max_participant'=>$request->input('max_participant')
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $user = User::find(Auth::id());
        $subject = Subject::find($request->input('subject_id'));

        if($user->role == 1) {
            $user->subjects()->detach($request->input('subject_id'));
            $subject->curr_participant--;
        }   else {
            foreach($subject->tasks as $item) {
                $item->delete();
            }
            foreach ($subject->videos as $item) {
                $item->delete();
            }
            $subject->delete();    
        }
        return redirect()->back();

    }
}
