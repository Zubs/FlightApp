@extends('layouts.main')

@section('content')
    <div class="card p-5">
        <h2 class="text-center">Flight Details</h2>
        <p>Flight ordered successfully</p>
        <ul class="list-group">
            <li class="list-group-item">
                <b>ID</b>: {{ $flight->id }}
            </li>

            <li class="list-group-item">
                <b>Reference</b>: {{ $flight->associatedRecords->reference }}
            </li>
        </ul>
    </div>
@endsection
