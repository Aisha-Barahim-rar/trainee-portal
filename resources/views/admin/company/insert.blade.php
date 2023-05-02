<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company Mentors') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Add New Company Mentor') }}
                    <form method="POST" action="{{ route('admin.company.create') }}">
                        @csrf

                        <div class="grid gap-6 mt-6">
                            <!-- Name -->
                            <div class="space-y-2">
                                <x-form.label for="name" :value="__('Name')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.input withicon id="name" class="block w-full" type="text"
                                        name="name" :value="old('name')" required autofocus
                                        placeholder="{{ __('Name') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>

                            <!-- Email Address -->
                            <div class="space-y-2">
                                <x-form.label for="email" :value="__('Email')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.input withicon id="email" class="block w-full" type="email"
                                        name="email" :value="old('email')" required placeholder="{{ __('Email') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>

                            <!-- Role Address -->
                            <div class="space-y-2">
                                <x-form.label for="role" :value="__('Role')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.select withicon id="select" class="block w-full" name="role">
                                        <option value="admin">Super Admin</option>
                                        <option value="hr">HR Admin</option>
                                        <option value="company" selected>Company Mentor</option>
                                        <option value="university">University Mentor</option>
                                        <option value="student">Student</option>
                                    </x-form.select>
                                </x-form.input-with-icon-wrapper>
                            </div>

                            <!-- Password -->
                            <div class="space-y-2">
                                <x-form.label for="password" :value="__('Password')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.input withicon id="password" class="block w-full" type="password"
                                        name="password" required autocomplete="new-password"
                                        placeholder="{{ __('Password') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>

                            <!-- Confirm Password -->
                            <div class="space-y-2">
                                <x-form.label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.input withicon id="password_confirmation" class="block w-full"
                                        type="password" name="password_confirmation" required
                                        placeholder="{{ __('Confirm Password') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>

                            <div class="flex justify-end sm:flex-col sm:items-end mt-6">
                                <div>
                                    <x-button :variant="'primary'" items-end size="base"
                                        >
                                        <span>{{ __('Save') }}</span>
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>





            </div>
        </div>
    </div>

</x-admin-layout>
