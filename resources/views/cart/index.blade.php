@include('partials.head')
@include('partials.nav')
<main>
    <div class="mx-auto max-w-7xl mt-6 py-6 sm:px-6 lg:px-8">
        <div class="mt-5 md:col-span-2 md:mt-0">
            <div class="container flex flex-wrap justify-center shadow sm:overflow-hidden sm:rounded-md">
                <h1 class="text-lg font-semibold"> {{ $heading }} </h1>
                @foreach($variants as $ndx => $variant)
                <?php
                $product = $variant->product;
                $item = $items[$ndx];
                //   dd([$items, $variant, $product]);
                ?>
                <div class="w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/5 p-4">
                    <div class="text-balance bg-white rounded-lg shadow p-4 relative">
                        <a href="{{ route('product', $product->id) }}" class="absolute inset-0 w-full h-full"></a>
                        <img src="{{ asset($product->image->path) }}" alt="">
                        <h2 class="font-medium text-lg">{{ $product->name }}</h2>
                        <h3 class="text-gray-700 text-sm">{{ $product->price }}</h3>
                        <h3 class="text-gray-700 text-sm">Quantity: {{ $item->quantity }}</h3>
                        <h3 class="text-gray-700 text-sm">{{ $variant->attribute }}</h3>
                    </div>
                </div>
                @endforeach
                <h3 class="text-gray-700 text-sm">Total: {{ $totalp }}</h3>
            </div>
            {{ $items->links() }}

            <div class="px-4 py-6 md:px-6 flex gap-x-4 text-right">
                <a href="/store"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Cancel
                </a>
            </div>
        </div>
    </div>
</main>




@include('partials.foot')
