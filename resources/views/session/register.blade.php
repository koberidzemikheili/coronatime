<x-layout>
    <div class="flex flex-col lg:flex-row items-start w-full px-4 lg:px-0">
      <div class="lg:w-7/12 mx-auto">
      <div class="lg:max-w-3xl lg:mx-32 lg:mt-10">
        <x-home-logo class="mb-5 mt-5"></x-home-logo>
        <h2 class="text-2xl font-bold text-left lg:mb-6">{{ trans('titles.welcometocoronatime') }}</h2>
        <div class="mb-4 text-gray-700">{{ trans('titles.enterrequiredinfo') }}</div>
        <form method="POST" action="{{route('register')}}" class="w-full lg:w-1/2">
          @csrf
          <div class="mb-4">
            <label for="username" class="block text-gray-700 font-medium mb-2">{{ trans('titles.username') }}</label>
            <input id="username" type="text" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Enter Username"
            class="w-full px-4 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
            @error('username')
              <span class="text-red-500 mt-2 text-sm" role="alert">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">{{ trans('titles.email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email"
            class="w-full px-4 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
            @error('email')
              <span class="text-red-500 mt-2 text-sm" role="alert">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="mb-4">
            <label for="password" class="block text-gray-700 font-medium mb-2">{{ trans('titles.password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Fill in password"
            class="w-full px-4 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
            @error('password')
              <span class="text-red-500 mt-2 text-sm" role="alert">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">{{ trans('titles.passwordrepeat') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat password"
              class="w-full px-4 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
          </div>
          @error('password_confirmation')
          <span class="text-red-500 mt-2 text-sm" role="alert">
            {{ $message }}
          </span>
          @enderror
          <div class="flex items-center justify-between">
            <button type="submit" 
            class="w-full bg-green-500 hover:bg-green-700 text-white font-bold px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50">
            {{ trans('titles.login') }}
            </button>
          </div>
          <div class="text-gray-700 mt-5 text-center">
            <a class="text-black font-bold" href="{{route('login.view')}}">{{ trans('titles.alreadyhave') }}</a></div>
        </form>
    </div>
</div>
<div class="hidden lg:block lg:w-5/12 h-screen">
  <img src="/background1.png" alt="image description" class="h-full w-full object-cover">
</div>
</div>
</x-layout>
