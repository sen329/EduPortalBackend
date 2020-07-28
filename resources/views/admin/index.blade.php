@extends('layouts.admin_template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header">Dashboard</div>

                <div class="box-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('error') }}
                        </div>
                    @endif
                    <br>
                    <div class="card card-primary card-outline">
              <div class="box-body">
                <h5 class="box-title">Main menu</h5>
                <a href="admin/staff" class="btn btn-primary btn-lg active btn-block" role="button" >Manage Staffs</a>
                <a href="admin/lecturer" class="btn btn-primary btn-lg active btn-block" role="button" >Manage Lecturers</a>
                <a href="admin/student" class="btn btn-primary btn-lg active btn-block" role="button" >Manage Students</a>
                <a href="admin/subject" class="btn btn-primary btn-lg active btn-block" role="button" >Manage Subjects</a>
                <a href="admin/studentreg" class="btn btn-primary btn-lg active btn-block" role="button" >Manage Class registers</a>
                <a href="admin/timetable" class="btn btn-primary btn-lg active btn-block" role="button" >Manage Class Schedules</a>
                <!-- <a href="admin/classes" class="btn btn-primary btn-lg active btn-block" role="button" >Manage Classes</a> -->
              </div>
            </div>

                    <!-- <a href="/product"><button type="button" class="btn btn-primary btn-lg btn-block">product</button></a> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
