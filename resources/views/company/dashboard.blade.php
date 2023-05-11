<x-company-layout>
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

                <table
                    class="table-auto w-full text-sm text-left text-gray-500 border-collapse border border-slate-400 dark:text-gray-400">
                    <thead class="text-sm text-gray-900 bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 border border-slate-300">
                                Trainee
                            </th>
                            <th scope="col" class="px-6 py-3 border border-slate-300">
                                Summary Report
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td class="px-6 py-4 border border-slate-300 font-semibold">
                                    <p class="text-sm font-semibold leading-6 text-gray-700">{{ $student->name }}
                                    </p>
                                    <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                                        {{ $student->email }}</p>
                                </td>
                                <td class="px-6 py-4 border border-slate-300 font-semibold">
                                    <p class="text-sm font-semibold leading-6 text-gray-700">Shared Links
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-company-layout>
