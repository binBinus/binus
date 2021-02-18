@extends('layouts.studentsidebar')

@section('title', 'My Calendar')

@section('css')
    
    <link rel="stylesheet" href="css/mycalendar.css">
@endsection

@section('content')
    
    <div class="box">
        <div class="title" style="float: left;">
            My Calendar
        </div>
        <div class="content">
            <div class="navigation">
                <button class="prev"><i class="fa fa-caret-left fa-3x"></i></button>
                <h1 class="date"></h1>
                <button class="next"><i class="fa fa-caret-right fa-3x"></i></button>
            </div>
            <section class="calendar">
                <p class="th">sun</p>
                <p class="th">Mon</p>
                <p class="th">Tue</p>
                <p class="th">Wed</p>
                <p class="th">Thur</p>
                <p class="th">Fri</p>
                <p class="th">Sat</p>
            </section>
        </div>
    </div>
@endsection
    
@section('js')
    
    <script src="js/mycalendar.js"></script>
@endsection