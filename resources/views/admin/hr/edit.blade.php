<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('HR Admins') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Update HR Admin\'s Information') }}
                    <form method="POST" action="{{ route('admin.hr.update', $hr_admin->user_id) }}">
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
                                        name="name" :value="old('name', $hr_admin->name)" required autofocus
                                        placeholder="{{ __('Name') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>

                            <!-- Mobile Address -->
                            <div class="space-y-2">
                                <x-form.label for="mobile" :value="__('Mobile')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-phone aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.input withicon id="mobile" class="block w-full" type="text"
                                        name="mobile" :value="old('mobile', $hr_admin->mobile)" placeholder="{{ __('Mobile') }}" />
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
                                        name="email" :value="old('email', $hr_admin->email)" required placeholder="{{ __('Email') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>



                            <input id="user_id" name="user_id" type="hidden" value={{ $hr_admin->user_id }} />

                            <div class="flex justify-end sm:flex-col sm:items-end mt-6">
                                <div>
                                    <x-button :variant="'primary'" items-end size="base">
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
