<x-company-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Important Links') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ $user->name }}

<form method="POST" action="{{ route('company.links.update',$link->ID) }}">
                        @csrf
                        <div class="grid gap-6 mt-6">
                            

                            <!-- Link -->
                            <div class="space-y-2">
                                <x-form.label for="link" :value="__('Link')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-link aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.input withicon id="link" class="block w-full" type="text"
                                        name="link" :value="old('link',$link->link)" required placeholder="{{ __('Link') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>


                            <div class="flex justify-end sm:flex-col sm:items-end mt-6">
                                <div>
                                    <x-button :variant="'primary'" items-end size="base">
                                        <span>{{ __('Save') }}</span>
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-company-layout>
