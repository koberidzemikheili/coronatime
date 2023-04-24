<x-layout>
    <div class="mx-auto lg:max-w-xl flex items-center flex-col">
<x-home-logo class="mt-5 mb-5"></x-home-logo>
        <div class="text-2xl font-bold text-left mb-6 mt-32">{{ trans('titles.resetpassword') }}</div>
        <form method="POST" action="{{route('password.update')}}" class="mx-5">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">
          <input type="hidden" name="email" value="{{ $email }}"/>
          <x-inputfield label="{{ trans('titles.newpassword') }}"
               name="password"
               type="password"
               value="{{ old('password') }}"
               placeholder="Fill in password" />
          
          <x-inputfield label="{{ trans('titles.passwordrepeat') }}"
               name="password_confirmation"
               type="password"
               value=""
               placeholder="Repeat password" />
            <button type="submit" 
            class="w-full bg-green-500 hover:bg-green-700 text-white font-bold px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50 mt-5">
            {{ trans('titles.savechanges') }}
            </button>
          </div>
        </form>
        </div>
    </div>
    </x-layout>