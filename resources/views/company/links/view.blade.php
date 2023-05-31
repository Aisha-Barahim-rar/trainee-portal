<x-company-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Learning Materials') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('status') === 'link-created')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-green-600">
                            {{ __('A new material has been created successfully.') }}
                        </p>
                    @endif
                    @if (session('status') === 'link-deleted')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-red-600">
                            {{ __('Material has been deleted successfully.') }}
                        </p>
                    @endif
                    @if (session('status') === 'link-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-green-600">
                            {{ __('Material has been updated successfully.') }}
                        </p>
                    @endif
                    {{ $user->name }}

                    <div class="relative overflow-x-auto mt-4">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Learning Material
                                    </th>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($links as $link)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            @if($link->type=="Hyperlink")
                                            <a href="{{ $link->link }}" target=_blank ><span style="text-overflow: ellipsis;">{{ $link->link }}</span></a>
                                            @else
                                            <a href="/files/{{$user->ID}}/{{ $link->link }}" target=_blank ><span style="text-overflow: ellipsis;">{{ $link->link }}</span></a>
                                            @endif
                                        </th>
                                        <td class="px-6 py-4">
                                        <div class="flex justify-end sm:flex-col sm:items-end">
                                            <div class="inline-flex rounded-md shadow-sm" role="group">
                                                <x-button variant="secondary"
                                                    href="{{ route('company.links.edit', [$link->ID,$user->ID]) }}" :squared=true
                                                    class="rounded-l-md border-t border-b border-r">
                                                    <x-heroicon-o-pencil-alt class="flex-shrink-0 w-6 h-6"
                                                        aria-hidden="true" />
                                                </x-button>
                                                <x-button variant="danger" x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-links-deletion-{{ $link->ID }}')"
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
                                href="{{ route('company.links.insert', $user->ID) }}">
                                Add Learning Material
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     @foreach ($links as $link)
    <x-modal name="confirm-links-deletion-{{ $link->ID }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('company.links.destroy', $link->ID) }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium">
                    {{ __('Are you sure you want to delete this link?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('This link will be permanently deleted.') }}
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
