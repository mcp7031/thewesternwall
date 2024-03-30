@include('partials.head')
@include('partials.nav')

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <h1 class="text-lg font-semibold"> {{ $heading }} </h1>
        <p>Product: {{ $name }}</p>
        <p>Description: {{ $prod_desc }}</p>
        <p>Attribute: {{ $attribute }}</p>
        <p>Price: {{ $price }}</p>
        <div class="grid grid-cols-4 gap-4 mt-12">
            @foreach ($images as $image)
            <div class="bg-white rounded-lg shadow p-4">
                <img src="{{ asset($image->path) }}" alt="{{$image->path}}">
            </div>
            @endforeach
        </div>
        <div class="px-4 py-8 flex space-x-4">
            <a href="/inventory">
                <button
                    type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Cancel
                </button>
            </a>
            <a href="/invedit?id={{ $id }}">
                @csrf
                <button
                    type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Update
                </button>
            </a>
            <a href="/invariant?id={{ $product_id }}">
                <button
                    type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Create
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
