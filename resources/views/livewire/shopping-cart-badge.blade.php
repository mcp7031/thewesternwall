<div>
    <div class="relative">
        <div class="bg-red-500 text-white w-6 h-6 rounded-full flex items-center justify-center absolute top-0 right-0 -mt-1 -mr-1">
            {{ $itemCount }}
        </div>
    </div>
    @if (isset($itemCount) && $itemCount > 0)
    <button @click="dropdownMenu = !dropdownMenu" class="text-gray-500 px-2">
        <i x-show="!dropdownMenu" class="font-['Font Awesome'] fa fa-shopping-cart fa-2x fa-fw"> </i>
        <svg x-show="dropdownMenu" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" >
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <!-- Dropdown list -->
    <div x-show="dropdownMenu" class="py-2 bg-gray-100 rounded-md shadow-xl w-22">
        <a class="block px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-400" href="/cart">
            Show
        </a>
        <a class="block px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-400" href="/checkout">
            Checkout
        </a>
    </div>
    @else
    <button class="text-gray-500 px-2">
        <i x-show="" class="font-['Font Awesome'] fas fa-shopping-basket fa-2x fa-fw"> </i>
    </button>
    @endif
</div>

