@extends('layouts.studentsidebar')

@section('title','Join Class')

@section('css')
    
    <link rel="stylesheet" href="/css/joinclass.css">
    <link rel="stylesheet" href="/css/inputbutton.css">
    <style>
        .join{
            margin: auto;
            width: 200px;
            text-align:center; 
            background-color: #2a363b;
        }

        .join:hover {
            color: #e84a5f;
        }
    </style>
@endsection

@include('layouts.head')

@section('content')
    
    <div class="box">
        <h1 class="title">Join a Class</h1>
        <div class="left">
            <!-- Upload  -->
            <form id="file-upload-form" class="uploader" action="{{ url('findSubject_studentcontroller') }}" method="post">

                @csrf
                <div style="color: rgb(189, 189, 189)">
                    <h2 style="text-align: center;">How to join a class:</h2>
                    <ol style="margin-left: 20%; margin-bottom: 100px; margin-top: 30px;">
                        <li>Request Class QR Code from lecturer</li>
                        <li>Press QR Code button</li>
                        <li>After URL is generated, Press Search button</li>
                        <li>View details of your Class</li>
                        <li>Press Join Class button</li>
                    </ol>
                </div>

                <div>

                    <input name="url" type="text" size=16 placeholder="Your QR Code link will be displayed here" class="qrcode-text input" style="width: 90%; margin-right: 10px">
                    <label class="qrcode-text-btn"><input type=file accept="image/*" capture="environment" onchange="openQRCamera(this);" tabindex="-1" ></label>
                </div>
                <button type="submit" class="button" style="margin: auto; margin-top: 10px">Search Class</button>

                @if (session()->has('message')) 
                    <div class="message">
                        {{ session()->get('message') }}
                    </div>
                @endif
                
            </form>
        </div>

        <div class="right">

            @empty($data)
            <div style="width: 50%; padding: 15% 0; margin: auto;">

                <img src="\images\Untitled-1.png" alt="" srcset="" style="width: 100%;">
                <p style="text-align: center">Looking for something? Join a Class.</p>
            </div>

            @endempty

            {{-- class details --}}
            @isset($data)

                {{-- qr code --}}
                <div class="container-fluid">
                    <input type="hidden" class="input" id="content" value="{{ url('joinclass/'. $data->subject_name.'/'. $data->subject_code)}}">
                </div>
                {{-- endqrcode --}}
                <div style="text-align: center; padding: 10vh 0px 1vh;">
                    <h1>{{ $data->subject_name }}</h1>
                    <p>{{ $data->subject_code }}</p>
                </div>
                <div class="details">
                    
                    <div class="detailsleft">
                        <p>Teacher Name :</p>
                        <p>Day :</p><br>
                        <p>Participants :</p>
                    </div>
                    <div class="detailsright">
                        <p>{{ $teacher_name }}</p>
                        <p>{{ $data->subject_day }}, <br>
                            {{ $data->time_from }} - {{ $data->time_to }}</p>
                        <p>{{ $data->curr_participant }}</p>
                    </div>
                </div>
                <a class="button join" style="margin: auto; width: 200px; text-align:center; background-color:" href="{{url('joinclass/'. $data->id )}}">Join this Class</a>

                @if (session()->has('message1')) 
                    <div style="text-align: center; padding: 30px 0px 0px">
                        {{ session()->get('message1') }}
                    </div>
                @endif
            @endisset
        </div>
    </div>

@endsection

@section('js')
    <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>
    <script src="/js/joinclass.js"></script>   
@endsection
