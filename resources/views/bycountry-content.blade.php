<x-layout>
    <x-header :title="'Bycountry Statistics'" :bycountryClass="'opacity-100 underline'" :worldwideClass="''"></x-header>
    <div class="overflow-x-auto flex flex-col lg:mx-20 max-h-680">
      <form method="get" action="{{ route('bycountry') }}" class="mb-4">
        <div class="relative">
            <input type="text" name="search" value="{{ $search }}" placeholder="Search by country name"
                class="border border-gray-300 bg-white text-gray-900 rounded-md pl-10 pr-4 py-2 focus:outline-none focus:border-blue-500">
            <button type="submit" class="absolute inset-y-0 left-0 pl-3">
                <img src="/search.png" alt="Search" class="h-6 w-6">
            </button>
        </div>
    </form>  
        <table class="table-auto text-sm lg:text-lg w-full border border-gray-200">
            <thead class="bg-gray-100 text-left">
              <th class="px-4 py-2">
                <a href="{{ route('bycountry', ['sort' => 'country_name', 'direction' => $direction == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                    Location
                </a>
            </th>
                <th class="px-4 py-2">
                    <a href="{{ route('bycountry', ['sort' => 'confirmed', 'direction' => $direction == 'asc' ? 'desc' : 'asc']) }}">
                        Confirmed
                    </a>
                </th>
                <th class="px-4 py-2">
                    <a href="{{ route('bycountry', ['sort' => 'deaths', 'direction' => $direction == 'asc' ? 'desc' : 'asc']) }}">
                        Deaths
                    </a>
                </th>
                <th class="px-4 py-2">
                    <a href="{{ route('bycountry', ['sort' => 'recovered', 'direction' => $direction == 'asc' ? 'desc' : 'asc']) }}">
                        Recovered
                    </a>
                </th>
            </tr>
            
            </thead>
            <tbody class="border-t border-gray-200">
              <tr>
                  <td class="px-4 py-2">Worldwide</td>
                  <td class="px-4 py-2">{{$sums->confirmed_sum}}</td>
                  <td class="px-4 py-2">{{$sums->deaths_sum}}</td>
                  <td class="px-4 py-2">{{$sums->recovered_sum}}</td>
              </tr>
                @foreach($statistics as $statistic)
                <tr>
                    <td class="px-4 py-2">{{ $statistic->country->name}}</td>
                    <td class="px-4 py-2">{{ $statistic->confirmed }}</td>
                    <td class="px-4 py-2">{{ $statistic->deaths }}</td>
                    <td class="px-4 py-2">{{ $statistic->recovered }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
      
</x-layout>