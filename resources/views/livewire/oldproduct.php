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
                    {{ $image->featured ? "featured image" : "" }}
            </div>
            @endforeach
        </div>
        <div class="px-4 py-8 flex space-x-4">
            <a href="/store">
                <button
                    type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Cancel
                </button>
            </a>
            <a href="#">
                <button
                    type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Add to Cart
                </button>
            </a>
        </div>
    </div>
</main>

@include('partials.foot')
