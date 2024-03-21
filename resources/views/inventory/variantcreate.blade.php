@include('partials.head')
@include('partials.nav')
<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-5 md:col-span-2 md:mt-0">
        <p>Product Name: {{ $name }}</p>
        <p>Description: {{ $description }}</p>
        <p>Price: {{ $price }}</p>
                <form method="POST" action="/invariant">
                    @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="name" value="{{ $name }}">
                <input type="hidden" name="description" value="{{ $description }}">
                <input type="hidden" name="price" value="{{ $price }}">
                    <div class="shadow sm:overflow-hidden sm:rounded-md">

                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                            <h1 class="text-lg font-semibold"> {{ $heading }} </h1>
                            <label
                                for="attribute"
                                class="block text-sm font-medium text-gray-700"
                            >Attributes (key:value pairs delimited by comma)</label>
                            <div class="mt-1">
                                <textarea
                                    id="attribute"
                                    name="attribute"
                                    rows="1"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                >{{ $_POST['attribute'] ?? '' }}</textarea>

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
                                >{{ $_POST['quantity'] ?? '' }}</textarea>

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
