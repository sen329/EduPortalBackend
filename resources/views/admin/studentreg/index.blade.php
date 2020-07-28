@extends('layouts.admin_template')

@section('content')
<div class="box box-info">
<div class="box-header">
              <h3 class="box-title">Students class registration</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Subject</th>
                    <th>Reciept</th>
                    <th>Paid status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($studentRegs as $studentreg)
                <tr>
                <th scope="row" >{{$studentreg->id}}</th>
                  <td>{{ $studentreg->student->name}}</td>
                  <td>{{ $studentreg->subject->name}}</td>
                  <td>
                  <div class="profile-header-img">
                    <img class="img-thumbnail" height="50px" width="50px" src="/storage/reciepts/{{ $studentreg->pay_reciept }}" />
                </div>
                  </td>
                  <td>@if($studentreg->paid == 0)
                        Pending
                        @elseif($studentreg->paid == 1)
                        Paid
                        @endif
                  </td>
                  <td>
                      <a href="{{route('admin.studentreg.edit', $studentreg->id)}}"><button type="button" class="btn btn-xs btn-primary float-left">Approve form</button></a>
                      <form class="delete" action='{{ route("admin.studentreg.destroy", $studentreg)  }}' method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                {{ csrf_field() }}
                                <input type="submit"onclick="return confirm('Are you sure?')" class="btn btn-xs btn-danger float-left" value="Delete Form" >
                            </form>
                  </td>
                  </tr>
                  <script type="text/javascript">
          function deleteData(id)
          {
              var id = id;
              var url = '{{ route("admin.studentreg.destroy", $studentreg) }}';
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
                    <th>Student</th>
                    <th>Subject</th>
                    <th>Reciept</th>
                    <th>Paid status</th>
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>
              </div>
              </div>
              
              <!-- <a href="/export">Export</a> -->
              @endsection