@extends('layout.admin')

@section('css')
<link href="{{ asset('css/textbox.css')}}" rel="stylesheet" />
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
            @if(isset($messages))
                <h3 class="text text-danger">{{$messages}}</h3>
            @endif
            <form action="{{ route('create_courses') }}" method="POST" class="box">
                @csrf
                <H1>Thêm môn học</H1>
                <table class="table">
                    <tr class="form_group">
                        <th> <input type="text" name="idcourse" placeholder="Mã môn Học">
                        @error('idcourse')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </th>
                      
                    </tr>
                    <tr>
                        <th>&emsp;</th>
                    </tr>
                    <tr class="form_group">
                        <th> <input type="text" name="namecourse" placeholder="Tên môn Học">
                        @error('namecourse')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </th>
                      
                    </tr>
                    <tr>
                        <th>&emsp;</th>
                    </tr>
                    <tr class="form_group">
                        <th><lable>Thời Gian Bắt Đầu</lable> <input type="date" name="timebegin" placeholder="Thời Gian Học">
                        @error('timebegin')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </th>
                    </tr> 
                    <tr>
                        <th>&emsp;</th>
                    </tr>
                    <tr class="form_group">
                        <th><lable>Thời Gian Kết Thúc</lable> <input type="date" name="timeend" placeholder="Thời Gian Học">
                        @error('timeend')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </th>
                    </tr> 
                    <tr>
                        <th>&emsp;</th>
                    </tr>
                    <th> <input type="submit" value="Thêm"></th>
                    </tr>
                </table>  
            </form>
        </div>
    </div>
</div>
@endsection

