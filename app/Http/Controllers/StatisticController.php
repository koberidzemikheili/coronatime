<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class StatisticController extends Controller
{
	public function show(): View
	{
		return view('worldwide-content', ['sums'=>$this->sum()]);
	}

	public function index(Request $request): View
	{
		$search = $request->input('search');
		$sort = $request->input('sort', 'country_name');
		$direction = $request->input('direction', 'asc');

		$statistics = Statistic::query()
		->join('countries', 'statistics.country_id', '=', 'countries.id')
		->select('statistics.*', 'countries.name as country_name')
		->when($search, function ($query, $search) {
			return $query->where('countries.name', 'like', '%' . $search . '%');
		})
		->orderBy('statistics.' . $sort, $direction)
		->get();

		return view(
			'bycountry-content',
			['statistics' => $statistics, 'search' => $search, 'sort' => $sort, 'direction' => $direction, 'sums'=>$this->sum()]
		);
	}

	public function sum()
	{
		$statistics = Statistic::all();
		$sums = [
			'confirmed_sum' => $statistics->sum('confirmed'),
			'deaths_sum'    => $statistics->sum('deaths'),
			'recovered_sum' => $statistics->sum('recovered'),
		];

		return $sums;
	}
}
