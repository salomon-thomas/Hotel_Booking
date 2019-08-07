@extends('layouts.app_new')

@section('content')
<script src="https://cdn.rawgit.com/atatanasov/gijgo/master/dist/combined/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://cdn.rawgit.com/atatanasov/gijgo/master/dist/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Booking Sheet</div>

                <div class="card-body">
                {!! Form::open(array('route' => 'make_booking_do', 'class' => 'form-horizontal','id'=>'AddForm','method'=>'POST')) !!} 

                    {{Form::token()}}
                    <br>
                    <input type="hidden" name="date" value="{{$date}}">
                    <table class="table-bordered" width="100%">
                    @for($i=0;$i<=5;$i++)
                        <tr class="text-center" height="50px">
                            @for($j=1+$jmax;$j<=5+$jmax;$j++)
                            
                            @if(in_array($j, array_column($booking, 'room_no')))
                                <td style="background-color:red">
                                <label for="id_{{ $j }}" >{{ $j }}</label>
                            @else
                                <td>
                                <label for="id_{{ $j }}">{{ $j }}</label>
                                <input type="radio" name="{{ $j }}" id="{{ $j }}">
                            @endif
                            </td>
                            @endfor
                        </tr>
                    <?php $jmax=$j-1; ?>
                    @endfor
                    </table>
                    <br>
                    <button type="submit" class="btn btn-primary">Book</button>
                 {!! Form::close() !!} 
                </div>
            </div>
        </div>
    </div>
</div>
<script>
 $('.input-group.date').datepicker({format: "dd.mm.yyyy"}); 
</script>
@endsection
