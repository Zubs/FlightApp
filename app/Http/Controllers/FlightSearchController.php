<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class FlightSearchController extends Controller
{
    public function __invoke (Request $request, Client $client)
    {
        $url = 'https://test.api.amadeus.com/v2/shopping/flight-offers';
        $access_token = '8OGlswlpw0H6jmzvNk3p2V9wlBzW';

        $data = [
            'originLocationCode'     => 'BOS',
            'destinationLocationCode' => 'PAR',
            'departureDate'           => '2021-12-27',
            'adults'                  => 1
        ];

        // To covert key value pairs into query parameters
        $data = http_build_query($data);

        // Append the query parameters to the URL
        $url .= '?' . $data;

        try {
            $response = $client->get($url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ],
            ]);

            return $response->getBody();
        } catch (GuzzleException $exception) {
            dd($exception);
        }
    }
}
