<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <header>
                        <div class="grid grid-cols-2">
                            <div>
                                <h2 class="text-lg font-medium">
                                    {{ $user->name }}
                                </h2>
                            </div>
                            <div class="place-self-end">
                                <a class="text-gray-600" href="{{ route('student.attendance.export', $user->ID) }}"
                                    target=_blank>
                                    <x-heroicon-o-save class="flex-shrink-0 w-8 h-8" aria-hidden="true" />
                                </a>
                            </div>
                        </div>
                    </header>

                    <div class="relative overflow-x-auto mt-4">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Time In
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Time Out
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Notes
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendance as $record)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $record->date }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $record->attendance }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $record->departure }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $record->notes }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end sm:flex-col sm:items-end mt-6">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
