<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Country;
use App\Models\Statistic;
use Illuminate\Support\Facades\Http;

class FetchStatisticsData extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'fetch:statistics';

	protected $description = 'Fetch data by country code and save to database';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$codes = Country::pluck('code');
		$bar = $this->output->createProgressBar(count($codes));
		foreach ($codes as $code) {
			$response = Http::post('https://devtest.ge/get-country-statistics', ['code' => $code]);
			$data = $response->json();
			$country = Country::where('code', $data['code'])->first();
			$decodedName = json_decode($country->name, true);

			$statistics = new Statistic;
			$statistics->country_code = $data['code'];
			$statistics->setTranslation('country_name', 'en', $decodedName['en']);
			$statistics->setTranslation('country_name', 'ka', $decodedName['ka']);
			$statistics->confirmed = $data['confirmed'];
			$statistics->recovered = $data['recovered'];
			$statistics->deaths = $data['deaths'];
			$statistics->critical = $data['critical'];
			$statistics->created_at = $data['created_at'];
			$statistics->updated_at = $data['updated_at'];
			$statistics->save();
			$bar->advance();
		}

		$bar->finish();
		$this->info('Data fetched and saved successfully!');
	}
}
