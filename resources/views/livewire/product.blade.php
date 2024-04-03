@include('partials.head')
@include('partials.nav')

<main>
	<div class="mx-auto bg-gray-100 max-w-7xl py-6 sm:px-6 lg:px-8">
		<div class="grid grid-cols-2 gap-10 py-12">
			<div class="space-y-4" x-data="{ image: '{{$this->product->image->path}}' }">
				<div class="bg-white p-5 rounded-lg shadow">
					<img x-bind:src="image" alt="">
				</div>
				<div class="grid grid-cols-4 gap-4 mt-12">
					@foreach ($this->product->images as $image)
					<div class="bg-white rounded-lg shadow p-4">
						<img src="{{ $image->path }}" @click="image = '{{ $image->path }}'" alt ="" >
					</div>
					@endforeach
				</div>
			</div>
			<div class="block text-gray-700">
				<p class="text-3xl">{{ $this->product->name }}</p>
				<p class="text-xl">{{ $this->product->description }}</p>
				<p class="text-xl">{{ $this->product->price }}</p>
				<div class="mt-4">
					<select name="" class="block bg-white w-full rounded-md border-0 py-1.15 pl-3 pr-10 text-gray-800">
					@foreach($this->product->productVariants as $variant)
						<option value={{ $variant->id }}>{{ $variant->attribute }}</option>
						@endforeach
					</select>
				</div>
				<div class="px-4 py-3 mt-6 text-right sm:px-6">
					<a href="/store"
						class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
						>
						Cancel
					</a>

					<button
						type="submit"
						class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
						>
						Add to Cart
					</button>
				</div>
			</div>
		</div>
</main>

@include('partials.foot')
