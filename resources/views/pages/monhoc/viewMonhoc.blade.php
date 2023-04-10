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
            @include('partials.contentHeader', ['name' => 'Course', 'key' => 'Page',  'path' => 'monhoc'])
            <table class="table table-bordered table-striped">
                <thead>
                    <th width="125">Mã môn học</th>
                    <th width="125">Tên môn học</th>
                    <th width="125">Thời gian học</th>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <td>
                            {{$course->maMH}}
                        </td>
                        <td>
                            {{$course->tenMH}}
                        </td>
                        <td>
                            {{str_replace('-', '/', $course->time_hoc)}} -  {{str_replace('-', '/', $course->time_end)}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="/addMonhoc" class="custom_link_right">Thêm môn học</a>
        </div>
    </div>
</div>
@endsection