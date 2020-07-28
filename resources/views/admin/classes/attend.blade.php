@extends('layouts.admin_template')

@section('content')
<div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Timetable</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <br>
            <p>Subject: {{$timetable->subject->name}}</p>
            <p>Lecturer: {{$timetable->lecturer->name}}</p>
            <p>Online/Offline: @if($timetable->online == 1) Online @elseif($timetable->online == 0) Offline @endif</p>
            <p>Address: {{$timetable->address}}</p>
            <p>Date: {{$timetable->date}}</p>
            <p>Time: {{$timetable->time}} </p>
            <br>
            <form action="{{ route('admin.attendance', $timetable->id ) }}" method="POST">
            @csrf
            {{ method_field('PUT') }}
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Attendance</th>
                </tr>
                </thead>
                <tbody>
                @foreach($attnCheck as $attend)
                <tr>
                    <td>{{$attend->id}}</td>
                    <td>{{$attend->reg->student->name}}</td>
                    <td>

                            <label for="present">Present</label>
                            <input type="radio" id="present"  name="attend[{{$attend->id}}]" value="1" @if($attend->attendance == 1) checked @endif>
                            <label for="absent">Absent</label>
                            <input type="radio" id="absent"  name="attend[{{$attend->id}}]" value="0" @if($attend->attendance == 0) checked @endif>
                    </input>
                @endforeach
                </tfoot>
              </table>
              <button type="submit" class="btn btn-xs btn-primary float-left">Submit</button>
              </form>
              </div>
              </div>
              <!-- <a href="/export">Export</a> -->
              @endsection