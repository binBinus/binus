@extends('layouts.studentsidebar')

@section('title', 'Class Video')

@section('css')
    <link rel="stylesheet" href="/css/viewvideo.css">
@endsection

@section('content')
    <div class="box">
        <div class="title">
            Videos
        </div>
        <div class="video">
            
            <div class="container">
                <div class="accordion">
                    <dl>
                        @foreach ($data as $index=>$item)
                            
                            <dt>
                                <a href="#accordion{{ $index+1 }}" aria-expanded="false" aria-controls="#accordion{{ $index+1 }}" class="accordion-title accordionTitle js-accordionTrigger">{{ $item->name }}</a>
                            </dt>
                            <dd class="accordion-content accordionItem is-collapsed" id="#accordion{{ $index+1 }}" aria-hidden="true">
                                <div class="content">
                                    <iframe width="560" height="315" src="{{ $item->file_path }}" frameborder="0" allowfullscreen style="margin: auto;"></iframe>
                                    <h4 style="text-align: center">{{ $item->description }}</h4>
                                </div>
                            </dd>

                        @endforeach
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/js/viewvideo.js"></script>
@endsection