

@extends('layouts.teachersidebar')

@section('title', 'Class Tasks')

@section('css')
    <link rel="stylesheet" href="/css/timeline.css">
@endsection

@section('content')
    
    <div class="parent" id="style-1">
        <div class="box">
            <div class="title">
                View Task
            </div>
            
            <div class="container-fluid">
                <div class="row example-basic" style="padding-bottom: 5%;">        
                    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2" style="margin-left: 10%;">
                        <ul class="timeline">
                            <h2>{{ $subject_name }}</h2>
                            @foreach ($data as $item)

                                <li class="timeline-item">
                                    <div class="timeline-info">
                                        <span>{{ Carbon\Carbon::parse($item->task_date)->format('d-F-Y') }}</span>
                                    </div>
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h3 class="timeline-title">{{ $item->task_title }}</h3>
                                        <p>{{!! $item->task_description !!}}</p>
                                    </div>
                                </li>

                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection