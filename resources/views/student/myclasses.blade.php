@extends('layouts.studentsidebar')

@section('title', 'My Classes')

@section('css')
    
  <link rel="stylesheet" href="/css/myclasses.css">
  <link rel="stylesheet" href="/css/inputbutton.css">
  <link rel="stylesheet" href="/css/popup.css">
@endsection

@section('content')

    <div class="box">

        <div class="title">
            My Classes
        </div>
    
            
        <section class="container">
    
            @foreach ($subjects as $item)
            
                <dl class="items-work-list">
                    <dt class="items-work-title">
                        <strong>{{$item->subject_name}}</strong>
                    </dt>
                    <dd class="items-work-description">
                        {{$item->subject_code}}
                        {{-- <a href="{{ Request::url() . '/#' . $item->subject_code }}" class="button">Add Class Task</a> --}}
                        <a href="{{ url('tasks/' . $item->id ) }}" class="button">View Class Tasks</a>
                        <a href="{{ url('videos/' . $item->id) }}" class="button">View Class Videos</a>
                    </dd>
                </dl>

                {{-- popup for every class --}}
                {{-- <div id="{{ $item->subject_code }}" class="overlay">
                    <div class="popup">
                        <h2>Add Tasks or Videos for {{ $item->subject_name }} Class</h2>
                        <a class="close" href="#">&times;</a>
                        <div class="content">
                            <form action="{{ 'addTask_subjectcontroller' }}" method="post">

                                @csrf
                                <input class="input" type="hidden" name="subject_name" value="{{ $item->subject_name }}">
                                <input class="input" type="hidden" name="subject_code" value="{{ $item->subject_code }}">
                                
                                Task Title
                                <input class="input" type="text" name=task_title>

                                Task Description
                                <textarea class="input" type="text" name="task_description"></textarea>

                                Task Date
                                <input class="input" type="date" name="task_date">
                                <input class="button" type="submit">

                                @if (session()->has('message1')) 
                                    <div class="message1">
                                        {{ session()->get('message1') }}
                                    </div>
                                @endif
                            </form>
                            
                            <form action="{{ 'upload_videocontroller' }}" method="post">
                                
                                @csrf
                                <input class="input" type="hidden" name="subject_name" value="{{ $item->subject_name }}">
                                <input class="input" type="hidden" name="subject_code" value="{{ $item->subject_code }}">

                                <br>
                                Video URL Link
                                <input class="input" type="url" name="file_path" placeholder="https://www.youtube.com/watch?v=C_xn0JljmH8">
                                
                                Video Title
                                <input class="input" type="text" name="name" placeholder="How to Basic">
                                
                                Video Description
                                <textarea class="input" type="text" name="description"></textarea>
                                <input type="submit" class="button">

                                @if (session()->has('message2')) 
                                    <div class="message2">
                                        {{ session()->get('message2') }}
                                    </div>
                                @endif
                            </form>

                        </div>
                    </div>
                </div> --}}
            @endforeach
    
        </section>
    </div>


@endsection

@section('js')
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
        alert(msg);
        }
    </script>    
@endsection
