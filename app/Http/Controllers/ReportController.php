<?php

namespace App\Http\Controllers;

use App\Models\QuickCount;
use App\Models\Village;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function show($record)
    {
        $calegId = $record->id;
        // $keluarahans = Village::where('district_id', $districtId)->get();
        $tps = 55;

        $totalVote = QuickCount::where('caleg_id', $calegId)->sum('vote');

        $data = [
            // 'record' => $keluarahans
            'record' => $totalVote
        ];

        return view('report', $data);
    }
}
