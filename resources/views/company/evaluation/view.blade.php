<x-company-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('status') === 'evaluation-created')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-green-600">
                            {{ __('A evaluation has been created successfully.') }}
                        </p>
                    @endif
                    @if (session('status') === 'evaluation-deleted')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-red-600">
                            {{ __('evaluation has been deleted successfully.') }}
                        </p>
                    @endif
                    @if (session('status') === 'evaluation-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-green-600">
                            {{ __('evaluation has been updated successfully.') }}
                        </p>
                    @endif
                    {{ $user->name }}

                    <div class="relative overflow-x-auto mt-4">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Evaluation
                                    </th>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($evaluation as $eval)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <a href="/evaluation/{{$user->ID}}/{{ $eval->file }}" target=_blank ><span style="text-overflow: ellipsis;">{{ $eval->file }}</span></a>
                                            
                                        </th>
                                        <td class="px-6 py-4">
                                        <div class="flex justify-end sm:flex-col sm:items-end">
                                            <div class="inline-flex rounded-md shadow-sm" role="group">
                                                <x-button variant="danger" x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-eval-deletion-{{ $eval->ID }}')"
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
                    @if($evaluation->count() === 0)
                    <div class="flex justify-end sm:flex-col sm:items-end mt-6">
                        <div>
                            <x-button :variant="'primary'" items-end size="sm"
                                href="{{ route('company.evaluation.insert', $user->ID) }}">
                                Add New Evaluation
                            </x-button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
     @foreach ($evaluation as $eval)
    <x-modal name="confirm-eval-deletion-{{ $eval->ID }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('company.evaluation.destroy', $eval->ID) }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium">
                    {{ __('Are you sure you want to delete this evaluation?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('This evaluation will be permanently deleted.') }}
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
