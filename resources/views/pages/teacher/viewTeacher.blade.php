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
            @include('partials.contentHeader', ['name' => 'Teacher', 'key' => 'Page',  'path' => 'giaovien'])
            <table class="table table-bordered table-striped">
                <thead>
                    <th width="125">Mã Giáo Viên</th>
                    <th width="125">Tên Giáo Viên</th>
                </thead>
                <tbody>
                    @foreach($teachers as $teacher)
                    <tr>
                        <td>
                            {{$teacher->maGV}}
                        </td>
                        <td>
                            {{$teacher->tenGV}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="/addTeacher" class="custom_link_right">Thêm Giáo Viên</a>
        </div>
    </div>
</div>
@endsection