<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('company.profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="space-y-2">
            <x-form.label for="name" :value="__('Name')" />

            <x-form.input id="name" name="name" type="text" class="block w-full" :value="old('name', $user->name)" required
                autofocus autocomplete="name" />

            <x-form.error :messages="$errors->get('name')" />
        </div>

        <input id="user_id" name="user_id" type="hidden" value={{ $user->id }} />
        <div class="space-y-2">
            <x-form.label for="mobile" :value="__('Mobile')" />

            <x-form.input id="mobile" name="mobile" type="text" class="block w-full" :value="old('mobile', $user->mobile)"
                autofocus autocomplete="mobile" />

            <x-form.error :messages="$errors->get('mobile')" />
        </div>

        <div class="space-y-2">
            <x-form.label for="email" :value="__('Email')" />

            <x-form.input id="email" name="email" type="email" class="block w-full" :value="old('email', $user->email)" required
                autocomplete="email" />

            <x-form.error :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-300">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500  dark:text-gray-400 dark:hover:text-gray-200 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

       

        <div class="space-y-2">
            <x-form.label for="department" :value="__('Department')" />

                                    <x-form.select  id="select" class="block w-full" name="department">
                                        <option disabled selected value> -- select an option -- </option>
                                        <option value="Human Resources" @if($user->department==="Human Resources") selected @endif>Human Resources</option>
                                        <option value="Information Technology" @if($user->department==="Information Technology") selected @endif>Information Technology</option>
                                        <option value="Accounts - Real Estate" @if($user->department==="Accounts - Real Estate") selected @endif>Accounts - Real Estate</option>
                                        <option value="Accounts - BTH" @if($user->department==="Accounts - BTH") selected @endif>Accounts - BTH</option>
                                        <option value="Investment" @if($user->department==="Investment") selected @endif>Investment</option>
                                    </x-form.select>

            <x-form.error :messages="$errors->get('department')" />
        </div>

        <div class="flex items-center gap-4">
            <x-button>
                {{ __('Save') }}
            </x-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
