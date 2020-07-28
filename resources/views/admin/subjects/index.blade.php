@extends('layouts.admin_template')

@section('content')
<div class="box box-info">
<div class="box-header">
              <h3 class="box-title">Subject</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <a href="{{route('admin.subject.create')}}"><button type="button" class="btn btn-primary">Add new subject</button></a>
<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subjects as $subject)
                <tr>
                <th scope="row" >{{$subject->id}}</th>
                  <td>{{ $subject->name}}</td>
                  <td>{{ $subject->description}}</td>
                  <td>{{ $subject->price }}</td>
                  <td>@if($subject->trashed())
                                <a href="/restore/{{ $subject->id }}"><button type="button"  class="btn btn-success btn-sm">Restore</button></a>
                    @else
                      <a href="{{route('admin.subject.edit', $subject->id)}}"><button type="button" class="btn btn-xs btn-primary float-left">Edit Subject</button></a>
                      <form class="delete" action='{{ route("admin.subject.destroy", $subject)  }}' method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                {{ csrf_field() }}
                                <input type="submit"onclick="return confirm('Are you sure?')" class="btn btn-xs btn-danger float-left" value="Delete Subject" >
                            </form>
                    @endif
                  </td>
                  </tr>
                @endforeach
                
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
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
              var url = '{{ route("admin.subject.destroy", $subject) }}';
              url = url.replace(':id', id);
              $("#deleteForm").attr('action', url);
          }

          function formSubmit()
          {
              $("#deleteForm").submit();
          }
  </script>
              <!-- <a href="/export">Export</a> -->
              @endsection