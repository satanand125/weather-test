<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Models\WeatherForecast;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    // Fetch weather forecast data for all cities
    public function weatherBycity()
    {
        $CurrentData = [];
        $cities = City::all();
        
        // Iterate over each city to fetch the latest weather forecast
        foreach ($cities as $key => $city) {
            $cityNameParts = explode(',', $city->city_name);
            $firstWord = trim($cityNameParts[0]);
            // Fetch latest weather forecast for each city
            $CurrentData[$key] = WeatherForecast::where('city', 'LIKE', $firstWord . '%')->latest('created_at')
                ->first();
        }

        if (!$CurrentData) {
            // Return 404 if no weather data found for any city
            return response()->json([
                'code' => 404,
                'status' => true,
                'message' => 'City not found',
            ], 404);
        }
        // Return weather forecast data for all cities
        return response()->json([
            'code' => 200,
            'status' => true,
            'data' => $CurrentData,
            'message' => 'weather forecast details fetched',
        ], 200);
    }

    // Fetch hourly weather forecast for a specific city
    public function weatherByHours($cityName)
    {
        try {
            $twentyFourHoursAgo = Carbon::now()->subHours(24);
            $CurrentData = [];
            $hourlyTempData = [];
            $hourlyHumidityData = [];
            $hourlyWspeedData = [];

            $cities = City::all();

            // Iterate over each city to fetch the latest weather forecast
            foreach ($cities as $key => $city) {
                $cityNameParts = explode(',', $city->city_name);
                $firstWord = trim($cityNameParts[0]);
                // Fetch latest weather forecast for each city
                $CurrentData[$key] = WeatherForecast::where('city', 'LIKE', $firstWord . '%')->latest('created_at')
                    ->first();
            }

            $now = Carbon::now();
            $twentyFourHoursAgo = $now->subHours(24);

            // Calculate hourly weather data for the past 24 hours
            for ($i = 0; $i < 24; $i++) {
                $startTime = $twentyFourHoursAgo->copy()->addHours($i);
                $endTime = $startTime->copy()->addHour();
                $hourlyTempData[$i]['start_time'] = $startTime->format('Y-m-d H:i:s');
                $hourlyTempData[$i]['end_time'] = $endTime->format('Y-m-d H:i:s');

                $hourlyTempData[$i]['temperature'] = WeatherForecast::where('city', $cityName)
                    ->whereBetween('created_at', [$startTime, $endTime])
                    ->avg('temperature');

                $hourlyWspeedData[$i]['start_time'] = $startTime->format('Y-m-d H:i:s');
                $hourlyWspeedData[$i]['end_time'] = $endTime->format('Y-m-d H:i:s');

                $hourlyWspeedData[$i]['wind_speed'] = WeatherForecast::where('city', $cityName)
                    ->whereBetween('created_at', [$startTime, $endTime])
                    ->avg('wind_speed');

                $hourlyHumidityData[$i]['start_time'] = $startTime->format('Y-m-d H:i:s');
                $hourlyHumidityData[$i]['end_time'] = $endTime->format('Y-m-d H:i:s');

                $hourlyHumidityData[$i]['humidity'] = WeatherForecast::where('city', $cityName)
                    ->whereBetween('created_at', [$startTime, $endTime])
                    ->avg('humidity');
            }

            // Prepare response data
            $response = [
                'current_data' => $CurrentData,
                'temp_data' => $hourlyTempData,
                'humidity_data' => $hourlyHumidityData,
                'wSpeed_data' => $hourlyWspeedData,
            ];

            // Return response with weather forecast details
            return response()->json([
                'code' => 200,
                'status' => true,
                'data' => $response,
                'message' => 'weather forecast details fetched',
            ], 200);
        } catch (\Throwable $th) {
            // Return 404 if city name not found
            return response()->json([
                'code' => 404,
                'status' => false,
                'message' => 'City name not found',
            ], 200);
        }
       
    }
}
