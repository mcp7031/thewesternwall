<x-guest-layout>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <x-validation-errors class="mb-4" />
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                        <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ $heading }}</h2>
                    </div>

                    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-sm">
                        <form class="space-y-6" action="/register" method="POST">
                            <div>
                                <input type="hidden" name="subreg" value="{{ $subreg }}">
                                <label for="first_name" value="{{ __('First Name') }} class="block text-sm font-medium leading-6 text-gray-900">First Name</label>
                                <input id="first_name" name="first_name" type="first_name" autocomplete="first_name"
                                    required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset
                                    ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600
                                    sm:text-sm sm:leading-6">
                                    @if (isset($errors['first_name']))
                                <p class="text-red-500 text-xs mt-2">{{ $errors['first_name'] }}</p>
                                @endif
                                <label for="last_name" value="{{ __('Last Name') }} class="block text-sm font-medium leading-6 text-gray-900">Last Name</label>
                                <input id="last_name" name="last_name" type="last_name" autocomplete="last_name"
                                    required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset
                                    ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600
                                    sm:text-sm sm:leading-6">
                                    @if (isset($errors['last_name']))
                                <p class="text-red-500 text-xs mt-2">{{ $errors['last_name'] }}</p>
                                @endif
                                <div>
                                    <div>
                                        <label for="username" value="{{ __('User Name') }} class="block text-sm font-medium leading-6 text-gray-900">User Name</label>
                                        <input id="username" name="username" type="username" autocomplete="username" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            @if (isset($errors['username'])) }}
                                        <p class="text-red-500 text-xs mt-2">{{ $errors['username'] }}></p>
                                        @endif
                                        <div>
                                            <label for="email" value="{{ __('Email address') }} class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
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
                                        <div class="mt-4">
                                            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

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
            </form>
        </div>
    </div>
</x-guest-layout>
