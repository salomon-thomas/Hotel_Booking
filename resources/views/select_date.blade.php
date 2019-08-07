@extends('layouts.app_new')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Select Date</div>

                <div class="card-body">
                    {!! Form::open(array('route' => 'select_date_do', 'class' => 'form-horizontal','id'=>'AddForm','method'=>'POST')) !!} 

                    {{Form::token()}}
                    <div class="input-group date" data-date-format="dd.mm.yyyy">
                     <input type="text" name="date" id="datepicker">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Set</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
