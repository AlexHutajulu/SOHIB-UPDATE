<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Map;
use Illuminate\Http\Request;

class MapsController extends Controller
{
    public function showMaps()
    {
        $maps = Map::with('submission')->get();
        $coordinates = [];

        foreach ($maps as $map) {
            $coordinates[] = [
                'latitude' => $map->latitude,
                'longitude' => $map->longitude,
                'submission' => $map->submission,
            ];
        }

        return view('admin.maps', compact('coordinates'));
    }
}
