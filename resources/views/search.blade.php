@extends('layouts.main')

@section('content')
    <div class="card p-5">
        <h2 class="text-center">Search Flights</h2>
        <form action="/api/search" class="mt-3" method="POST">
            @csrf

            <div class="row">
                <div class="form-group col-6">
                    <input type="text" class="form-control" placeholder="From" name="from" required>
                </div>

                <div class="form-group col-6">
                    <input type="text" class="form-control" placeholder="To" name="to" required>
                </div>

                <div class="form-group col-6 mt-3">
                    <input type="date" class="form-control" placeholder="Departure Date" name="date" required>
                </div>

                <div class="form-group col-6 mt-3">
                    <input type="number" class="form-control" placeholder="Passengers" name="passengers" required>
                </div>

                <div class="form-group col-12 mt-3">
                    <button class="btn btn-primary form-control" type="submit">Search</button>
                </div>
            </div>
        </form>

        @if(isset($flights) && count($flights) > 0)
            <h2 class="text-center mt-5">Results</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Price (EUR)</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($flights as $flight)
                        <tr>
                            <th scope="row">1</th>
                            <td>10H10M</td>
                            <td>482.55</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
