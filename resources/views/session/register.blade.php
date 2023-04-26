<x-layout>
    <div class="flex flex-col lg:flex-row items-start w-full px-4 lg:px-0">
      <div class="lg:w-7/12 mx-auto">
      <div class="lg:max-w-3xl lg:mx-32 lg:mt-10">
        <x-home-logo class="mb-5 mt-5"></x-home-logo>
        <h2 class="text-2xl font-bold text-left lg:mb-6">{{ trans('titles.welcometocoronatime') }}</h2>
        <div class="mb-4 text-gray-700">{{ trans('titles.enterrequiredinfo') }}</div>
        <form method="POST" action="{{route('register')}}" class="w-full lg:w-1/2">
          @csrf
          <x-inputfield label="{{ trans('titles.username') }}"
               name="username"
               type="text"
               value="{{ old('username') }}"
               required="true"
               autocomplete="username"
               placeholder="Enter Username" />

          <x-inputfield label="{{ trans('titles.email') }}"
               name="email"
               type="email"
               value="{{ old('email') }}"
               placeholder="Enter Email" />
                    
          <x-inputfield label="{{ trans('titles.password') }}"
               name="password"
               type="password"
               value="{{ old('password') }}"
               placeholder="Fill in password" />

          <x-inputfield label="{{ trans('titles.passwordrepeat') }}"
               name="password_confirmation"
               type="password"
               value=""
               placeholder="Repeat password" />
          <div class="flex items-center justify-between">
            <button type="submit" 
            class="w-full bg-green-500 hover:bg-green-700 text-white font-bold px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50">
            {{ trans('titles.register') }}
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
