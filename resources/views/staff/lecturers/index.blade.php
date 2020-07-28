@extends('layouts.admin_template')

@section('content')
<div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <a href="{{route('staff.lecturer.create')}}"><button type="button" class="btn btn-primary">Add new lecturer</button></a>
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
                  <th>Subjects</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $lecturer)
                <tr>
                <th scope="row" >{{$lecturer->id}}</th>
                  <td>{{ $lecturer->name}}</td>
                  <td>{{ $lecturer->email}}</td>
                  <td>{{ $lecturer->address }}</td>
                  <td>{{ $lecturer->phone_number }}</td>
                  <td>
                  
                  <div class="profile-header-img">
                    <img class="img-thumbnail" height="50px" width="50px" src="/storage/avatars/{{ $lecturer->avatar }}" />
                </div>

                  </td>
                  <td>{{ implode(', ', $lecturer->subject()->get()->pluck('name')->toArray())}}
                  <td>
                      <a href="{{route('staff.lecturer.edit', $lecturer->id)}}"><button type="button" class="btn btn-xs btn-primary float-left">Edit Lecturer</button></a>
                      
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
                  <th>Subjects</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>
@endsection