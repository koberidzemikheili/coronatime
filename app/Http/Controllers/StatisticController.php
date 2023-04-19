<?php

namespace App\Http\Controllers;

use App\Models\Statistic;

class StatisticController extends Controller
{
	public function index()
	{
		$statistics = Statistic::all();
		return view('bycountry-content', compact('statistics'));
	}
}
