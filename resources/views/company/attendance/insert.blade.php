<x-company-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ $user->name }}

<form method="POST" action="{{ route('company.attendance.store',$user->ID) }}">
                        @csrf
                        @method('patch')
                        <div class="grid gap-6 mt-6">
                            <!-- date -->
                            <div class="space-y-2">
                                <x-form.label for="date" :value="__('Date')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-calendar aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.input withicon id="date" class="block w-full" type="date"
                                        name="date" :value="old('date')" required autofocus
                                        placeholder="{{ __('Date') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>

                            <!-- Time In -->
                            <div class="space-y-2">
                                <x-form.label for="timein" :value="__('Time In')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-clock aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.input withicon id="timein" class="block w-full" type="time"
                                        name="timein" :value="old('timein')" required placeholder="{{ __('Time In') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>

                            <!-- Time Out -->
                            <div class="space-y-2">
                                <x-form.label for="timeout" :value="__('Time Out')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-clock aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.input withicon id="timeout" class="block w-full" type="time"
                                        name="timeout" :value="old('timeout')" required placeholder="{{ __('Time Out') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>

                             <!-- Notes -->
                            <div class="space-y-2">
                                <x-form.label for="notes" :value="__('Notes')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-pencil-alt aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.input withicon id="notes" class="block w-full" type="text"
                                        name="notes" :value="old('notes')"  placeholder="{{ __('Notes') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>


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
</x-company-layout>
