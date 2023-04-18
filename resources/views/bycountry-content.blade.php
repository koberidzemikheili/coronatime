<x-layout>
    <x-header :title="'Bycountry Statistics'" :bycountryClass="'opacity-100 underline'" :worldwideClass="''"></x-header>
    <div class="overflow-x-auto">
      <table class="w-full table-auto text-sm lg:text-lg">
        <thead>
          <tr>
            <th class="px-4 py-2">Location</th>
            <th class="px-4 py-2">New Cases</th>
            <th class="px-4 py-2">Deaths</th>
            <th class="px-4 py-2">Recovered</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Worldwide</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
          @foreach($statistics as $statistic)
              <td>{{ $statistic->country->name}}</td>
              <td>{{ $statistic->confirmed }}</td>
              <td>{{ $statistic->recovered }}</td>
              <td>{{ $statistic->deaths }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
      </div>
      
      
</x-layout>