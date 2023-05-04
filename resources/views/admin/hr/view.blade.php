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
                    {{ __('HR Admin Information') }}

                    @foreach ($hr_admins as $hr_admin)
                        <div class="grid grid-cols-1 md:grid-cols-2 mt-6">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900 font-medium">
                                    {{ __('Name:') }}
                                </h3>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $hr_admin->name }}
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 mt-6">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900 font-medium">
                                    {{ __('Mobile:') }}
                                </h3>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $hr_admin->mobile?$hr_admin->mobile:"-" }}
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 mt-6">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900 font-medium">
                                    {{ __('Email Address:') }}
                                </h3>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $hr_admin->email?$hr_admin->email:"-" }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
