@include('partials.head')
@include('partials.nav')

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ $heading }}</h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="/register" method="POST">
            <div>
                <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">First Name</label>
                <input id="first_name" name="first_name" type="first_name" autocomplete="first_name"
                    required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset
                    ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600
                    sm:text-sm sm:leading-6">
                    @if (isset($errors['first_name']))
                <p class="text-red-500 text-xs mt-2">{{ $errors['first_name'] }}</p>
                @endif
                <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">Last Name</label>
                <input id="last_name" name="last_name" type="last_name" autocomplete="last_name"
                    required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset
                    ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600
                    sm:text-sm sm:leading-6">
                    @if (isset($errors['last_name']))
                <p class="text-red-500 text-xs mt-2">{{ $errors['last_name'] }}</p>
                @endif
                <div>
                    <div>
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">User Name</label>
                        <input id="username" name="username" type="username" autocomplete="username" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @if (isset($errors['username'])) }}
                        <p class="text-red-500 text-xs mt-2">{{ $errors['username'] }}></p>
                        @endif
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                            <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                @if(isset($errors['email']))
                            <p class="text-red-500 text-xs mt-2">{{ $errors['email'] }}</p>
                            @endif
                        </div>
                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @if (isset($errors['password']))
                            <p class="text-red-500 text-xs mt-2">{{ $errors['password'] }}</p>
                            @endif
                        </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <a href="/"
                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Register
                        </button>
                    </div>

                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

@include('partials.foot')
