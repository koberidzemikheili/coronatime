<x-layout>
    <div class="mx-auto lg:max-w-xl flex items-center flex-col">
<x-home-logo class="mt-5 mb-5"></x-home-logo>
        <h2 class="text-2xl font-bold text-left mb-6 mt-32">{{ trans('titles.resetpassword') }}</h2>
        <form method="POST" action="#" class="mx-5">
          @csrf
          <x-inputfield label="{{ trans('titles.email') }}"
          name="email"
          type="email"
          value="{{ old('email') }}"
          placeholder="Enter your Email" />
          
            <button type="submit" 
            class="w-full bg-green-500 hover:bg-green-700 text-white font-bold px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50 mt-5">
            {{ trans('titles.resetpassword') }}
            </button>
          </div>
        </form>
        </div>
    </div>
    </x-layout>