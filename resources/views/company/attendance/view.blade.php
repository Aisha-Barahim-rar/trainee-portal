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
                    @if (session('status') === 'attendance-created')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-green-600">
                            {{ __('A new trainee\'s attendance has been created successfully.') }}
                        </p>
                    @endif
                    @if (session('status') === 'attendance-deleted')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-red-600">
                            {{ __('Trainee\'s attendance has been deleted successfully.') }}
                        </p>
                    @endif
                    @if (session('status') === 'attendance-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-green-600">
                            {{ __('Trainee\'s attendance has been updated successfully.') }}
                        </p>
                    @endif
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
                                    <th scope="col" class="px-6 py-3">

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
                                        <td class="px-6 py-4">
                                            <div class="flex justify-end sm:flex-col sm:items-end">
                                                <div class="inline-flex rounded-md shadow-sm" role="group">
                                                    <x-button variant="secondary"
                                                        href="{{ route('company.attendance.edit', $record->ID) }}"
                                                        :squared=true class="rounded-l-md border-t border-b border-r">
                                                        <x-heroicon-o-pencil-alt class="flex-shrink-0 w-6 h-6"
                                                            aria-hidden="true" />
                                                    </x-button>
                                                    <x-button variant="danger" x-data=""
                                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-attendance-deletion-{{ $record->ID }}')"
                                                        :squared=true class="rounded-r-md">
                                                        <x-heroicon-o-trash class="flex-shrink-0 w-6 h-6"
                                                            aria-hidden="true" />
                                                    </x-button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end sm:flex-col sm:items-end mt-6">
                        <div>
                            <x-button :variant="'primary'" items-end size="sm"
                                href="{{ route('company.attendance.insert', $user->ID) }}">
                                Add New Attendance
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($attendance as $record)
    <x-modal name="confirm-attendance-deletion-{{ $record->ID }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('company.attendance.destroy', $record->ID) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium">
                {{ __('Are you sure you want to delete this attendance record?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('This record will be permanently deleted.') }}
            </p>


            <div class="mt-6 flex justify-end">
                <x-button type="button" variant="secondary" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-button>

                <x-button variant="danger" class="ml-3">
                    {{ __('Delete') }}
                </x-button>
            </div>
        </form>
    </x-modal>
    @endforeach
</x-company-layout>
