@include('partials.head')
@include('partials.nav')
<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form method="POST" action="/invedit">
                    @csrf
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="{{ $product_id }}">
                <input type="hidden" name="product_variant_id" value="{{ $id }}">
                    <div class="shadow sm:overflow-hidden sm:rounded-md">
                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                            <h1> {{ $heading }} </h1>
                            <label
                                for="name"
                                class="block text-sm font-medium text-gray-700"
                            >Product Name</label>
                            <div class="mt-1">
                                <textarea
                                    id="name"
                                    name="name"
                                    rows="1"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                >{{ $name }}</textarea>

                                @if(isset($errors['name']))
                                <p class="text-red-500 text-xs mt-2">{{ $errors['name'] }}</p>
                                @endif
                            </div>
                            <label
                                for="description"
                                class="block text-sm font-medium text-gray-700"
                            >Description</label>
                            <div class="mt-1">
                                <textarea
                                    id="description"
                                    name="description"
                                    rows="2"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                >{{ $description }}</textarea>

                                @if(isset($errors['description']))
                                <p class="text-red-500 text-xs mt-2">{{ $errors['description'] }}</p>
                                @endif
                            </div>
                            <label
                                for="price"
                                class="block text-sm font-medium text-gray-700"
                            >Price</label>
                            <div class="mt-1">
                                <textarea
                                    id="price"
                                    name="price"
                                    rows="1"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                >{{ $price }}</textarea>

                                @if(isset($errors['price']))
                                <p class="text-red-500 text-xs mt-2">{{ $errors['price'] }}</p>
                                @endif
                            </div>
                            <label
                                for="attribute"
                                class="block text-sm font-medium text-gray-700"
                            >Attributes</label>
                            <div class="mt-1">
                                <textarea
                                    id="attribute"
                                    name="attribute"
                                    rows="1"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                >{{ $attribute }}</textarea>

                                @if(isset($errors['attribute']))
                                <p class="text-red-500 text-xs mt-2">{{ $errors['attribute'] }}</p>
                                @endif
                            </div>
                            <label
                                for="quantity"
                                class="block text-sm font-medium text-gray-700"
                            >Quantity</label>
                            <div class="mt-1">
                                <textarea
                                    id="quantity"
                                    name="quantity"
                                    rows="1"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                >{{ $quantity }}</textarea>

                                @if(isset($errors['quantity']))
                                <p class="text-red-500 text-xs mt-2">{{ $errors['quantity'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <a href="/inventory"
                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Save
                        </button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
</main>

@include('partials.foot')
