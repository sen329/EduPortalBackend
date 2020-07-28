@extends('layouts.admin_template')

@section('content')
<div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Timetable</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Lecturer</th>
                    <th>Online/Offline</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($timetables as $timetable)
                <tr>
                <th scope="row" >{{$timetable->id}}</th>
                  <td>{{ $timetable->subject->name}}</td>
                  <td>{{ $timetable->lecturer->name}}</td>
                  <td>@if($timetable->online == 1)
                      Online
                      @else
                      Offline
                      @endif
                  </td>
                  <td>{{ $timetable->address }}</td>
                  <td>{{ $timetable->date}} </td>
                  <td>{{ $timetable->time }}</td>
                  <td>@if($timetable->trashed())
                                <a href="/restore/{{ $timetable->id }}"><button type="button"  class="btn btn-success btn-sm">Restore</button></a>
                    @else
                      <a href="{{route('admin.classDetails', $timetable->id)}}"><button type="button" class="btn btn-xs btn-primary float-left">Attendance</button></a>
                    @endif
                  </td>
                  </tr>
                @endforeach
                </tbody>

                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Lecturer</th>
                    <th>Online/Offline</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>
              </div>
              </div>
              <!-- <a href="/export">Export</a> -->
              <script type="text/javascript">
              @endsection