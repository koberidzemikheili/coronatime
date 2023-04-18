<div x-data="{ open: false, selected: '{{ app()->getLocale() }}' }">
    <div>
        <button x-on:click="open = !open" class="inline-flex justify-center w-full">
            <span x-text="selected === 'en' ? 'English' : 'ქართული'"></span>
            <svg class="-mr-1  h-5 w-5" x-bind:class="{'rotate-180': open}" x-description="Heroicon name: chevron-down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 011.414 0l.086.086a1 1 0 010 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414l.086-.086z" clip-rule="evenodd" />
            </svg>
        </button>

        <div x-show="open" x-on:click.away="open = false"
         class="origin-top-right absolute mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none">
            <div class="py-1">
                <a x-on:click.prevent="selected = 'en'; open = false; window.location.href = '?lang=en';" 
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">English</a>
                <a x-on:click.prevent="selected = 'ka'; open = false; window.location.href = '?lang=ka';"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">ქართული</a>
            </div>
        </div>
    </div>
</div>
