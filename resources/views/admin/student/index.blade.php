@extends('layouts.admin_template')

@section('content')
<div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Students</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <a href="{{route('admin.student.create')}}"><button type="button" class="btn btn-primary">Add new student</button></a>
            @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('error') }}
                        </div>
                    @endif
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Phone number</th>
                  <th>Profile Picture</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                <tr>
                <th scope="row" >{{$student->id}}</th>
                  <td>{{ $student->name}}</td>
                  <td>{{ $student->email}}</td>
                  <td>{{ $student->address }}</td>
                  <td>{{ $student->phone_number }}</td>
                  <td>
                  
                  <div class="profile-header-img">
                    <img class="img-thumbnail" height="50px" width="50px" src="/storage/avatars/{{ $student->avatar }}" />
                </div>

                  </td>
                  <td>
                      <a href="{{route('admin.student.edit', $student->id)}}"><button type="button" class="btn btn-xs btn-primary float-left">Edit student</button></a>
                      <form class="delete" action='{{ route("admin.student.destroy", $student)  }}' method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                {{ csrf_field() }}
                                <input type="submit"onclick="return confirm('Are you sure?')" class="btn btn-xs btn-danger float-left" value="Delete student" >
                            </form>
                  </td>
                  </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Phone number</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <script type="text/javascript">
          function deleteData(id)
          {
              var id = id;
              var url = '{{ route("admin.student.destroy", $student) }}';
              url = url.replace(':id', id);
              $("#deleteForm").attr('action', url);
          }

          function formSubmit()
          {
              $("#deleteForm").submit();
          }
  </script>
@endsection