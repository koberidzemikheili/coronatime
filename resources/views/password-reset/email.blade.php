<x-layout>
    <div class="mx-auto lg:max-w-xl flex items-center flex-col">
<x-home-logo class="mt-5 mb-5"></x-home-logo>
        <h2 class="text-2xl font-bold text-left mb-6 mt-32">{{ trans('titles.resetpassword') }}</h2>
        <form method="POST" action="#" class="mx-5">
          @csrf
          <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">{{ trans('titles.email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"  placeholder="Enter your Email"
            class="w-full px-4 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
            @error('email')
              <span class="text-red-500 mt-2 text-sm" role="alert">
                {{ $message }}
              </span>
            @enderror
            <button type="submit" 
            class="w-full bg-green-500 hover:bg-green-700 text-white font-bold px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50 mt-5">
            {{ trans('titles.resetpassword') }}
            </button>
          </div>
        </form>
        </div>
    </div>
    </x-layout>