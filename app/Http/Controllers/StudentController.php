<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    public function urlLink($subject_name, $subject_code) {

        $data = Subject::where('subject_name', $subject_name)
        ->where('subject_code', $subject_code)->first();
        $teacher = User::find($data->teacher_id);

        return view('student.joinclass',['data' => $data])->with('teacher_name', $teacher->name);
    }

    public function findSubject(Request $request) {
        $data = explode("/", $request->input('url'));
        if(count($data) == 6) {
            $subject_name = $data[4];
            $subject_code = $data[5];
            return redirect()->action([StudentController::class, 'urlLink'], [$subject_name, $subject_code]);
        }
        else {
            return redirect()->back()->with('message', 'This QR Code is not associated with InstaClass');
        }
    }

    public function joinClass($subject_id) {

        try {
            $student = User::findOrFail(Auth::id());
            $student->subjects()->attach($subject_id);

            $subject = Subject::find($subject_id);
            $subject->curr_participant++;
            $subject->save();

            return redirect()->back()->with('message1', 'Congratulations! You have successfully joined this class. ');
        }
        catch (Exception $e) {
            return redirect()->back()->with('message1', 'You have already joined this class. Please choose another class.');
        }
    }

    public function destroyClass(Request $request) {
        $student = Student::find(Auth::id());
        $subject = Subject::where('subject_code', $request->input('subject_code'))->first();

        $student->subjects()->detach($subject->id);
        
        $subject->curr_participant--;
        $subject->save();
        
        return redirect()->back();
    }

    public function calendar() {
        $student = User::find(Auth::id());
        return view('student.mycalendar', $student->subjects);
    }
}
