<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Models\WeatherForecast as ModelsWeatherForecast;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchWeatherData extends Command
{
    // Command signature and description
    protected $signature = 'fetch:weather';
    protected $description = 'Fetch weather data from API and insert into the database';

    // Handle method to execute the command
    public function handle()
    {
        // Fetch all cities from the database
        $cities = City::all();

        // Iterate over each city to fetch weather data
        foreach ($cities as $city) {
            // Make HTTP request to OpenWeatherMap API to fetch weather data for the city
            $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'q' => $city->city_name,
                'appid' => '4c7f1f68689243332f5672f3f5d973e0', // API key
            ]);

            // Check if the request was successful
            if ($response->successful()) {
                // Extract data from the API response
                $data = $response->json();
                $cityName = $data['name'];
                $temperaturekelvin = $data['main']['temp'];
                $feelsLikekelvin  = $data['main']['feels_like'];
                $humidity = $data['main']['humidity'];
                $windSpeed = $data['wind']['speed'];
                $weatherCondition = $data['weather'][0]['main'];
                $latitude = $data['coord']['lat'];
                $longitude = $data['coord']['lon'];
                $coordinates = $latitude . ',' . $longitude;

                // Convert temperature from Kelvin to Celsius
                $temperatureCelsius =  $temperaturekelvin - 273.15;
                $feelsLikeCelsius = $feelsLikekelvin - 273.15;

                // Create a new weather forecast record in the database
                ModelsWeatherForecast::create([
                    'city' => $cityName,
                    'temperature' => $temperatureCelsius,
                    'feels_like' => $feelsLikeCelsius,
                    'humidity' => $humidity,
                    'wind_speed' => $windSpeed,
                    'weather_condition' => $weatherCondition,
                    'coordinates' => $coordinates,
                ]);

                // Log success message
                \Log::info("Weather data for {$cityName} inserted successfully.");
                $this->info("Weather data for {$cityName} inserted successfully.");
            } else {
                // Log error message if failed to fetch weather data
                \Log::info("else");
                $this->error("Failed to fetch weather data for {$city->city_name}.");
            }

            // Sleep for a short interval to avoid hitting API rate limits
            sleep(2); // You may adjust this value as needed
        }

        // Output success message after fetching weather data for all cities
        $this->info('Weather data for all cities inserted successfully.');
    }
}
