
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
            @include('partials.contentHeader', ['name' => 'Infomation', 'key' => 'Room',  'path' => 'phonghoc'])      
            <table class="table table-bordered table-striped">
                <thead>
                    <th width="50">Ngày học</th>
                    <th width="50">Tên phòng học</th>
                    <th width="150">Tên môn học</th>
                    <th width="100">Tên giáo viên</th>
                    <th width="30">Tên lớp học</th>
                    <th width="50">Giờ học</th>
                </thead>
                <tbody>
                    @foreach( $infoRoom as $data)
                        <tr>
                            <td>{{$data->ngayhoc}}</td>
                            <td>{{$data->namePH}}</td>
                            <td>{{$data->nameMH}}</td>
                            <td>{{$data->nameGV}}</td>
                            <td>{{$data->maLop}}</td>

                            <td>{{$data->time_begin}} - {{$data->time_end}}</td>

                        </tr>

                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('room_available', ['id' => $data->namePH] ) }}" class="custom_link_right">Quay lại</a>
        </div>
    </div>
</div>



@endsection