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
                    {{ __('Update Company Mentor\'s Information') }}
                    <form method="POST" action="{{ route('admin.company.update', $company_mentor->user_id) }}">
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
                                        name="name" :value="old('name', $company_mentor->name)" required autofocus
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
                                        name="mobile" :value="old('mobile', $company_mentor->mobile)" placeholder="{{ __('Mobile') }}" />
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
                                        name="email" :value="old('email', $company_mentor->email)" required placeholder="{{ __('Email') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>

                            <!-- Department -->
                            <div class="space-y-2">
                                <x-form.label for="department" :value="__('Department')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-user-group aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.input withicon id="department" class="block w-full" type="text"
                                        name="department" :value="old('department', $company_mentor->department)" placeholder="{{ __('Department') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>


                            <input id="user_id" name="user_id" type="hidden" value={{ $company_mentor->user_id }} />

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
