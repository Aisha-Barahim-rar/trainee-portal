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

    <form method="post" action="{{ route('student.profile.update') }}" class="mt-6 space-y-6">
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
            <x-form.label for="academic_id" :value="__('Academic ID')" />

            <x-form.input id="academic_id" name="academic_id" type="text" class="block w-full" :value="old('academic_id', $user->academic_id)"
                 autofocus autocomplete="academic_id" />

            <x-form.error :messages="$errors->get('academic_id')" />
        </div>

        <div class="space-y-2">
            <x-form.label for="university" :value="__('University')" />

            <x-form.input id="university" name="university" type="text" class="block w-full" :value="old('university', $user->university)"
                 autofocus autocomplete="university" />

            <x-form.error :messages="$errors->get('university')" />
        </div>

        <div class="space-y-2">
            <x-form.label for="major" :value="__('Major')" />

            <x-form.input id="major" name="major" type="text" class="block w-full" :value="old('major', $user->major)"
                 autofocus autocomplete="major" />

            <x-form.error :messages="$errors->get('major')" />
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
