<x-layout>
    <div class="mx-auto lg:max-w-xl flex items-center flex-col">
    <x-home-logo class="mt-5 mb-5"></x-home-logo>
    <div class="flex items-center flex-col  mt-32">
        <img src="/success.gif" class="animate-play-once">
        <div class="text-xl text-left mb-12 mt-3">Your account is verified, you can sign in</div>
      
            <a href="{{route('login.view')}}"
            class="w-full bg-green-500 hover:bg-green-700 text-white font-bold px-4 py-2 rounded-md flex justify-center">
              SIGN IN</a>
          </div>
        </div>
    </div>
    </div>
    </x-layout>