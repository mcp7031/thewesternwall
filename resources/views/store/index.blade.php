@include('partials.head')
@include('partials.nav')
<main>
    <div class="mx-auto max-w-7xl mt-6 py-6 sm:px-6 lg:px-8">
        <div class="mt-5 md:col-span-2 md:mt-0">
            <div class="container flex flex-wrap justify-center shadow sm:overflow-hidden sm:rounded-md">
                <h1 class="text-lg font-semibold"> {{ $heading }} </h1>
                @foreach($images as $image_id => $image)
            <div class="w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/5 p-4">
                <?php $variant = $variants[$image->product_variants_id]; ?>
                <?php $product = $products[$variant->product_id]; ?>
                    <div class="bg-white rounded-lg shadow p-4">
                        <img src="{{ asset($image->path) }}" alt="">
                        <h2 class="font-medium text-lg">{{ $product->name }}</h2>
                        <span class="text-gray-700 text-sm">{{ $product->price }}</span>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="px-4 py-6 sm:px-6 flex gap-x-4 text-right">
                <a href="/"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Cancel
                </a>
                <a href="/store/cart">
                    <button
                        type="submit"
                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Add to Cart
                    </button>
                </a>
            </div>
        </div>
    </div>
    </div>
</main>

@include('partials.foot')
