<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trainees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                <div class="p-6 text-gray-900">
                    @if (session('status') === 'trainee-created')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-green-600">
                            {{ __('A new trainee has been created successfully.') }}
                        </p>
                    @endif
                    @if (session('status') === 'trainee-deleted')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-red-600">
                            {{ __('Trainee has been deleted successfully.') }}
                        </p>
                    @endif
                    @if (session('status') === 'trainee-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-green-600">
                            {{ __('Trainee has been updated successfully.') }}
                        </p>
                    @endif
                    {{ __('Trainees List') }}

                    <ul role="list" class="divide-y divide-gray-100 mt-6">
                        @foreach ($students as $student)
                            <li class="flex justify-between gap-x-6 py-5 mb-4">
                                <div class="flex gap-x-4">
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ $student->name }}
                                        </p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                                            {{ $student->email }}</p>
                                    </div>
                                </div>
                                <div class="sm:flex-col sm:items-end">
                                    <p class="text-sm leading-6 text-gray-900">{{ $student->major }}</p>
                                    <p class="mt-1 text-xs leading-5 text-gray-500">
                                    </p>
                                    <div class="inline-flex rounded-md shadow-sm" role="group">
                                        <x-button variant="secondary" href="{{ route('admin.trainees.view',$student->ID) }}" 
                                            :squared=true class="rounded-l-md border-t border-b border-r">
                                            <x-heroicon-o-eye class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                                        </x-button>
                                        <x-button variant="secondary" href="{{ route('admin.trainees.edit',$student->ID) }}" 
                                            :squared=true class="border-t border-b border-r">
                                            <x-heroicon-o-pencil-alt class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                                        </x-button>
                                        <x-button variant="danger" x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-trainee-deletion-{{ $student->ID }}')"
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
                                href="{{ route('admin.trainees.insert') }}">
                                Add New Trainee
                            </x-button>
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </div>

    @foreach ($students as $student)
    <x-modal name="confirm-trainee-deletion-{{ $student->ID }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('admin.trainees.destroy', $student->ID) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium">
                {{ __('Are you sure you want to delete this trainee?') }}
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
    @endforeach
</x-admin-layout>
