@extends('layouts.app_new')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Bookings</div>
                <div class="card-body">
                      <div class="table-responsive">          
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Room</th>
                            <th>Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(count($data)>0)
                        @foreach($data as $temp)
                          <tr>
                            <td>{{++$i}}</td>
                            <td>{{$temp['room_no']}}</td>
                            <td>{{\Carbon\Carbon::parse($temp['date'])->format('d/m/Y')}}</td>
                            <td><button id="{{$temp['id']}}" class="btn btn-danger booking_delete">Delete</button></td>
                          </tr>
                        @endforeach
                        @else
                        <td colspan="4" class="text-center">No Bookings</td>
                        @endif
                        </tbody>
                      </table>
                      {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
