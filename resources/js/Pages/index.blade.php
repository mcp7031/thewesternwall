@include('partials.head')
@include('partials.nav')
<header class="mt-10 text-center">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl">
            Latest <span class="text-blue-500">RTV</span> News
        </h1>
        <div class="tw-flex tw-justify-center py-2">
            <span class="bg-gray-100 inline-block rounded-xl">Category
                <select class="bg-transparent py-2 px-2 text-sm font-semibold">
                    <option value="all">All</option>
                    <option value="health">Health</option>
                    <option value="education">Education</option>
                    <option value="medical">Medical</option>
                    <option value="climate">Climate</option>
                    <option value="politics">Politics</option>
                    <option value="spiritual">Spiritual</option>
                    <option value="financial">Financial</option>
                    <option value="farming">Farming</option>
                </select>
            </span>
            <span class="relative inline-flex items-center bg-gray-100 inline-block rounded-xl px-3 py-2 text-sm">Search
                <form method="GET" action="#">
                    <input type="text" name="search">
                </form>
            </span>
        </div>
    </div>
</header>
@include('partials.foot')
