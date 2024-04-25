<div>
<span class="max-w-sm mx-auto bg-gray-100 inline-block rounded-xl">Category
    <select wire:model="category" id="category" class="bg-transparent py-2 px-2 text-sm font-semibold">
        <option value="all">All</option>
        <option value="1">Health</option>
        <option value="2">Education</option>
        <option value="3">Medical</option>
        <option value="4">Climate</option>
        <option value="5">Politics</option>
        <option value="6">Spiritual</option>
        <option value="7">Financial</option>
        <option value="8">Farming</option>
        <option value="9">Other</option>
    </select>
    </span>
    @include('partials.displaylist')
</div>
