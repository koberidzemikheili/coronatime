
<div class="mb-4">
    <label for="{{ $name }}" class="block text-gray-700 font-medium mb-2">{{ $label }}</label>
    <div class="relative">
      <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}"
        class="w-full px-4 py-2 rounded-md
        @error($name) border border-red-500 outline-red-500 @enderror
        @if(!empty($value)) border border-green-500 outline-green-500 @endif
        @if(!$errors->any() && empty($value)) border border-gray-400 @endif
        focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
        @if(!$errors->has($name) && !empty($value))
      <img src="/success.png" alt="Success" class="absolute right-4 top-1/2 transform -translate-y-1/2 h-6 w-6">
      @endif
    </div>
    @error($name)
    <div class="flex mt-2">
      <img src="/error.png" alt="Error" class="mr-2 h-6 w-6">
      <span class="text-red-500 text-sm" role="alert">
        {{ $message}}
      </span>
    </div>
    @enderror
  </div>