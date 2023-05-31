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
                    {{ $user->name }}

<form method="POST" action="{{ route('company.links.store',$user->ID) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="grid gap-6 mt-6">
                            
                            <!-- Type -->
                            <div class="space-y-2">
                                <x-form.label for="type" :value="__('Type')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-question-mark-circle aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.select withicon id="type" class="block w-full" name="type">
                                        <option value="" selected disabled hidden>{{ __('Choose an option') }}</option>
                                        <option value="Hyperlink">Hyperlink</option>
                                        <option value="File">File</option>
                                    </x-form.select>
                                </x-form.input-with-icon-wrapper>
                            </div>

                            <!-- Link -->
                            <div class="space-y-2" id="input1">
                                <x-form.label for="link" :value="__('Link')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-link aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.input withicon id="link" class="block w-full" type="text"
                                        name="link" :value="old('link')" placeholder="{{ __('Link') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>

                            <!-- file -->
                            <div class="space-y-2" id="input2">
                                <x-form.label for="file" :value="__('File')" />

                                <input
                                    class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                                    id="file" type="file" name="file" value="old('file')"
                                    placeholder="{{ __('File') }}" />

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
