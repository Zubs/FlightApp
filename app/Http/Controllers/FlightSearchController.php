<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class FlightSearchController extends Controller
{
    /**
     * Using the GET endpoint
     * @param Request $request
     * @param Client $client
     * @return \Exception|GuzzleException|\Psr\Http\Message\StreamInterface
     */
//    public function __invoke (Request $request, Client $client)
//    {
//        $url = 'https://test.api.amadeus.com/v2/shopping/flight-offers';
//        $access_token = '8OGlswlpw0H6jmzvNk3p2V9wlBzW';
//
//        $data = [
//            'originLocationCode'     => 'BOS',
//            'destinationLocationCode' => 'PAR',
//            'departureDate'           => '2021-12-27',
//            'adults'                  => 1
//        ];
//
//        // To covert key value pairs into query parameters
//        $data = http_build_query($data);
//
//        // Append the query parameters to the URL
//        $url .= '?' . $data;
//
//        try {
//            $response = $client->get($url, [
//                'headers' => [
//                    'Accept' => 'application/json',
//                    'Authorization' => 'Bearer ' . $access_token
//                ],
//            ]);
//
//            return $response->getBody();
//        } catch (GuzzleException $exception) {
//            dd($exception);
//        }
//    }

    /**
     * Using the POST endpoint
     * @param Request $request
     * @param Client $client
     */
    public function __invoke (Request $request, Client $client)
    {
        $url = 'https://test.api.amadeus.com/v2/shopping/flight-offers';

        if (session('access_token')) {
            $access_token = session('access_token');
        } else {
            $access_token = app('App\Http\Controllers\AccessTokenController')->__invoke($client)->access_token;
            session(['access_token' => $access_token]);
        }

        $travelers = [];

        for ($i = 1; $i <= $request['passengers']; $i++) {
            $travelers[] = [
                'id' => $i,
                'travelerType' => 'ADULT'
            ];
        }

        $data = [
            'originDestinations' => [
                [
                    'id' => 1,
                    'originLocationCode' => $request['from'],
                    'destinationLocationCode' => $request['to'],
                    'departureDateTimeRange' => [
                        'date' => $request['date']
                    ]
                ]
            ],
            'travelers' => $travelers,
            'sources' => [
                'GDS'
            ]
        ];

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ],
                'json' => $data
            ]);

            $response = $response->getBody();
            $response = json_decode($response);

            return view('search')->with('flights', $response->data);
        } catch (GuzzleException $exception) {
            return $exception;
        }
    }
}
