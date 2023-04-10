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
            @include('partials.contentHeader', ['name' => 'Rooms', 'key' => 'Page',  'path' => 'phonghoc'])
            @if(isset($messages))
                <h3 class="text text-danger">{{$messages}}</h3>
            @endif
            <form action="{{ route('create_room', ['id' => $id, 'time' => $time, 'day' => $idDay ]) }}" method="POST" class="box">
                @csrf
                <H1>Thêm phòng học</H1>
                <table class="table">
                    <tr>
                        <th> 
                            <h3>Phòng: {{$id}},  Ngày dạy: {{$day}}</h3>

                        </th>
                    </tr> 
                    <tr>
                        <th> 
                            <h3>Tiết bắt đầu: {{$time}}</h3>
                        </th>
                    </tr> 
                    <tr class="form_group">
                        <th> 
                            <select name="idTime" class="form-control customSelect">
                                <option value="0">Chọn Số Tiết Dạy</option>
                                <option value="3" {{ old('idTime') == "3" ? 'selected' : '' }}> 3 tiết</option>
                                <option value="4" {{ old('idTime') == "4" ? 'selected' : '' }}> 4 tiết</option>
                                <option value="5" {{ old('idTime') == "5" ? 'selected' : '' }}> 5 tiết</option>
                            </select>
                            @error('idTime')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </th>
                    </tr> 
                    <tr class="form_group">
                        <th> 
                            <select name="idCourse" class="form-control customSelect">
                                <option value="0">Chọn Môn Học</option>
                                @foreach($courses as $course)
                                    <option value="{{$course->maMH}}" {{ old('idCourse') == "$course->maMH" ? 'selected' : '' }}>{{$course->tenMH}}</option>
                                @endforeach
                            </select>
                            @error('idCourse')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </th>
                    </tr> 
                    <tr class="form_group">
                        <th> 
                            <select name="idTeacher" class="form-control customSelect" ">
                                <option value="0">Chọn Giáo Viên</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{$teacher->maGV}}" {{ old('idTeacher') == "$teacher->maGV" ? 'selected' : '' }}>{{$teacher->tenGV}}</option>
                                @endforeach
                            </select>
                            @error('idTeacher')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </th>
                    </tr> 
                    <tr class="form_group">
                        <th> 
                            <select name="idClass" class="form-control customSelect">
                                <option value="0">Chọn Lớp Học</option>
                                @foreach($classes as $class)
                                    <option value="{{$class->maLop}}" {{ old('idClass') == "$class->maLop" ? 'selected' : '' }}>{{$class->maLop}}</option>
                                @endforeach
                            </select>
                            @error('idClass')
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

