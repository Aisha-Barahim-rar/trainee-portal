<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('HR Admins') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('status') === 'hr-created')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-green-600">
                            {{ __('A new HR admin has been created successfully.') }}
                        </p>
                    @endif
                    @if (session('status') === 'hr-deleted')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-red-600">
                            {{ __('HR admin has been deleted successfully.') }}
                        </p>
                    @endif
                    @if (session('status') === 'hr-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-green-600">
                            {{ __('HR admin has been updated successfully.') }}
                        </p>
                    @endif
                    {{ __('HR Admins List') }}
                    <ul role="list" class="divide-y divide-gray-100 mt-6">
                        @foreach ($hr_admins as $hr_admin)
                            <li class="flex justify-between gap-x-6 py-5">
                                <div class="flex gap-x-4">
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ $hr_admin->name }}
                                        </p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                                            {{ $hr_admin->email }}</p>
                                    </div>
                                </div>
                                <div class="flex-auto sm:flex-col sm:items-end">
                                    <p class="text-sm leading-6 text-gray-900">{{ $hr_admin->mobile }}</p>
                                    <p class="mt-1 text-xs leading-5 text-gray-500">
                                    </p>
                                    <div class="inline-flex rounded-md shadow-sm" role="group">
                                        <x-button variant="secondary" href="{{ route('admin.hr.view',$hr_admin->ID) }}" 
                                            :squared=true class="rounded-l-md border-t border-b border-r">
                                            <x-heroicon-o-eye class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                                        </x-button>
                                        <x-button variant="secondary" href="{{ route('admin.hr.edit',$hr_admin->ID) }}" 
                                            :squared=true class="border-t border-b border-r">
                                            <x-heroicon-o-pencil-alt class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                                        </x-button>
                                        <x-button variant="danger" x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-hr-deletion-{{ $hr_admin->ID }}')"
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
                             href="{{ route('admin.hr.insert') }}">
                                Add New HR Admin
                            </x-button>
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </div>
    @foreach ($hr_admins as $hr_admin)
        <x-modal name="confirm-hr-deletion-{{ $hr_admin->ID }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('admin.hr.destroy', $hr_admin->ID) }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium">
                    {{ __('Are you sure you want to delete this HR admin?') }}
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
