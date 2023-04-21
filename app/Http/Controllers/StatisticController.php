<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class StatisticController extends Controller
{
	public function show(): View
	{
		$sums = Statistic::selectRaw('SUM(confirmed) as confirmed_sum, SUM(deaths) as deaths_sum, SUM(recovered) as recovered_sum')
		->first();

		return view('worldwide-content', ['sums'=>$sums]);
	}

	public function index(Request $request): View
	{
		$search = $request->input('search', '');
		$sort = $request->input('sort', 'country_name');
		$direction = $request->input('direction', 'asc');
		$sums = Statistic::selectRaw('SUM(confirmed) as confirmed_sum, SUM(deaths) as deaths_sum, SUM(recovered) as recovered_sum')
		->first();

		$statistics = Statistic::query()
			->join('countries', 'statistics.country_id', '=', 'countries.id')
			->select('statistics.*', 'countries.name as country_name')
			->where('countries.name', 'like', '%' . $search . '%')
			->orderBy('statistics.' . $sort, $direction)
			->get();

		return view(
			'bycountry-content',
			['statistics' => $statistics, 'search' => $search, 'sort' => $sort, 'direction' => $direction, 'sums'=>$sums]
		);
	}
}
