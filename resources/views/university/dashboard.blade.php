<x-university-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="py-2 grid grid-cols-3 md:items-center gap-4">

                <div class="h-full bg-[#f8f5ef] overflow-hidden shadow-sm sm:rounded-lg py-4 px-4 mb-6 text-center">

                    <p class="text-md font-semibold leading-6 text-[#5f4d2e]">
                        {{ $students->count() }}</p>
                    <p class="text-md font-medium leading-6 text-[#5f4d2e]">
                        @if ($students->count() > 1)
                            Trainees
                        @else
                            Trainee
                        @endif
                    </p>
                </div>

                <div class="h-full bg-[#f2ebde] overflow-hidden shadow-sm sm:rounded-lg py-4 px-4 mb-6 text-center">

                    <p class="text-md font-semibold leading-6 text-[#5f4d2e]">
                        {{ $reports->report }}</p>
                    <p class="text-md font-medium leading-6 text-[#5f4d2e]">
                        @if ($reports->report > 1)
                            Reports
                        @else
                            Report
                        @endif
                    </p>
                </div>

                <div class="h-full bg-[#ebe1ce] overflow-hidden shadow-sm sm:rounded-lg py-4 px-4 mb-6 text-center">

                    <p class="text-md font-semibold leading-6 text-[#5f4d2e]">
                        {{ $links->link }}</p>
                    <p class="text-md font-medium leading-6 text-[#5f4d2e]">
                        @if ($links->link > 1)
                            Shared Links
                        @else
                            Learning Materials
                        @endif
                    </p>
                </div>

            </div>

            <div class="h-full bg-white overflow-hidden shadow-sm sm:rounded-lg py-4 px-4 mb-6 col-span-2 ">
                <div class="py-2 px-6 grid grid-cols-3 md:items-center gap-4">
                    <div class="space-y-2">
                        <p class="text-md font-semibold leading-6 text-gray-700">Trainee
                        </p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-md font-semibold leading-6 text-gray-700">
                            Supervisor</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-md font-semibold leading-6 text-gray-700">
                            Attendance</p>
                    </div>
                </div>
                @foreach ($students as $student)
                    <div
                        class="py-6 px-6 border rounded-md mb-4 bg-gray-50 border-gray-50 grid grid-cols-3 md:items-center gap-4">
                        <div class="space-y-2">
                            <p class="text-sm font-semibold leading-6 text-gray-700">
                                <a href="{{ route('university.trainees.view', $student->ID) }}">
                                    {{ $student->name }}
                                </a>
                            </p>
                            <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                                {{ $student->major }}</p>
                        </div>
                        <div class="space-y-2">
                            <p class="text-sm font-semibold leading-6 text-gray-700">
                                @foreach ($mentors as $mentor)
                                    @if ($mentor->student_id === $student->ID)
                                        {{ $mentor->name }}
                                    @endif
                                @endforeach
                            </p>

                            <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                                @foreach ($mentors as $mentor)
                                    @if ($mentor->student_id === $student->ID)
                                        {{ $mentor->department }}
                                    @endif
                                @endforeach
                            </p>
                        </div>
                        <div class="space-y-2">
                            <p class="text-sm font-medium leading-6 text-gray-600">
                                @foreach ($times as $i => $time)
                                    @if ($i === $student->ID)
                                        {{ round(($time / $student->hours) * 100) }}
                                    @endif
                                @endforeach %
                            </p>
                            <div class=" bg-gray-200 h-1 w-full rounded-full" x-data="{
                                val: @foreach ($times as $i => $time)
                                    @if ($i === $student->ID)
                                        {{ round(($time / $student->hours) * 100) }}
                                    @endif @endforeach,
                                start: 0
                            }"
                                x-init="setTimeout(() => start = val, 100)">
                                <div class="  bg-gradient-to-br from-green-500 to-green-800 h-1 w-1 rounded-full animate-pulse transition-all "
                                    :style="`width: ${start}%; transition: 3s;`" alt="attendance">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
    

</x-university-layout>
