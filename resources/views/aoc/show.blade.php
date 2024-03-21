@include('partials.head')
@include('partials.nav')

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p>Category: {{ $category }}</p>
        <p>Description: {{ $description }}</p>
        <div class="px-4 py-8 flex space-x-4">
            <a href="/aoc">
                <button
                    type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Cancel
                    </button>
            </a>
            <a href="/edit?id={{ $id }}">
                @csrf
                <button
                    type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                Update
                </button>
                </a>
            <form class method="POST">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" value="{{ $id }}">
                <button
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                Delete
               </button>
            </form>
        </div>
    </div>
</main>

@include('partials.foot')
