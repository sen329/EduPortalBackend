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
            <p>Online: {{$timetable->online}}</p>
            <p>Address: {{$timetable->address}}</p>
            <p>Date: {{$timetable->date}}</p>
            <p>Time: {{$timetable->time}} </p>
            <br>
            <form action="{{ route('lecturer.attendance', $timetable->id ) }}" method="POST">
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
                @foreach($attendance as $attend)
                <tr>
                    <td>{{$attend->id}}</td>
                    <td>{{$attend->student->name}}</td>
                    <td>
                    @if($mydate == $timetable->date)
                    <input type="checkbox" name="attend[{{$attend->id}}]" value=1>
                    </input>
                    @else 
                    You cannot do attendance for this date
                    @endif
                @endforeach
                </tfoot>
              </table>
              <button type="submit" class="btn btn-xs btn-primary float-left">Submit</button>
              </form>
              </div>
              </div>
              <!-- <a href="/export">Export</a> -->
              @endsection