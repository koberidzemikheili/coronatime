<x-layout>
    <div class="mx-auto lg:max-w-xl flex items-center flex-col">
<x-home-logo class="mt-5 mb-5"></x-home-logo>
        <div class="text-2xl font-bold text-left mb-6 mt-32">Reset Password</div>
        <form method="POST" action="{{route('password.update')}}" class="mx-5">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">
          <input type="hidden" name="email" value="{{ $email }}"/>
          <div class="mb-4">
            <label for="password" class="block text-gray-700 font-medium mb-2">New password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Fill in password"
            class="w-full px-4 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
            @error('password')
              <span class="text-red-500 mt-2 text-sm" role="alert">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Repeat password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat password"
              class="w-full px-4 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
          </div>
          @error('password_confirmation')
          <span class="text-red-500 mt-2 text-sm" role="alert">
            {{ $message }}
          </span>
          @enderror
            <button type="submit" 
            class="w-full bg-green-500 hover:bg-green-700 text-white font-bold px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50 mt-5">
              SAVE CHANGES
            </button>
          </div>
        </form>
        </div>
    </div>
    </x-layout>