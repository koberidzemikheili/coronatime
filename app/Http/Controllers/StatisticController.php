<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Contracts\View\View;

class StatisticController extends Controller
{
	public function index(): View
	{
		$statistics = Statistic::all();
		return view('bycountry-content', compact('statistics'));
	}
}
