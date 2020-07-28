@extends('layouts.admin_template')

@section('content')
<div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Timetable</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <a href="timetable/create"><button type="button" class="btn btn-primary">Add new class</button></a>
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
                  <td>
                      <a href="{{route('admin.timetable.edit', $timetable->id)}}"><button type="button" class="btn btn-xs btn-primary float-left">Edit Class</button></a>
                      <a href="{{route('admin.classDetails', $timetable->id)}}"><button type="button" class="btn btn-xs btn-primary float-left">Attendance</button></a>
                      <form class="delete" action='{{ route("admin.timetable.destroy", $timetable)  }}' method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                {{ csrf_field() }}
                                <input type="submit"onclick="return confirm('Are you sure?')" class="btn btn-xs btn-danger float-left" value="Delete Class" >
                            </form>
                  </td>
                  </tr>
                  <script type="text/javascript">
          function deleteData(id)
          {
              var id = id;
              var url = '{{ route("admin.timetable.destroy", $timetable) }}';
              url = url.replace(':id', id);
              $("#deleteForm").attr('action', url);
          }

          function formSubmit()
          {
              $("#deleteForm").submit();
          }
              </script>
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

  @endsection