@extends('layout.admin')

@section('css')
<link href="{{asset('css/textbox.css')}}" rel="stylesheet" />
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
            @if(isset($messages))
                <h3 class="text text-danger">{{$messages}}</h3>
            @endif
            <form action="{{ route('create_teacher') }}" method="POST" class="box">
                @csrf
                <H1>Thêm Giáo viên</H1>
                <table class="table">
                    <tr>
                        <th> <input type="text" name="magiaovien" placeholder="Mã giáo viên">
                        @error('magiaovien')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </th>
                    </tr>
                    <tr>
                        <th>&emsp;</th>
                    </tr>
                    <tr>
                        <th> <input type="text"  name="tengiaovien" placeholder="Tên giáo viên">
                        @error('tengiaovien')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </th>
                    </tr> 
                    <tr>
                        <th>&emsp;</th>
                    </tr>
                    <tr>
                    <th> <input type="submit" value="Thêm"></th>
                    </tr>
                </table>  
            </form>
        </div>
    </div>
</div>
@endsection

