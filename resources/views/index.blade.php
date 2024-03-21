@include('partials.head')
@include('partials.nav')
<header class="mt-10 text-center">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl">
            Latest <span class="text-blue-500">RTV</span> News
        </h1>
        <div class="tw-flex tw-justify-center py-2">
            <span class="relative inline-flex items-center bg-gray-100 inline-block rounded-xl px-3 py-2 text-sm">
                @livewire('Dropdown')
            </span>
        </div>
    </div>
</header>
@include('partials.foot')
