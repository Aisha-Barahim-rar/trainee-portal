<x-print-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('HR Evaluation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    @if (session('status') === 'evaluation-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-green-600">
                            {{ __('Changes saved.') }}
                        </p>
                    @endif
                    <header>
                        <h2 class="text-lg font-medium">
                            {{ __('CO-OP Trainee Evaluation') }}
                        </h2>
                    </header>

                        <div class="mt-6 mb-4 py-4 px-4 border-b border-gray-300 dark:border-gray-700">
                            <h2 class="text-md font-semibold text-gray-700">

                                {{ __('Trainee Information') }}
                            </h2>
                            <div class="mt-4 grid grid-cols-2 gap-4">
                                <!-- Name -->
                                <div class="space-y-2">
                                    <x-form.label for="student_name" :value="__('Name')" class="mb-4" />
                                    {{ $user->student_name ? $user->student_name :'-'}}

                                </div>

                                <!-- ID -->
                                <div class="space-y-2">
                                    <x-form.label for="student_identification" :value="__('ID')" class="mb-4" />
                                    {{ $user->student_identification ? $user->student_identification : '-' }}
                                </div>

                                <!-- University -->
                                <div class="space-y-2">
                                    <x-form.label for="student_university" :value="__('University')" />
                                    {{ $user->student_university ? $user->student_university : '-' }}
                                </div>

                                <!-- Major -->
                                <div class="space-y-2">
                                    <x-form.label for="student_major" :value="__('Major')" />
                                    {{ $user->student_major ? $user->student_major : '-' }}
                                </div>

                                <!-- Telephone -->
                                <div class="space-y-2">
                                    <x-form.label for="student_telephone" :value="__('Telephone')" />
                                     {{ $user->student_telephone ? $user->student_telephone : '-' }}
                                </div>

                                <!-- Mobile -->
                                <div class="space-y-2">
                                    <x-form.label for="student_mobile" :value="__('Mobile')" />
                                    {{ $user->student_mobile ? $user->student_mobile : '-' }}
                                </div>

                                <!-- Email -->
                                <div class="space-y-2">
                                    <x-form.label for="student_email" :value="__('Email')" />
                                    {{ $user->student_email ? $user->student_email : '-' }}
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
                                    <x-form.label for="mentor_name" :value="__('Name')" />
                                    {{ $user->mentor_name ? $user->mentor_name : '-' }}
                                </div>

                                <!-- Department -->
                                <div class="space-y-2">
                                    <x-form.label for="mentor_department" :value="__('Department')" />
                                    {{ $user->mentor_department ? $user->mentor_department : '-' }}
                                </div>


                                <!-- Telephone -->
                                <div class="space-y-2">
                                    <x-form.label for="mentor_telephone" :value="__('Telephone')" />
                                    {{ $user->mentor_telephone ? $user->mentor_telephone : '-' }}
                                </div>

                                <!-- Mobile -->
                                <div class="space-y-2">
                                    <x-form.label for="mentor_mobile" :value="__('Mobile')" />
                                    {{ $user->mentor_mobile ? $user->mentor_mobile : '-' }}
                                </div>

                                <!-- Email -->
                                <div class="space-y-2">
                                    <x-form.label for="mentor_email" :value="__('Email')" />
                                    {{ $user->mentor_email ? $user->mentor_email : '-' }}
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
                                    {{ $user->head_of_training ? $user->head_of_training : '-' }}
                                </div>

                                <!-- Phone -->
                                <div class="space-y-2">
                                    <x-form.label for="phone" :value="__('Phone')" />
                                    {{ $user->phone ? $user->phone : '-' }}
                                </div>


                                <!-- Fax -->
                                <div class="space-y-2">
                                    <x-form.label for="fax" :value="__('Fax')" />
                                    {{ $user->fax ? $user->fax : '-' }}
                                </div>

                                <!-- Email -->
                                <div class="space-y-2">
                                    <x-form.label for="email" :value="__('Email')" />
                                    {{ $user->email ? $user->email : '-' }}
                                </div>

                                <!-- Date -->
                                <div class="space-y-2">
                                    <x-form.label for="date" :value="__('Date')" />
                                    {{ $user->date ? $user->date : '-' }}
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
                                                    @if ($criteria->student_id === $user->SID)
                                                        {{ $criteria->score }}
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="px-6 py-4 border border-slate-300 font-semibold">
                                                Total Score
                                            </td>
                                            <td class="px-6 py-4 border border-slate-300 font-semibold">
                                                <input id="total_score" name="total_score" type="hidden" />
                                                {{ $user->total_score }} out of 50
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 border border-slate-300 font-semibold">
                                                <input id="percentage" name="percentage" type="hidden" />
                                                Percentage
                                            </td>
                                            <td class="px-6 py-4 border border-slate-300 font-semibold">
                                                {{ $user->percentage }} %
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
                            <div class="relative overflow-x-auto mt-4">
                                <table
                                    class="table-auto w-full text-sm text-left text-gray-500 border-collapse border border-slate-400 dark:text-gray-400"
                                    id="dynamic_field">
                                    <thead
                                        class="text-xs text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
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

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($practical_evaluations as $practical_evaluation)
                                            <tr id="row{{ $loop->index }}">
                                                <td class="px-6 py-3 border border-slate-300">
                                                    {{ $practical_evaluation->topic }}
                                                </td>
                                                <td class="px-6 py-3 border border-slate-300">
                                                    {{ $practical_evaluation->start_date }}
                                                </td>
                                                <td class="px-6 py-3 border border-slate-300">
                                                    {{ $practical_evaluation->end_date }}
                                                </td>
                                                <td class="px-6 py-3 border border-slate-300">
                                                    {{ $practical_evaluation->employee }}
                                                </td>
                                                <td class="px-6 py-3 border border-slate-300">
                                                    {{ $practical_evaluation->department }}
                                                </td>
                                                <td class="px-6 py-3 border border-slate-300">
                                                    {{ $practical_evaluation->score }}
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </section>

            </div>


        </div>
    </div>
@push('scripts')
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
@endpush

</x-print-layout>