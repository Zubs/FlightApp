@extends('layouts.main')

@section('content')
    <div class="card p-5">
        <h2 class="text-center">Flight Details</h2>
        <ul class="list-group">
            <li class="list-group-item">Price: {{ $data->flightOffers[0]->price->total }}</li>
        </ul>

        <h2 class="text-center mt-5">Booking Requirements</h2>
        <ul class="list-group">
            <li class="list-group-item">Email Address</li>
            <li class="list-group-item">Phone Number</li>
            <li class="list-group-item">Gender</li>
            <li class="list-group-item">Document</li>
        </ul>

        <form action="/api/order" method="POST" class="mt-3">
            @csrf

            <input type="hidden" value="{{ json_encode($data) }}" name="data">

            <button class="btn btn-primary form-control" type="submit">Order</button>
        </form>
    </div>
@endsection
