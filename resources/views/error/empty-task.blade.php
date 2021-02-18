@extends('layouts.teachersidebar')

@section('title', 'Class Tasks')

@section('css')
    <link rel="stylesheet" href="/css/container.css">
    <link rel="stylesheet" href="/css/popup.css">
    <link rel="stylesheet" href="/css/timeline.css">
    <link rel="stylesheet" href="/css/wysiwyg.css">
    <link rel="stylesheet" href="/css/scrollbar.css">
@endsection

@section('content')
    
    <div class="parent" id="style-1"><div class="container-fluid">
        <div class="row example-basic" style="padding-bottom: 5%;">
            <div class="col-md-12 page-title">
                <h4>Class Tasks</h4>
                <h2>{{ $subject_name }}</h2>
            </div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2" style="margin:auto;">
                <ul class="timeline">
                    <li class="timeline-item period">
                        <div class="timeline-info"></div>
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <h2 class="timeline-title">{{ date('m-Y') }}</h2>
                        </div>
                    </li>
                    <li class="timeline-item">
                        <div class="timeline-info">
                            <span>March 12, 2016</span>
                        </div>
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <h3 class="timeline-title">Event Title</h3>
                            <p>Nullam vel sem. Nullam vel sem. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Donec orci lectus, aliquam ut, faucibus non, euismod id, nulla. Donec vitae sapien ut libero venenatis faucibus. ullam dictum felis
                                eu pede mollis pretium. Pellentesque ut neque.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection