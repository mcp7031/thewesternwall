@include('partials.head')
@include('partials.nav')
<main>
    <div class="mx-auto max-w-7xl mt-6 py-6 sm:px-6 lg:px-8">
        <div class="mt-5 md:col-span-2 md:mt-0">
            <div class="container shadow sm:overflow-hidden sm:rounded-md">
            <h1 class="text-lg font-semibold"> {{ $heading }} </h1>
                @foreach ($aocs as $aoc)
                <li>
                    <a href="/aoc/edit?id={{ $aoc->id }}" class="text-blue-500 hover:underline">
                        {{ $aoc->category }}
                    </a>
                    {{ $aoc->description }}
                </li>
                @endforeach
                {{ $aocs->links() }}

                <div class="px-4 py-6 sm:px-6 flex gap-x-4 text-right">
                    <a href="/"
                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Cancel
                    </a>
                    <a href="/aoc/create">
                        <button
                            type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Create
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

@include('partials.foot')
