<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UrlClick;

class UrlClickController extends Controller
{
    public function getStatistics($urlId)
    {
        $data = UrlClick::select(DB::raw('DATE(registered_at) AS date, COUNT(*) as clicks_count'))
            ->where('url_id', $urlId)
            ->groupBy(DB::raw('date WITH ROLLUP'))
            ->get();

        return response()->json($data);
    }
}
