<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FlightSearchController;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class SearchFlightController extends Controller
{
    public function index () {
        return view('search');
    }

    public function search (Request $request, Client $client) {
        $originLocationCode = $request['from'];
        $destinationLocationCode = $request['to'];
        $date = $request['date'];
        $passengers = $request['passengers'];

        //return redirect()->action(FlightSearchController::class);

        try {
            $response = $client->post('http://localhost/api/search');

            return $response->getBody();
        } catch (GuzzleException $exception) {
            ddd($exception);
        }

        return true;

        // client->post('api/search');

        // return view('search')->with('flights', ['5', '5']);
    }
}
