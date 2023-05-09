<x-company-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Training Plan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('status') === 'plan-created')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-green-600">
                            {{ __('A plan has been created successfully.') }}
                        </p>
                    @endif
                    @if (session('status') === 'plan-deleted')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-red-600">
                            {{ __('plan has been deleted successfully.') }}
                        </p>
                    @endif
                    @if (session('status') === 'plan-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-green-600">
                            {{ __('plan has been updated successfully.') }}
                        </p>
                    @endif
                    {{ $user->name }}

                    <div class="relative overflow-x-auto mt-4">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Plan
                                    </th>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plans as $plan)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <a href="/plans/{{$user->ID}}/{{ $plan->file }}" target=_blank ><span style="text-overflow: ellipsis;">{{ $plan->file }}</span></a>
                                            
                                        </th>
                                        <td class="px-6 py-4">
                                        <div class="flex justify-end sm:flex-col sm:items-end">
                                            <div class="inline-flex rounded-md shadow-sm" role="group">
                                                <x-button variant="danger" x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-plan-deletion-{{ $plan->ID }}')"
                                                    class="rounded-r-md">
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
                    @if($plans->count() === 0)
                    <div class="flex justify-end sm:flex-col sm:items-end mt-6">
                        <div>
                            <x-button :variant="'primary'" items-end size="sm"
                                href="{{ route('company.plan.insert', $user->ID) }}">
                                Add New Plan
                            </x-button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
     @foreach ($plans as $plan)
    <x-modal name="confirm-plan-deletion-{{ $plan->ID }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('company.plan.destroy', $plan->ID) }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium">
                    {{ __('Are you sure you want to delete this plan?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('This plan will be permanently deleted.') }}
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
