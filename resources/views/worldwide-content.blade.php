
<x-layout>
    <x-header :title="'Worldwide Statistics'" :worldwideClass="'underline opacity-100'" :bycountryClass="''" ></x-header>
      <div class="flex flex-wrap justify-center mb-4">

        <div class="lg:mx-4 mb-4 lg:mb-0 relative lg:h-60 lg:w-80 h-64 w-96">
          <div class="absolute top-0 left-0 right-0 bottom-0 bg-blue-900 bg-opacity-10 rounded-lg"></div>
          <div class="flex justify-center items-center flex-col lg:px-20 lg:py-10 h-full">
            <img src="/blue.png" alt="Logo" />
            <div>
              <div class="text-lg font-bold text-gray-900 mb-2">Total Cases</div>
              <p class="text-2xl font-bold text-blue-600">{{$sums->confirmed_sum}}</p>
            </div>
          </div>
        </div>
        
        <div class="flex justify-center items-center">
          <div class="lg:mx-4 mb-4 lg:mb-0 relative mr-5 lg:h-60 lg:w-80 w-44 h-64">
            <div class="absolute top-0 left-0 right-0 bottom-0 bg-green-900 bg-opacity-10 rounded-lg"></div>
            <div class="flex justify-center items-center flex-col lg:px-20 lg:py-10 lg:mt-7 h-full">
              <img src="/green.png" alt="Logo" />
              <div>
                <div class="text-lg font-bold text-gray-900 mb-2">Total Deaths</div>
                <p class="text-2xl font-bold text-green-600">{{$sums->deaths_sum}}</p>
              </div>
            </div>
          </div>
        
          <div class="lg:mx-4 mb-4 lg:mb-0 relative lg:h-60 lg:w-80 w-44 h-64">
            <div class="absolute top-0 left-0 right-0 bottom-0 bg-yellow-400 bg-opacity-10 rounded-lg"></div>
            <div class="flex justify-center items-center flex-col lg:px-20 lg:py-10 lg:mt-5 h-full">
              <img src="/yellow.png" alt="Logo" />
              <div class="text-lg font-bold text-gray-900 mb-2">Total Recovered</div>
              <p class="text-2xl font-bold text-yellow-400">{{$sums->recovered_sum}}</p>
            </div>
          </div>
        </div>
      </div>
        </div>
</x-layout>
