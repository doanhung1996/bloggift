<?php

namespace App\Http\Controllers\Admin;

use Analytics;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Analytics\Period;
use App\Http\Controllers\Controller;


class TopReferrerController extends Controller
{
    public function __invoke()
    {
        $startDate = Carbon::today(config('app.timezone'))->startOfMonth();
        $endDate = Carbon::today(config('app.timezone'))->endOfMonth();
        $period = Period::create($startDate, $endDate);

        $topReferrers = Analytics::fetchTopReferrers($period, 10);

        return view('admin.topReferrers', compact('topReferrers'));
    }
}
