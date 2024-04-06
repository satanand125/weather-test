<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherForecast extends Model
{
    protected $table = 'weather_forecasts';
    protected $fillable = ['city','coordinates', 'weather_condition', 'temperature', 'feels_like', 'humidity', 'wind_speed'];
}
