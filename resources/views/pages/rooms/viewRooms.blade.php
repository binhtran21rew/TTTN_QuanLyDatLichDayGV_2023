
@extends('layout.admin')
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
            <ul class="nav nav-tabs">
                @foreach($rooms as $key => $room)
                <a class="btn btn-default" href="{{ route('room_available' ,['id' => $key ] )}}" role="button">{{$room}}</a>
                @endforeach
            </ul>
        </div>
    </div>
</div>



@endsection