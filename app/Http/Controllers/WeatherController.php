<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * Display weather forecast of the user on the specified day (via geoip).
     *
     * @param string $day
     * @return \Illuminate\Http\Response
     */
    public function index($day = 0)
    {
        $city = geoip()->getLocation($ip = '81.104.180.170')->getAttribute("city");
        $weather = $this->getWeather($city);

        $day = $this->getDay($day);

        return view('weather.show', [ 'weather' => $weather, 'day' => $day ]);
    }

    /**
     * Display the weather forecast for a city on the specified day.
     *
     * @param  string  $city
     * @param string $day
     * @return \Illuminate\Http\Response
     */
    public function show_city($city, $day = 0)
    {
        try
        {
            $weather = $this->getWeather($city);
        }
        catch(\ErrorException $e)
        {

                return view('weather.404', ['error' => 'Unable to retrieve forecast for '.$city]);
        }

        $day = $this->getDay($day);

        return view('weather.show', [ 'weather' => $weather, 'day' => $day ]);
    }

    /*
     * Gets the weather forecast from yahoo and returns as an object
     */
    private function getWeather($city)
    {
        $BASE_URL = "http://query.yahooapis.com/v1/public/yql";
        $yql_query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="'.$city.'")';
        $yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json";
        // Make call with cURL
        $session = curl_init($yql_query_url);
        curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
        $json = curl_exec($session);

        // Convert JSON to PHP object
        $phpObj =  json_decode($json);
        return $phpObj->query->results->channel;
    }

    private function getDay($day)
    {
        $today = date("l", strtotime("today"));

        if ($day != $today) {
            return floor((strtotime('next ' . $day) - time()) / 60 / 60 / 24) + 1;
        }
        return 0;
    }
}
