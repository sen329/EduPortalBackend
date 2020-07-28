@extends('layouts.admin_template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header"><h3 class="box-title">Approve student registration {{ $studentreg->id }}</h3></div>

                    <div class="box-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('error') }}
                        </div>
                    @endif
                        <form action="{{ route('admin.studentreg.update', $studentreg->id) }}" method="POST">
                            @csrf
                            {{ method_field('PUT') }}

                        <p> Student name: {{ $studentreg->student->name}} </p>
                        <br>
                        <p> Subject: {{ $studentreg->subject->name}} </p>
                        <br>

                        <div class="profile-header-img">
                                <img class="img-thumbnail" height="300px" width="300px" src="/storage/reciepts/{{ $studentreg->pay_reciept }}" />
                        </div>
                        <br>
                            <label for="paid" class="col-md-4 col-form-label text-md-right">{{ __('Paid') }}</label>
                                <input type="checkbox" name="paid" value=1>
                            <br>
                            <div class="box-footer">
                            <button type="submit" class="btn btn-primary">
                            update
                            </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection