
<div class="flex items-center bg-white py-4 px-8">
    <img src="/icon.svg" alt="Logo" />
    <div class="text-right ml-auto flex items-center">
        <x-lang-button></x-lang-button>
    </div>
    <div class="hidden sm:flex items-center ml-4">
        <span class="font-bold">{{auth()->user()->username}}</span>
        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="block px-4 py-2 text-sm ">
          @csrf
          <button type="submit" class="text-l font-bold">Log Out</button>
      </form>   
      </div>

    <div x-data="{ isVisible: false }">
      <img src="/menubutton.png" class="sm:hidden ml-10" @click="isVisible = !isVisible">
    
      <div x-show="isVisible" 
      class="absolute mt-2 rounded-md  bg-white divide-y">
         
             <div class="block px-4 py-2 text-sm">{{auth()->user()->username}}</div>
             <form id="logout-form" method="POST" action="{{ route('logout') }}" class="block px-4 py-2 text-sm ">
              @csrf
              <button type="submit" class="text-l font-bold">Log Out</button>
          </form>   
             
     </div>
    </div>
  </div>
  <div class="container mx-auto my-8 px-4 md:px-0">
    <h1 class="text-4xl font-bold text-left mb-4">{{ $title }}</h1>
    <div class="flex items-center mb-4 font-bold py-2 px-4 rounded-full mr-2">
      <a href="{{route('landing')}}" class="font-bold py-2 px-4 rounded-full mr-2 opacity-50 {{ $worldwideClass }}">Worldwide</a>
      <a href="{{route('bycountry')}}" class="font-bold py-2 px-4 rounded-full opacity-50 {{ $bycountryClass }}">By Country</a>
    </div>
</div>