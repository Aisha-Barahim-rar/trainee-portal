<x-hr-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trainees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Trainee Information') }}

                    @foreach ($students as $student)
                        <div class="grid grid-cols-1 md:grid-cols-2 mt-6">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900 font-medium">
                                    {{ __('Name:') }}
                                </h3>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $student->name }}
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
                                    {{ $student->mobile?$student->mobile:"-" }}
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
                                    {{ $student->email?$student->email:"-" }}
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 mt-6">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900 font-medium">
                                    {{ __('Academic ID:') }}
                                </h3>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $student->academic_id?$student->academic_id:"-" }}
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
                                    {{ $student->university?$student->university:"-" }}
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 mt-6">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900 font-medium">
                                    {{ __('Major:') }}
                                </h3>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $student->major?$student->major:"-" }}
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 mt-6">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900 font-medium">
                                    {{ __('Training Days:') }}
                                </h3>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $student->hours?$student->hours:"-" }}
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 mt-6">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900 font-medium">
                                    {{ __('Financial Reward:') }}
                                </h3>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $student->reward?$student->reward:"-" }}
                                </p>
                            </div>
                        </div>                        
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-hr-layout>
