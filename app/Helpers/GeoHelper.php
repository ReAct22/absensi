<?php

namespace App\Helpers;

class GeoHelper
{
    public static function distance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000;
        $latFrom = deg2rad($lat1);
        $longForm = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $longTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $longDeltar = $longTo - $longForm;

        $angel = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($longDeltar / 2), 2)));

        return $earthRadius * $angel;
    }
}
