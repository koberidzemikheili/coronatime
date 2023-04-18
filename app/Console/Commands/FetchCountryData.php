<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Country;

class FetchCountryData extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'fetch:CountryData';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Fetch countries data from API and store it in the database';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$data = json_decode(file_get_contents('https://devtest.ge/countries'), true);

		$bar = $this->output->createProgressBar(count($data));

		foreach ($data as $item) {
			$country = new Country;
			$country->code = $item['code'];
			$country->setTranslation('name', 'en', $item['name']['en']);
			$country->setTranslation('name', 'ka', $item['name']['ka']);
			$country->save();
			$bar->advance();
		}

		$bar->finish();

		$this->info('Country data fetched and stored successfully!');
	}
}
