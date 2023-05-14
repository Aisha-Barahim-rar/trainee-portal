<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('University Supervisors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('University Supervisor Information') }}

                    @foreach ($university_mentors as $university_mentor)
                        <div class="grid grid-cols-1 md:grid-cols-2 mt-6">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900 font-medium">
                                    {{ __('Name:') }}
                                </h3>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $university_mentor->name }}
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
                                    {{ $university_mentor->mobile?$university_mentor->mobile:"-" }}
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
                                    {{ $university_mentor->email?$university_mentor->email:"-" }}
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 mt-6">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900 font-medium">
                                    {{ __('University:') }}
                                </h3>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $university_mentor->university?$university_mentor->university:"-" }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
