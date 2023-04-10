@extends('layout.admin')
@section('css')
<link rel="stylesheet" href="{{asset('customCss/rooms.css')}}">

@endsection

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Nav Item - User Information -->
            </ul>
        </nav>
        <!-- End of Topbar -->
        <div class="container-fluid">
            @include('partials.contentHeader', ['name' => 'Rooms', 'key' => 'Page',  'path' => 'phonghoc'])   
            <ul class="nav nav-tabs text-center">
                @foreach($rooms as $key => $room)
                <a class="btn btn-default customRoom" href="{{ route('room_available' ,['id' => $key ] )}}" role="button">{{$room}}</a>
                @endforeach
            </ul>
            <!-- <div class="card-body"> -->
            <table class="table table-bordered ">
                <thead>
                    <th width="125">Time</th>
                @foreach($weekDays as $key => $day)
                    <th >{{$day}}</th>
                @endforeach
                </thead>
                <tbody>
                    @if($calendarData === '')
                        <tr></tr>
                    @else
                    
                    @foreach($calendarData as $time => $days)
                            <tr>
                                <td class="customTime">
                                    {{ $time }}
                                </td>
                                @foreach($days as $key => $value)
                                    @foreach($value as $data)
                                    @if(isset($value['room']) ) 
                                    <td class="align-middle text-center customCalendar">
                                        <a href="{{ route('infoRoom', ['id' => $data['id']] ) }}" class="customInfoRoom">
                                            {{ $data['id'] }}<br>
                                            Teacher: {{ $data['teacher_name'] }}  
                                        </a>
                                    </td>
                                    @elseif(isset($value['booking']))
                                    <td class="showRoom">
                                        @if($data['idRoom'] === $data['idRoom'])
                                            <a href="{{route('addPhonghoc', ['id' => $data['idRoom'], 'time' => $data['time'], 'day' => $data['day'], 'idDay' => $data['idDay'] ])}}" class="showBooking">dat phong</a>
                                        @endif
                                    </td>
                                    @else
                                        <td></td>
                                    @endif
                                    @endforeach
                                @endforeach
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

