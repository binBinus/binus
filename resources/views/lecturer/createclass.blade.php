@extends('layouts.teachersidebar')

@section('title','Create Class')

@section('css')
    
    <link rel="stylesheet" href="/css/createclass.css">
    <link rel="stylesheet" href="/css/inputbutton.css">
    @endsection

    @include('layouts.head')
    
    @section('content')
    
    <div class="box">
        
        <div class="title">
            Create a Class
        </div>
        
        <div class="left">
            
            <form class="formbox" action="{{ url('create_subjectcontroller') }}" method="post">
                
                @csrf
                <div class="formleft">
                    
                    <label for="subject_name">Subject Name</label><br>
                    <label for="subject_code">Subject Code</label><br>
                    <label for="date">Day</label><br>
                    <label for="time">Time</label><br>
                    <label for="max_participant">Max Participant</label><br>
                </div>
                <div class="formright">
                    <input type="hidden" name="teacher_id" value="{{ Auth::id() }}">
                    <input class="input" type="text" name="subject_name" required><br>
                    <input class="input" type="text" name="subject_code" required><br>
                    <select class="input" name="subject_day" style="width: 200px;" required>
                        <option value="0">Sunday</option>
                        <option value="1">Monday</option>
                        <option value="2">Tuesday</option>
                        <option value="3">Wednesday</option>
                        <option value="4">Thursday</option>
                        <option value="5">Friday</option>
                        <option value="6">Saturday</option>
                    </select><i class="fa fa-plus" style="padding-left: 10px;"></i><br>
                    <input class="input" type="time" name="time_from" required>&nbsp;&nbsp;to&nbsp;
                    <input class="input" type="time" name="time_to" required><br>
                    <input class="input" type="number" name="max_participant" min="3" required><br>
                    <button type="submit" class="button" style="margin: 10px 0px 10px;">Register Your Class</button>

                    @if (session()->has('message')) 
                        <div class="message">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </div>
            </form>
        </div>
        <div class="right">
            <div class="container">
                
                {{-- class details --}}
                
                @empty($data)

                    <img src="\images\—Pngtree—best friends happy taking selfie_5435706.png" alt="" style="width: 100%;">
                    <p style="text-align: center;"> Class information will be displayed here.</p>
                    
                @endempty($data)
                
                @isset($data)
                    
                    {{-- qr code --}}
                    <div class="container-fluid">
                        <div class="text-center">
                            
                            <img src="https://chart.googleapis.com/chart?cht=qr&chl=Hello+World&chs=160x160&chld=L|0" class="qr-code img-thumbnail img-responsive">
                        </div>
                        <input type="hidden" class="input" id="content" value="{{ url('class/'.$data->subject_name.'/'. $data->subject_code)}}">
                    </div>
                    {{-- endqrcode --}}
                    <div style="text-align: center">
                        <h1>{{ $data->subject_name }}</h1>
                        <p>{{ $data->subject_code }}</p>
                    </div>
                    <div class="details">
                        
                        <div class="detailsleft">
                            <p>Date :</p><br>
                            <p>Current Participants :</p>
                        </div>
                        <div class="detailsright">
                            <p>{{ $data->subject_day }}, <br>
                                {{ $data->time_from }} - {{ $data->time_to }}</p>
                            <p>{{ $data->curr_participant }}</p>
                        </div>
                    </div>
                    {{-- <div style="width: 200px; margin: auto;"> --}}
                        
                        <div class="clipboard">
                            <input class="copy-input" value="{{ url('class/'.$data->subject_name.'/'. $data->subject_code)}}" id="copyClipboard" readonly>
                            <button class="copy-btn" id="copyButton" onclick="copy()"><i class="far fa-copy"></i></button>
                        </div>
                        <div id="copied-success" class="copied">
                            <span>Copied!</span>
                        </div>
                        
                    @endisset
                </div>
            </div>
        </div>
    
        @endsection
        
        @section('js')
        
        <script src="https://kit.fontawesome.com/d97b87339f.js" crossorigin="anonymous"></script>
        <script language="JavaScript" type="text/javascript" src="/js/createclass.js"></script>  
        @endsection
        