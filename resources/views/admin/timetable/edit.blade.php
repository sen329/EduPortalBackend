@extends('layouts.admin_template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header">Edit Schedule {{$timetable->id}}</div>

                    <div class="box-body">
                        <form action="{{ route('admin.timetable.update', $timetable->id) }}" method="POST">
                            @csrf
                            {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="lecturer_id" class="col-md-4 col-form-label text-md-right">{{ __('Lecturer') }}</label>

                            <div class="col-md-6">
                            <select class="form-control select2" name="lecturer_id" id="lecturerSelect">
                                @foreach($lecturers as $lecturer)
                                    <option value="{{$lecturer->id}}">{{$lecturer->name}} </option>
                                @endforeach      
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="online" class="col-md-4 col-form-label text-md-right">{{ __('Online/Offline') }}</label>

                            <div class="col-md-6">
                            <label for="online">Online</label>
                            <input type="radio" id="Online" name="online" value="1" @if($timetable->online == 1) checked @endif>
                            <label for="offline">Offline</label>
                            <input type="radio" id="offline" name="online" value="0" @if($timetable->online == 0) checked @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ $timetable->address }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control" name="date" value="{{ $timetable->date }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Time" class="col-md-4 col-form-label text-md-right">{{ __('Time') }}</label>

                            <div class="col-md-6">
                                <input id="time" type="time" class="form-control" name="time" value="{{ $timetable->time }}">
                            </div>
                        </div>

                            <button type="submit" class="btn btn-primary">
                            update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection