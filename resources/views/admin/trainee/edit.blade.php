<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trainees') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Update Trainee\'s Information') }}
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('admin.trainees.update', $student->user_id) }}">
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
                                        name="name" :value="old('name', $student->name)" required autofocus
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
                                        name="mobile" :value="old('mobile', $student->mobile)" placeholder="{{ __('Mobile') }}" />
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
                                        name="email" :value="old('email', $student->email)" required placeholder="{{ __('Email') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>

                            <!-- Academic ID -->
                            <div class="space-y-2">
                                <x-form.label for="academic" :value="__('Academic ID')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-identification aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.input withicon id="academic" class="block w-full" type="text"
                                        name="academic" :value="old('academic', $student->academic_id)" placeholder="{{ __('Academic ID') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>

                            <!-- University -->
                            <div class="space-y-2">
                                <x-form.label for="university" :value="__('University')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-academic-cap aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.input withicon id="university" class="block w-full" type="text"
                                        name="university" :value="old('university', $student->university)" placeholder="{{ __('University') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>

                            <!-- Major -->
                            <div class="space-y-2">
                                <x-form.label for="major" :value="__('Major')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-book-open aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.input withicon id="major" class="block w-full" type="text"
                                        name="major" :value="old('major', $student->major)" placeholder="{{ __('Major') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>
                            <input id="user_id" name="user_id" type="hidden" value={{ $student->user_id }} />

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
