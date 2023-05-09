<table
    class="table-auto w-full text-sm text-left text-gray-500 border-collapse border border-slate-400 dark:text-gray-400"
    id="dynamic_field">
    <thead class="text-xs text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3 border border-slate-300">
                Topic
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-300">
                Start Date
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-300">
                End Date
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-300">
                Employee in charge of Training
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-300">
                Department/Section
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-300">
                Score and Remarks
                <p class="font-medium">( 1 = low; 5 = high )</p>
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-300">

            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($evaluation as $key => $value)
            <tr>
                <td class="px-2 py-2 border border-slate-300">
                    <x-form.input type="text" class="block w-full" :value="old('topic', $value->topic)"
                        autofocus autocomplete="topic" />
                </td>
                <td class="px-2 py-2 border border-slate-300">
                    <x-form.input type="text" class="block w-full"
                        :value="old('start_date', $value->start_date)" autofocus autocomplete="start_date" />
                </td>
                <td class="px-2 py-2 border border-slate-300">
                    <x-form.input type="text" class="block w-full" :value="old('end_date', $value->end_date)"
                        autofocus autocomplete="end_date" />
                </td>
                <td class="px-2 py-2 border border-slate-300">
                    <x-form.input type="text" class="block w-full" :value="old('employee', $value->employee)"
                        autofocus autocomplete="employee" />
                </td>
                <td class="px-2 py-2 border border-slate-300">
                    <x-form.input type="text" class="block w-full"
                        :value="old('department', $value->department)" autofocus autocomplete="department" />
                </td>
                <td class="px-2 py-2 border border-slate-300">
                    <x-form.select id="select" class="block w-full">
                        <option value="">
                        </option>
                        <option value="1">1
                        </option>
                        <option value="2">2
                        </option>
                        <option value="3">3
                        </option>
                        <option value="4">
                            4</option>
                        <option value="5">
                            5</option>
                    </x-form.select>
                </td>
            </tr>
        @endforeach

        <tr id="row" class=" add-input">
            <td class="px-2 py-2 border border-slate-300">
                <x-form.input type="text" class="block w-full" :value="old('topic')"
                    autofocus autocomplete="topic" wire:model="topic.0" />
            </td>
            <td class="px-2 py-2 border border-slate-300">
                <x-form.input type="text" class="block w-full" :value="old('start_date')"
                    autofocus autocomplete="start_date" wire:model="start_date.0" />
            </td>
            <td class="px-2 py-2 border border-slate-300">
                <x-form.input type="text" class="block w-full" :value="old('end_date')"
                    autofocus autocomplete="end_date" wire:model="end_date.0" />
            </td>
            <td class="px-2 py-2 border border-slate-300">
                <x-form.input type="text" class="block w-full" :value="old('employee')"
                    autofocus autocomplete="employee" wire:model="employee.0" />
            </td>
            <td class="px-2 py-2 border border-slate-300">
                <x-form.input type="text" class="block w-full" :value="old('department')"
                    autofocus autocomplete="department" wire:model="department.0" />
            </td>
            <td class="px-2 py-2 border border-slate-300">

                <x-form.select class="block w-full" wire:model="score.0">
                    <option value="">
                    </option>
                    <option value="1">1
                    </option>
                    <option value="2">2
                    </option>
                    <option value="3">3
                    </option>
                    <option value="4">
                        4</option>
                    <option value="5">
                        5</option>
                </x-form.select>
            </td>
            <td class="px-2 py-2 border border-slate-300">
                <x-button variant="success" size="sm" name="add" id="add" type="button"
                    class="rounded-l-md border-t border-b border-r" wire:click.prevent="add({{ $i }})">
                    <x-heroicon-o-plus class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-button>

            </td>
        </tr>

        @foreach ($inputs as $key => $value)
            <tr id="row" class=" add-input">
                <td class="px-2 py-2 border border-slate-300">
                    <x-form.input type="text" class="block w-full"
                        :value="old('topic')" autofocus autocomplete="topic" wire:model="topic.{{ $value }}" />
                </td>
                <td class="px-2 py-2 border border-slate-300">
                    <x-form.input type="text" class="block w-full"
                        :value="old('start_date')" autofocus autocomplete="start_date"
                        wire:model="start_date.{{ $value }}" />
                </td>
                <td class="px-2 py-2 border border-slate-300">
                    <x-form.input type="text" class="block w-full"
                        :value="old('end_date')" autofocus autocomplete="end_date"
                        wire:model="end_date.{{ $value }}" />
                </td>
                <td class="px-2 py-2 border border-slate-300">
                    <x-form.input type="text" class="block w-full"
                        :value="old('employee')" autofocus autocomplete="employee"
                        wire:model="employee.{{ $value }}" />
                </td>
                <td class="px-2 py-2 border border-slate-300">
                    <x-form.input type="text" class="block w-full"
                        :value="old('department')" autofocus autocomplete="department"
                        wire:model="department.{{ $value }}" />
                </td>
                <td class="px-2 py-2 border border-slate-300">

                    <x-form.select class="block w-full"
                        wire:model="score.{{ $value }}">
                        <option value="">
                        </option>
                        <option value="1">1
                        </option>
                        <option value="2">2
                        </option>
                        <option value="3">3
                        </option>
                        <option value="4">
                            4</option>
                        <option value="5">
                            5</option>
                    </x-form.select>
                </td>
                <td class="px-2 py-2 border border-slate-300">
                    <x-button variant="danger" size="sm" type="button"
                        class="rounded-l-md border-t border-b border-r btn_remove"
                        wire:click.prevent="remove({{ $key+2 }})">
                        <x-heroicon-o-minus class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                    </x-button>

                </td>
            </tr>
        @endforeach


    </tbody>
</table>
