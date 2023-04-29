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
		$search = $request->search;
		$sort = $request->sort ?? $request->country_name;
		$direction = $request->direction ?? $request->asc;
		$locale = session('locale') ?? 'en';
		$statistics = Statistic::query()
		->when($search, function ($query, $search) {
			return $query->orWhere('country_name->ka', 'like', '%' . $search . '%')
						 ->orWhere('country_name->en', 'like', '%' . $search . '%');
		})
		->when($sort, function ($query, $sort) use ($direction, $locale) {
			if ($sort == 'country_name') {
				return $query->orderByRaw("json_extract(country_name, '$." . $locale . "') " . $direction);
			} else {
				return $query->orderBy($sort, $direction);
			}
		})
		->get();

		return view(
			'bycountry-content',
			['statistics' => $statistics, 'search' => $search, 'sort' => $sort, 'direction' => $direction, 'sums'=>$this->sum()]
		);
	}

	public function sum(): array
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
