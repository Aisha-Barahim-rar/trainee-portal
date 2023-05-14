<x-university-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-4 px-4">
                <div class="p-6 text-gray-900">
                    {{ __('Hi, ') }} {{ Auth::user()->name }}
                </div>


                @foreach ($students as $student)
                    <div class="py-6 px-6 border rounded-md mb-4 bg-gray-50 border-gray-50 grid grid-cols-1 md:grid-cols-2 md:items-center gap-4">
                        <div class="space-y-2">
                            <p class="text-sm font-semibold leading-6 text-gray-700">{{ $student->name }}
                            </p>

                            <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                                {{ $student->university }} - {{ $student->major }}</p>
                        </div>
                        <div class="space-y-2">
                        <p class="text-sm font-semibold leading-6 text-gray-700">Summary Report
                            </p>
                            <p>
                                <span
                                    class="text-md text-alrashed-600 font-semibold leading-6">{{ $student->attendance }}</span>
                                <span class="text-sm leading-5 text-gray-500 text-left ml-4">
                                    Attendance
                                </span>
                            </p>
                            <p>
                                <span
                                    class="text-md font-semibold leading-6 text-alrashed-600">
                                    @foreach($reports as $report)
                                @if($report->ID===$student->ID)
                                {{ $report->report }}
                                @endif
                                @endforeach
                                </span>
                                <span class="text-sm leading-5 text-gray-500 text-left ml-4">
                                    Reports
                                </span>
                            </p>
                            <p>
                                <span class="text-md font-semibold leading-6 text-alrashed-600">
                                @foreach($links as $link)
                                @if($link->ID===$student->ID)
                                {{ $link->link }}
                                @endif
                                @endforeach    
                                </span>
                                <span class="text-sm leading-5 text-gray-500 text-left ml-4">
                                    Important Links
                                </span>
                            </p>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-university-layout>
