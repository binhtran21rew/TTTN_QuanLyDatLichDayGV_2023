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
            @include('partials.contentHeader', ['name' => 'Class', 'key' => 'Page',  'path' => 'giohoc'])
            <table class="table">
                <tbody>
                    <h3>Khung gio hoc</h3>
                    <tr>
                        <th scope="row">sang</th>

                        @foreach($calendarData as $key => $time)
                            @foreach($time as $value)
                                @if($key <=6)
                                    <td>
                                        <h5> {{$key}}: </h5> 
                                    </td>
                                    <td>({{$value}})</td>
                                @endif
                            @endforeach
                        @endforeach
                    </tr>
                    <tr>
                        <th scope="row">chieu</th>
                        @foreach($calendarData as $key => $time)
                            @foreach($time as $value)
                                @if($key >6)
                                    <td>
                                        <h5> {{$key}}: </h5> 
                                    </td>
                                    <td>({{$value}})</td>
                                @endif
                            @endforeach
                        @endforeach
                    </tr>
                    
                </tbody>
                
            </table>

            
            @if(isset($messages))
                <h3 class="text text-danger">{{$messages}}</h3>
            @endif
            <form action="{{ route('create_time') }}" method="POST" class="box">
                @csrf
                <H1>Thêm giờ học</H1>
                <table class="table">
                    <tr class="form_group">
                        <th> <input type="text" name="time" placeholder="Mã Giờ Học">
                        @error('time')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                        </th>
                      
                    </tr>
                    <tr>
                        <th>&emsp;</th>
                    </tr>
                    <tr class="form_group">
                        <th><lable>Thời Gian Bắt Đầu</lable> <input type="time" name="time_begin" placeholder="Thời Gian Bắt Đầu">
                        @error('time_begin')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                        </th>
                       
                    </tr> 
                    
                    <tr>
                        <th>&emsp;</th>
                    </tr>
                    <tr class="form_group">
                        <th> <lable>Thời Gian Kết Thúc</lable>
                            <input type="time"  name="time_end" placeholder="Thời Gian Kết Thúc">
                            @error('time_end')
                                <span class="alert alert-danger">{{ $message }}</span>
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

