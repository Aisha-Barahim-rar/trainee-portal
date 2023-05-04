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
                    {{ __('Company Mentor Information') }}

                    @foreach ($company_mentors as $company_mentor)
                        <div class="grid grid-cols-1 md:grid-cols-2 mt-6">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900 font-medium">
                                    {{ __('Name:') }}
                                </h3>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $company_mentor->name }}
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
                                    {{ $company_mentor->mobile?$company_mentor->mobile:"-" }}
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
                                    {{ $company_mentor->email?$company_mentor->email:"-" }}
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 mt-6">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900 font-medium">
                                    {{ __('Department:') }}
                                </h3>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $company_mentor->department?$company_mentor->department:"-" }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
