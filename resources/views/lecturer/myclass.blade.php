@extends('layouts.teachersidebar')

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
                        <a href="{{ Request::url() . '/#' . $item->subject_code }}" class="button">Add Class Task</a>
                        <a href="{{ url('tasks/' . $item->id ) }}" class="button">View Class Tasks</a>
                        <a href="{{ url('videos/' . $item->id ) }}" class="button">View Class Videos</a>
                    </dd>
                </dl>

                {{-- popup for every class --}}
                <div id="{{ $item->subject_code }}" class="overlay">
                    <div class="popup">
                        <h2>Add Tasks or Videos for {{ $item->subject_name }} Class</h2>
                        <a class="close" href="#">&times;</a>
                        <div class="content">
                            <form action="{{ url('addTask_subjectcontroller') }}" method="post">

                                @csrf
                                <input class="input" type="hidden" name="subject_id" value="{{ $item->id }}">
                                
                                Task Title
                                <input class="input" type="text" name=task_title>

                                Task Description
                                <div id="editparent">
                                    <div id="editControls">
                                        <div class="btn-group">
                                            <a class="btn btn-xs btn-default" data-role="undo" href="#" title="Undo"><i class="fa fa-undo"></i></a>
                                            <a class="btn btn-xs btn-default" data-role="redo" href="#" title="Redo"><i class="fa fa-repeat"></i></a>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-xs btn-default" data-role="bold" href="#" title="Bold"><i class="fa fa-bold"></i></a>
                                            <a class="btn btn-xs btn-default" data-role="italic" href="#" title="Italic"><i class="fa fa-italic"></i></a>
                                            <a class="btn btn-xs btn-default" data-role="underline" href="#" title="Underline"><i class="fa fa-underline"></i></a>
                                            <a class="btn btn-xs btn-default" data-role="strikeThrough" href="#" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-xs btn-default" data-role="indent" href="#" title="Blockquote"><i class="fa fa-indent"></i></a>
                                            <a class="btn btn-xs btn-default" data-role="insertUnorderedList" href="#" title="Unordered List"><i class="fa fa-list-ul"></i></a>
                                            <a class="btn btn-xs btn-default" data-role="insertOrderedList" href="#" title="Ordered List"><i class="fa fa-list-ol"></i></a>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-xs btn-default" data-role="h1" href="#" title="Heading 1"><i class="fa fa-header"></i><sup>1</sup></a>
                                            <a class="btn btn-xs btn-default" data-role="h2" href="#" title="Heading 2"><i class="fa fa-header"></i><sup>2</sup></a>
                                            <a class="btn btn-xs btn-default" data-role="h3" href="#" title="Heading 3"><i class="fa fa-header"></i><sup>3</sup></a>
                                            <a class="btn btn-xs btn-default" data-role="p" href="#" title="Paragraph"><i class="fa fa-paragraph"></i></a>
                                        </div>
                                    </div>
                                    <div id="editor" class="input" contenteditable></div>
                                    <textarea class="input" name="task_description" id="editorCopy" required="required" style="display:none;"></textarea>
                                </div>
                                {{-- <a href="#" id="checkIt">Hello</a> --}}
                                    
                                Task Date
                                <input class="input" type="date" name="task_date">
                                <input class="button" type="submit">

                                @if (session()->has('message1')) 
                                    <div class="message1">
                                        {{ session()->get('message1') }}
                                    </div>
                                @endif
                            </form>
                            
                            <form action="{{ url('upload_videocontroller') }}" method="post">
                                
                                @csrf
                                <input class="input" type="hidden" name="subject_id" value="{{ $item->id }}">

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
                </div>
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
    <script src="/js/myclass.js"></script>
@endsection
