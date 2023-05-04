<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('University Mentors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if (session('status') === 'university-created')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-green-600">
                            {{ __('A new mentor has been created successfully.') }}
                        </p>
                    @endif
                    @if (session('status') === 'university-deleted')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-red-600">
                            {{ __('University mentor has been deleted successfully.') }}
                        </p>
                    @endif
                    @if (session('status') === 'university-trainee-created')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-green-600">
                            {{ __('Trainees list has been updated successfully.') }}
                        </p>
                    @endif
                    @if (session('status') === 'university-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-green-600">
                            {{ __('University mentor has been updated successfully.') }}
                        </p>
                    @endif
                    {{ __('University Mentors List') }}
                    <ul role="list" class="divide-y divide-gray-100 mt-6">
                        @foreach ($university_mentors as $university_mentor)
                            <li class="flex justify-between gap-x-6 py-5 mb-4">
                                <div class="flex gap-x-4">
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">
                                            {{ $university_mentor->name }}
                                        </p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                                            {{ $university_mentor->email }}</p>
                                    </div>
                                </div>
                                <div class="flex-auto sm:flex-col sm:items-end">
                                    <p class="text-sm leading-6 text-gray-900">{{ $university_mentor->mobile }}</p>
                                    <p class="mt-1 text-xs leading-5 text-gray-500">
                                    </p>
                                    <div class="inline-flex rounded-md shadow-sm" role="group">
                                        <x-button variant="secondary" href="{{ route('admin.university.view',$university_mentor->ID) }}" 
                                            :squared=true class="rounded-l-md border-t border-b border-r">
                                            <x-heroicon-o-eye class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                                        </x-button>
                                        <x-button variant="secondary" href="{{ route('admin.university.edit',$university_mentor->ID) }}" 
                                            :squared=true class="border-t border-b border-r">
                                            <x-heroicon-o-pencil-alt class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                                        </x-button>
                                        <x-button variant="secondary" x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-university-trainee-add-{{ $university_mentor->ID }}')"
                                            :squared=true class="border-t border-b border-gray-200 hover:bg-gray-100">
                                            <x-heroicon-o-user-add class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                                        </x-button>
                                        <x-button variant="danger" x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-university-deletion-{{ $university_mentor->ID }}')"
                                            :squared=true class="rounded-r-md">
                                            <x-heroicon-o-trash class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                                        </x-button>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="flex justify-end sm:flex-col sm:items-end mt-6">
                        <div>
                             <x-button :variant="'primary'" items-end size="base"
                                href="{{ route('admin.university.insert') }}">
                                Add New University Mentor
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($university_mentors as $university_mentor)
        <x-modal name="confirm-university-deletion-{{ $university_mentor->ID }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('admin.university.destroy', $university_mentor->ID) }}"
                class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium">
                    {{ __('Are you sure you want to delete this mentor?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Once the account is deleted, all of its resources and data will be permanently deleted.') }}
                </p>


                <div class="mt-6 flex justify-end">
                    <x-button type="button" variant="secondary" x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-button>

                    <x-button variant="danger" class="ml-3">
                        {{ __('Delete Account') }}
                    </x-button>
                </div>
            </form>
        </x-modal>

        <x-modal name="confirm-university-trainee-add-{{ $university_mentor->ID }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('admin.university.add_trainees', $university_mentor->ID) }}" class="p-6">
                @csrf

                <h2 class="text-lg font-medium mb-4">
                    {{ __('Please select from trainees list to be mentored by') }} {{ Auth::user()->name }}
                </h2>
                <div class="border border-gray-200 rounded dark:border-gray-700">
                    @foreach ($students as $student)
                        <div class="flex items-center pl-4">
                            <input id="check-{{ $student->ID }}" type="checkbox" value="{{ $student->ID }}"
                                name="trainees[]"
                                class="ml-4 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                @foreach ($university_students as $university_student)
                                    @if ($university_student->student_id === $student->ID && $university_student->mentor_id === $university_mentor->ID)
                                        checked   
                                    @endif 
                                @endforeach
                                    >
                            <label for="check-{{ $student->ID }}"
                                class="py-4 ml-2 text-sm text-sm text-gray-600 dark:text-gray-400">{{ $student->name }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6 flex justify-end">
                    <x-button type="button" variant="secondary" x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-button>

                    <x-button variant="success" class="ml-3">
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>
        </x-modal>

    @endforeach
</x-admin-layout>
