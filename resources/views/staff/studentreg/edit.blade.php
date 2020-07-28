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
                        <form action="{{ route('staff.studentreg.update', $studentreg->id) }}" method="POST">
                            @csrf
                            {{ method_field('PUT') }}

                        <h2> {{ $studentreg->student->name}} </h2>
                        <br>
                        <h2> {{ $studentreg->subject->name}} </h2>
                        <br>

                        <div class="profile-header-img">
                                <img class="img-thumbnail" height="200px" width="200px" src="/storage/reciepts/{{ $studentreg->pay_reciept }}" />
                        </div>


                        
                            <label for="paid" class="col-md-4 col-form-label text-md-right">{{ __('Paid') }}</label>

                           
                                <input type="checkbox" name="paid" value=1>


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