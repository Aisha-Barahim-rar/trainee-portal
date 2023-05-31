<x-company-layout>
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
                        {{ $reports->count() }}</p>
                    <p class="text-md font-medium leading-6 text-[#5f4d2e]">
                        @if ($reports->count() > 1)
                            Reports
                        @else
                            Report
                        @endif
                    </p>
                </div>

                <div class="h-full bg-[#ebe1ce] overflow-hidden shadow-sm sm:rounded-lg py-4 px-4 mb-6 text-center">

                    <p class="text-md font-semibold leading-6 text-[#5f4d2e]">
                        {{ $links->count() }}</p>
                    <p class="text-md font-medium leading-6 text-[#5f4d2e]">
                        @if ($links->count() > 1)
                            Shared Links
                        @else
                            Learning Materials
                        @endif
                    </p>
                </div>

            </div>


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-4 px-4 mb-6">
                <div class="w-full max-w-full px-3 mt-0 lg:flex-none">
                    <div
                        class="border-black/12.5 shadow-soft-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                        <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                            <h6>Trainees Distribution over Departments</h6>
                            <p class="leading-normal text-sm">
                                <span class="text-sm font-semibold leading-6 text-gray-700">2023 - 2030</span>
                            </p>
                        </div>
                        <div class="flex-auto p-4">
                            <div>
                                <canvas id="chart-line" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div name="data" data-id="{{ json_encode($data) }}" hidden>{{ json_encode($data) }}</div>

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
                                <a href="{{ route('company.trainees.view', $student->ID) }}">
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

                @foreach ($data as $record)
                    <div name="data" data-id="{{ json_encode($record) }}" hidden>{{ json_encode($record) }}</div>
                @endforeach

            </div>

        </div>
    </div>
    @push('scripts')
        <script>
            window.onload = function() {
                var ctx2 = document.getElementById("chart-line").getContext("2d");

                var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
                var data = document.getElementsByName("data");
                var temp = []
                data.forEach(function(a, i) {
                    temp.push(a.innerHTML.substring(1, a.innerHTML.length - 1).split(",").map(Number));
                })
                console.log(temp)
                gradientStroke1.addColorStop(1, "rgba(203,12,159,0.2)");
                gradientStroke1.addColorStop(0.2, "rgba(72,72,176,0.0)");
                gradientStroke1.addColorStop(0, "rgba(203,12,159,0)"); //purple colors

                var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

                gradientStroke2.addColorStop(1, "rgba(20,23,39,0)");
                gradientStroke2.addColorStop(0.2, "rgba(72,72,176,0)");
                gradientStroke2.addColorStop(0, "rgba(20,23,39,0)"); //purple colors
                departments = ["Number of Trainees"
                ]
                colors = ["#F5B041", "#82E0AA", "#3498DB", "#BB8FCE", "#EC7063"]
                datasets = []

                departments.forEach(function(a, i) {
                    datasets.push({
                        label: a,
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: colors[i],
                        borderWidth: 2,
                        backgroundColor: gradientStroke2,
                        fill: true,
                        data: temp[i],
                        maxBarThickness: 6,
                    });

                });
                new Chart(ctx2, {
                    type: "line",
                    data: {
                        labels: ["2023", "2024", "2025", "2026", "2027", "2028", "2029", "2030"],

                        datasets: datasets

                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            },
                        },
                        interaction: {
                            intersect: false,
                            mode: "index",
                        },
                        scales: {
                            y: {
                                grid: {
                                    drawBorder: false,
                                    display: true,
                                    drawOnChartArea: true,
                                    drawTicks: false,
                                    borderDash: [5, 5],
                                },
                                ticks: {
                                    display: true,
                                    padding: 10,
                                    color: "#b2b9bf",
                                    font: {
                                        size: 11,
                                        family: "Open Sans",
                                        style: "normal",
                                        lineHeight: 2,
                                    },
                                },
                            },
                            x: {
                                grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false,
                                    borderDash: [5, 5],
                                },
                                ticks: {
                                    display: true,
                                    color: "#b2b9bf",
                                    padding: 20,
                                    font: {
                                        size: 11,
                                        family: "Open Sans",
                                        style: "normal",
                                        lineHeight: 2,
                                    },
                                },
                            },
                        },
                    },
                });
            }
        </script>
    @endpush

</x-company-layout>
