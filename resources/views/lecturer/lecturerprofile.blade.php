@extends('layouts.teachersidebar')

@section('title', 'My Profile')
    
@section('css')
    
    <link rel="stylesheet" href="/css/styles.min.css">
    <link rel="stylesheet" href="/css/inputbutton.css">
    <link rel="stylesheet" href="/css/lecturerprofile.css">
    <link rel="stylesheet" href="/css/popup.css">
@endsection

@section('content')
    
    <div class="box">
        <div class="title">My Profile</div>
        <div style="height: 100%;width: 100%;background: rgb(119, 119, 119); overflow: auto;">
            <h1 style="padding: 25px; background-color: #e84a5f"></h1>
            <div class="tab-wrap">
            
                <input type="radio" name="tabs" id="tab1" checked style="opacity: 0;">
                <div class="tab-label-content" id="tab1-content">
                    <label for="tab1">Account</label>
                    <div class="tab-content">
                        <x-app-layout>
                            <div class="max-w-7xl mx-auto sm:px-6 lg:" style="padding-bottom: 2rem;">
                                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                    @livewire('profile.update-profile-information-form')
                    
                                    <x-jet-section-border />
                                @endif
                    
                                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                                    <div class="mt-10 sm:mt-0">
                                        @livewire('profile.update-password-form')
                                    </div>
                    
                                    <x-jet-section-border />
                                @endif
                    
                                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                                    <div class="mt-10 sm:mt-0">
                                        @livewire('profile.two-factor-authentication-form')
                                    </div>
                    
                                    <x-jet-section-border />
                                @endif
                    
                                <div class="mt-10 sm:mt-0">
                                    @livewire('profile.logout-other-browser-sessions-form')
                                </div>
                    
                                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                                    <x-jet-section-border />
                    
                                    <div class="mt-10 sm:mt-0">
                                        @livewire('profile.delete-user-form')
                                    </div>
                                @endif
                            </div>
                    </x-app-layout>
                    </div>
                </div>

                <input type="radio" name="tabs" id="tab2" style="opacity: 0;">
                <div class="tab-label-content" id="tab2-content">
                    <label for="tab2">Personal</label>
                    <div class="tab-content">
                        <table class="rwd-table">
                            <tr>
                                <th>QR</th>
                                <th>Class Name</th>
                                <th>Class Code</th>
                                <th>No. Student</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            @foreach ($class as $item)
                            
                                <tr>
                                    <td><a class="lightbox" href="#{{ $item->subject_code }}"><img src="{{ $item->image_path }}" alt=""></a></td>
                                    <td>{{ $item->subject_name }}</td>
                                    <td>{{ $item->subject_code }}</td>
                                    <td>{{ $item->curr_participant }}</td>
                                    <td><a href="#update{{ $item->id }}"><i class="fa fa-pencil"></i></a></td>
                                    <td><a href="#delete{{ $item->id }}"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="slide"></div>
                </div></div>
            </div>
        </div>

        {{-- image zoom --}}
        @foreach ($class as $item)

            <div class="lightbox-target" id="{{ $item->subject_code }}">
                <img src="{{ $item->image_path}}"/>
                <a class="lightbox-close" href="#"></a>
            </div>

        @endforeach
        
        {{-- popup update --}}
        @foreach ($class as $item)
            
            <div id="update{{ $item->id }}" class="overlay">
                <div class="popup" style="width: 30%;">
                    <div style="font-size: 18px; padding-bottom: 20px;">Edit {{ $item->subject_name }} Class Detail</div>
                        <a class="close" href="#">&times;</a>
                        <div class="content">
                            <form action="{{'/edit_subjectcontroller'}}" method="post">
                                
                                @csrf
                                <input class="input" type="hidden" name="subject_code" value="{{ $item->subject_code }}">
                                
                                Class Day: <br>
                                <select  name="subject_day" style="width: 200px; margin:0px 5px 10px; border: none; border-radius: 5px; background-color:#adadad" value="{{ $item->subject_day }}">
                                    <option value="0">Sunday</option>
                                    <option value="1">Monday</option>
                                    <option value="2">Tuesday</option>
                                    <option value="3">Wednesday</option>
                                    <option value="4">Thursday</option>
                                    <option value="5">Friday</option>
                                    <option value="6">Saturday</option>
                                </select>
                                
                                <br>Time From: <br>
                                <input  type="time" name="time_from" style="width: 110px; margin:0px 5px 10px; border-radius: 5px; background-color:#adadad" value="{{ $item->time_from }}">&nbsp;&nbsp;to&nbsp;
                                <input  type="time" name="time_to" style="width: 110px; margin:0px 5px 10px; border-radius: 5px; background-color:#adadad" value="{{ $item->time_to }}"><br>
                                
                                Max Participant: <br>
                                <input  type="number" name="max_participant" min="{{ $item->curr_participant }}" style="width: 100px;margin:0px 5px 10px; border-radius: 5px; background-color:#adadad" value="{{ $item->max_participant }}">
                                <button type="submit" class="button" style="margin: 10px 0px 10px;">Update Information</button>
                                
                                @if (session()->has('message1')) 
                                <div class="message1">
                                    {{ session()->get('message1') }}
                                </div>
                                @endif
                            </form>
                            
                        </div>
                    </div>
                </div>
                
            </div>
        @endforeach

        {{-- popup delete --}}
        @foreach ($class as $item)
            <div id="delete{{ $item->id }}" class="overlay">
                <div class="popup" style="width: 30%;">
                        <h4 style="text-align: center">Confirm Delete {{ $item->subject_name }}?</h4>
                        <a class="close" href="#">&times;</a>
                        <div class="content">
                            <form action="{{'/destroy_subjectcontroller'}}" method="post">
                                
                                @csrf
                                <input class="input" type="hidden" name="subject_id" value="{{ $item->id }}">

                                <button type="submit" class="button confirmation" style="width: 80%; margin: auto; margin-top: 10px;">Delete</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            
            
        @endforeach
    </div>
@endsection