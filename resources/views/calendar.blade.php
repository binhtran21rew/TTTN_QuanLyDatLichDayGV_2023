
<link rel="stylesheet" href="{{asset('customCss/rooms.css')}}">
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2> 
                        Thời khóa biểu dạy học
                    </h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <th width="125">Time</th>
                            @foreach($weekDays as $day)
                                <th colspan="9">{{ $day }}</th>
                            @endforeach
                            
                        </thead>
                        <tbody>
                            @foreach($calendarData as $time => $days)
                                <tr>
                                    <td class="customTime">
                                        {{ $time }}
                                    </td>
                                    
                                        @foreach($days as $value)
                                            @if (is_array($value))
                                            <td rowspan="{{$value['rowspan']}}"  class="align-middle text-center" style="background-color:#f0f0f0">
                                                <a href="{{ route('infoRoom', ['id' => $value['id']] ) }}" class="customInfoRoom">
                                                    {{ $value['class_name'] }}<br>

                                                    Teacher: {{ $value['teacher_name'] }}
                                                </a>
                                            </td>
                                                @elseif ($value === 1)
                                                <td></td>
                                            @endif
                                        @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
    <a href="/" class="customFooter">
        Trở lại giao diện
    </a>
</footer>


