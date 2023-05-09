<x-company-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('HR Evaluation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium">
                            {{ __('CO-OP Trainee Evaluation') }}
                        </h2>
                    </header>

                    <form method="post" action="{{ route('company.profile.update') }}">
                        @csrf
                        <div class="mt-6 mb-4 py-4 px-4 border-b border-gray-300 dark:border-gray-700">
                            <h2 class="text-md font-semibold text-gray-700">
                                {{ __('Trainee Information') }}
                            </h2>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Name -->
                                <div class="space-y-2">
                                    <x-form.label for="student_name" :value="__('Name')" />
                                    <x-form.input id="student_name" name="student_name" type="text"
                                        class="block w-full" :value="old('student_name', $user->student_name)" required autofocus
                                        autocomplete="student_name" />

                                    <x-form.error :messages="$errors->get('student_name')" />
                                </div>

                                <!-- ID -->
                                <div class="space-y-2">
                                    <x-form.label for="student_identification" :value="__('ID')" />
                                    <x-form.input id="student_identification" name="student_identification"
                                        type="text" class="block w-full" :value="old('student_identification', $user->student_identification)" required autofocus
                                        autocomplete="student_identification" />

                                    <x-form.error :messages="$errors->get('student_identification')" />
                                </div>

                                <!-- University -->
                                <div class="space-y-2">
                                    <x-form.label for="student_university" :value="__('University')" />
                                    <x-form.input id="student_university" name="student_university" type="text"
                                        class="block w-full" :value="old('student_university', $user->student_university)" required autofocus
                                        autocomplete="student_university" />

                                    <x-form.error :messages="$errors->get('student_university')" />
                                </div>

                                <!-- Major -->
                                <div class="space-y-2">
                                    <x-form.label for="student_major" :value="__('Major')" />
                                    <x-form.input id="student_major" name="student_major" type="text"
                                        class="block w-full" :value="old('student_major', $user->student_major)" required autofocus
                                        autocomplete="student_major" />

                                    <x-form.error :messages="$errors->get('student_major')" />
                                </div>

                                <!-- Telephone -->
                                <div class="space-y-2">
                                    <x-form.label for="student_telephone" :value="__('Telephone')" />

                                    <x-form.input id="student_telephone" name="student_telephone" type="text"
                                        class="block w-full" :value="old('student_telephone', $user->student_telephone)" autofocus
                                        autocomplete="student_telephone" />

                                    <x-form.error :messages="$errors->get('student_telephone')" />
                                </div>

                                <!-- Mobile -->
                                <div class="space-y-2">
                                    <x-form.label for="student_mobile" :value="__('Mobile')" />

                                    <x-form.input id="student_mobile" name="student_mobile" type="text"
                                        class="block w-full" :value="old('student_mobile', $user->student_mobile)" autofocus
                                        autocomplete="student_mobile" />

                                    <x-form.error :messages="$errors->get('student_mobile')" />
                                </div>

                                <!-- Email -->
                                <div class="space-y-2">
                                    <x-form.label for="student_email" :value="__('Email')" />
                                    <x-form.input id="student_email" name="student_email" type="email"
                                        class="block w-full" :value="old('student_email', $user->student_email)" required autocomplete="student_email" />

                                    <x-form.error :messages="$errors->get('student_email')" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 mb-4 py-4 px-4 border-b border-gray-300 dark:border-gray-700">
                            <h2 class="text-md font-semibold text-gray-700">
                                {{ __('Training Supervisor Information') }}
                            </h2>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">

                                <!-- Name -->
                                <div class="space-y-2">
                                    <x-form.label for="student_name" :value="__('Name')" />
                                    <x-form.input id="student_name" name="student_name" type="text"
                                        class="block w-full" :value="old('student_name', $user->student_name)" required autofocus
                                        autocomplete="student_name" />

                                    <x-form.error :messages="$errors->get('student_name')" />
                                </div>

                                <!-- Department -->
                                <div class="space-y-2">
                                    <x-form.label for="mentor_department" :value="__('Department')" />
                                    <x-form.input id="mentor_department" name="mentor_department" type="text"
                                        class="block w-full" :value="old('mentor_department', $user->mentor_department)" required autofocus
                                        autocomplete="mentor_department" />

                                    <x-form.error :messages="$errors->get('mentor_department')" />
                                </div>


                                <!-- Telephone -->
                                <div class="space-y-2">
                                    <x-form.label for="student_telephone" :value="__('Telephone')" />

                                    <x-form.input id="student_telephone" name="student_telephone" type="text"
                                        class="block w-full" :value="old('student_telephone', $user->student_telephone)" autofocus
                                        autocomplete="student_telephone" />

                                    <x-form.error :messages="$errors->get('student_telephone')" />
                                </div>

                                <!-- Mobile -->
                                <div class="space-y-2">
                                    <x-form.label for="student_mobile" :value="__('Mobile')" />

                                    <x-form.input id="student_mobile" name="student_mobile" type="text"
                                        class="block w-full" :value="old('student_mobile', $user->student_mobile)" autofocus
                                        autocomplete="student_mobile" />

                                    <x-form.error :messages="$errors->get('student_mobile')" />
                                </div>

                                <!-- Email -->
                                <div class="space-y-2">
                                    <x-form.label for="student_email" :value="__('Email')" />
                                    <x-form.input id="student_email" name="student_email" type="email"
                                        class="block w-full" :value="old('student_email', $user->student_email)" required autocomplete="student_email" />

                                    <x-form.error :messages="$errors->get('student_email')" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 mb-4 py-4 px-4 border-b border-gray-300 dark:border-gray-700">
                            <h2 class="text-md font-semibold text-gray-700">
                                {{ __('Training Department Information') }}
                            </h2>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">

                                <!-- Name -->
                                <div class="space-y-2">
                                    <x-form.label for="head_of_training" :value="__('Head of Training Dept. Name')" />
                                    <x-form.input id="head_of_training" name="head_of_training" type="text"
                                        class="block w-full" :value="old('head_of_training', $user->head_of_training)" required autofocus
                                        autocomplete="head_of_training" />

                                    <x-form.error :messages="$errors->get('head_of_training')" />
                                </div>

                                <!-- Phone -->
                                <div class="space-y-2">
                                    <x-form.label for="phone" :value="__('Phone')" />
                                    <x-form.input id="phone" name="phone" type="text" class="block w-full"
                                        :value="old('phone', $user->phone)" required autofocus autocomplete="phone" />

                                    <x-form.error :messages="$errors->get('phone')" />
                                </div>


                                <!-- Fax -->
                                <div class="space-y-2">
                                    <x-form.label for="fax" :value="__('Fax')" />

                                    <x-form.input id="fax" name="fax" type="text" class="block w-full"
                                        :value="old('fax', $user->fax)" autofocus autocomplete="fax" />

                                    <x-form.error :messages="$errors->get('fax')" />
                                </div>

                                <!-- Email -->
                                <div class="space-y-2">
                                    <x-form.label for="student_email" :value="__('Email')" />
                                    <x-form.input id="student_email" name="student_email" type="email"
                                        class="block w-full" :value="old('student_email', $user->student_email)" required
                                        autocomplete="student_email" />

                                    <x-form.error :messages="$errors->get('student_email')" />
                                </div>

                                <!-- Date -->
                                <div class="space-y-2">
                                    <x-form.label for="date" :value="__('Date')" />
                                    <x-form.input id="date" name="date" type="date" class="block w-full"
                                        :value="old('date', $user->date)" required autocomplete="date" />

                                    <x-form.error :messages="$errors->get('date')" />
                                </div>

                            </div>
                        </div>

                        <div class="mt-6 mb-4 py-4 px-4 border-b border-gray-300 dark:border-gray-700">
                            <h2 class="text-md font-semibold text-gray-700">
                                {{ __('Personality and Overall Performance Evaluation') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('filled by training supervisor') }}
                            </p>
                            <div class="mt-4">
                                <table
                                    class="table-auto w-full text-sm text-left text-gray-500 border-collapse border border-slate-400 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 border border-slate-300">
                                                Evaluation Criteria
                                            </th>
                                            <th scope="col" class="px-6 py-3 border border-slate-300">
                                                Score and Remarks
                                                <p class="font-medium">( 1 = low; 5 = high )</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($criterias as $criteria)
                                            <tr>
                                                <td class="px-6 py-4 border border-slate-300">
                                                    {{ $criteria->criteria }}
                                                </td>
                                                <td class="px-6 py-4 border border-slate-300">

                                                    <x-form.select id="select" class="block w-full"
                                                        name="score">
                                                        <option value=""
                                                            @if ($criteria->score === '') selected @endif></option>
                                                        <option value="1"
                                                            @if ($criteria->score === 1) selected @endif>1</option>
                                                        <option value="2"
                                                            @if ($criteria->score === 2) selected @endif>2</option>
                                                        <option value="3"
                                                            @if ($criteria->score === 3) selected @endif>3</option>
                                                        <option value="4"
                                                            @if ($criteria->score === 4) selected @endif>4</option>
                                                        <option value="5"
                                                            @if ($criteria->score === 5) selected @endif>5</option>
                                                    </x-form.select>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="px-6 py-4 border border-slate-300 font-semibold">
                                                Total Score
                                            </td>
                                            <td class="px-6 py-4 border border-slate-300 font-semibold">
                                                out of 50
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 border border-slate-300 font-semibold">
                                                Percentage
                                            </td>
                                            <td class="px-6 py-4 border border-slate-300 font-semibold">
                                                %
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-6 mb-4 py-4 px-4 border-b border-gray-300 dark:border-gray-700">
                            <h2 class="text-md font-semibold text-gray-700">
                                {{ __('Practical Training Evaluation') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('filled by employee in charge of training') }}
                            </p>
                            <div class="mt-4">
                                
                                @livewire('evaluation',['id' => $user->SID])
                            </div>
                        </div>

                        <div class="flex flex justify-end sm:flex-col sm:items-end mt-6 gap-4">
                            <x-button type="submit">
                                {{ __('Save') }}
                            </x-button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Saved.') }}
                                </p>
                            @endif
                        </div>
                    </form>
                </section>

            </div>


        </div>
    </div>
</x-company-layout>
