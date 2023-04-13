
<x-layout>
    <x-header :title="'Worldwide Statistics'" :worldwideClass="'underline opacity-100'" :bycountryClass="''" ></x-header>
      <div class="flex flex-wrap justify-center mb-4">
        <div class="bg-white rounded-lg shadow-lg p-4 w-full md:w-1/3 lg:w-auto lg:mx-4 mb-4 lg:mb-0">
          <div class="flex justify-center items-center flex-col lg:px-20 lg:py-10 bg-blue-900 bg-opacity-10">
            <img src="/blue.png" alt="Logo" />
            <div>
              <div class="text-lg font-bold text-gray-900 mb-2">Total Cases</div>
              <p class="text-2xl font-bold text-blue-600">1,000,000</p>
            </div>
          </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-4 w-full md:w-1/3 lg:w-auto lg:mx-4 mb-4 lg:mb-0">
          <div class="flex justify-center items-center flex-col lg:px-20 lg:py-10 bg-green-900 bg-opacity-10">
            <img src="/green.png" alt="Logo" class="h-12 mr-2" />
            <div>
              <h2 class="text-lg font-bold text-gray-900 mb-2">Total Deaths</h2>
              <p class="text-2xl font-bold text-red-600">100,000</p>
            </div>
          </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-4 w-full md:w-1/3 lg:w-auto lg:mx-4">
          <div class="flex justify-center items-center flex-col lg:px-20 lg:py-10 bg-yellow-900 bg-opacity-10">
            <img src="/yellow.png" alt="Logo" class="h-12 mr-2" />
            <div>
              <h2 class="text-lg font-bold text-gray-900 mb-2">Total Recovered</h2>
              <p class="text-2xl font-bold text-green-600">900,000</p>
            </div>
          </div>
        </div>
      </div>  
</x-layout>
