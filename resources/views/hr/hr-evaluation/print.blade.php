<x-print-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <table class="table-auto w-full">
                            <tbody>
                                <tr>
                                    <td class="px-2">
                                        <h2 class="text-lg font-medium">
                                            {{ __('CO-OP Trainee Evaluation') }}
                                        </h2>
                                    </td>
                                    <td class="px-2" align=right>
                                        <img src="/images/Picture1.svg" class="w-10 h-auto">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </header>

                    <div class="mt-2 mb-2 py-2 px-2 border-b border-gray-300 dark:border-gray-700">
                        <h2 class="text-md font-semibold text-gray-700">
                            {{ __('Trainee Information') }}
                        </h2>
                        <div class="mt-4">
                            <table
                                class="table-auto w-full text-sm text-left text-gray-500 border-collapse border border-slate-400 dark:text-gray-400">
                                <tbody>
                                    <tr>
                                        <td class="border border-slate-300 px-2">
                                            <x-form.label for="student_name" :value="__('Name')" />
                                            {{ $user->student_name ? $user->student_name : '-' }}
                                        </td>
                                        <td class="border border-slate-300 px-2">
                                            <x-form.label for="student_identification" :value="__('ID')" />
                                            {{ $user->student_identification ? $user->student_identification : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border border-slate-300 px-2">
                                            <x-form.label for="student_university" :value="__('University')" />
                                            {{ $user->student_university ? $user->student_university : '-' }}
                                        </td>
                                        <td class="border border-slate-300 px-2">
                                            <x-form.label for="student_major" :value="__('Major')" />
                                            {{ $user->student_major ? $user->student_major : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border border-slate-300 px-2">
                                            <x-form.label for="student_telephone" :value="__('Telephone')" />
                                            {{ $user->student_telephone ? $user->student_telephone : '-' }}
                                        </td>
                                        <td class="border border-slate-300 px-2">
                                            <x-form.label for="student_mobile" :value="__('Mobile')" />
                                            {{ $user->student_mobile ? $user->student_mobile : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border border-slate-300 px-2" colspan="2">
                                            <x-form.label for="student_email" :value="__('Email')" />
                                            {{ $user->student_email ? $user->student_email : '-' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-2 mb-2 py-2 px-2 border-b border-gray-300 dark:border-gray-700">
                        <h2 class="text-md font-semibold text-gray-700">
                            {{ __('Training Supervisor Information') }}
                        </h2>
                        <div class="mt-4">
                            <table
                                class="table-auto w-full text-sm text-left text-gray-500 border-collapse border border-slate-400 dark:text-gray-400">
                                <tbody>
                                    <tr>
                                        <td class="border border-slate-300 px-2">
                                            <x-form.label for="mentor_name" :value="__('Name')" />
                                            {{ $user->mentor_name ? $user->mentor_name : '-' }}
                                        </td>
                                        <td class="border border-slate-300 px-2">
                                            <x-form.label for="mentor_department" :value="__('Department')" />
                                            {{ $user->mentor_department ? $user->mentor_department : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border border-slate-300 px-2">
                                            <x-form.label for="mentor_telephone" :value="__('Telephone')" />
                                            {{ $user->mentor_telephone ? $user->mentor_telephone : '-' }}
                                        </td>
                                        <td class="border border-slate-300 px-2">
                                            <x-form.label for="mentor_mobile" :value="__('Mobile')" />
                                            {{ $user->mentor_mobile ? $user->mentor_mobile : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border border-slate-300 px-2" colspan="2">
                                            <x-form.label for="mentor_email" :value="__('Email')" />
                                            {{ $user->mentor_email ? $user->mentor_email : '-' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-2 mb-2 py-2 px-2 border-b border-gray-300 dark:border-gray-700">
                        <h2 class="text-md font-semibold text-gray-700">
                            {{ __('Training Department Information') }}
                        </h2>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <table
                                class="table-auto w-full text-sm text-left text-gray-500 border-collapse border border-slate-400 dark:text-gray-400">
                                <tbody>
                                    <tr>
                                        <td class="border border-slate-300 px-2">
                                            <x-form.label for="head_of_training" :value="__('Head of Training Dept. Name')" />
                                            {{ $user->head_of_training ? $user->head_of_training : '-' }}
                                        </td>
                                        <td class="border border-slate-300 px-2">
                                            <x-form.label for="phone" :value="__('Phone')" />
                                            {{ $user->phone ? $user->phone : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border border-slate-300 px-2">
                                            <x-form.label for="fax" :value="__('Fax')" />
                                            {{ $user->fax ? $user->fax : '-' }}
                                        </td>
                                        <td class="border border-slate-300 px-2">
                                            <x-form.label for="email" :value="__('Email')" />
                                            {{ $user->email ? $user->email : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border border-slate-300 px-2" colspan="2">
                                            <x-form.label for="date" :value="__('Date')" />
                                            {{ $user->date ? $user->date : '-' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pagebreak"> </div>
                    <div class="mt-2 mb-2 py-2 px-2 border-b border-gray-300 dark:border-gray-700">
                        <h2 class="text-md font-semibold text-gray-700">
                            {{ __('Personality and Overall Performance Evaluation') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('filled by training supervisor') }}
                        </p>
                        <div class="mt-4">
                            <table
                                class="table-auto w-full text-sm text-left text-gray-500 border-collapse border border-slate-400 dark:text-gray-400">
                                <thead class="text-sm text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-2 border border-slate-300">
                                            Evaluation Criteria
                                        </th>
                                        <th scope="col" class="px-2 border border-slate-300">
                                            Score and Remarks
                                            <p class="font-medium">( 1 = low; 5 = high )</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($criterias as $criteria)
                                        <tr>
                                            <td class="px-2 border border-slate-300">
                                                {{ $criteria->criteria }}
                                            </td>
                                            <td class="px-2 border border-slate-300">
                                                @if ($criteria->student_id === $user->SID)
                                                    {{ $criteria->score }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="px-2 border border-slate-300 font-semibold">
                                            Total Score
                                        </td>
                                        <td class="px-2 border border-slate-300 font-semibold">
                                            <input id="total_score" name="total_score" type="hidden" />
                                            {{ $user->total_score }} out of 50
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 border border-slate-300 font-semibold">
                                            <input id="percentage" name="percentage" type="hidden" />
                                            Percentage
                                        </td>
                                        <td class="px-2 border border-slate-300 font-semibold">
                                            {{ $user->percentage }} %
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-2 mb-2 py-2 px-2 border-b border-gray-300 dark:border-gray-700">
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
                                <thead class="text-sm text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-2 border border-slate-300">
                                            Topic
                                        </th>
                                        <th scope="col" class="px-2 border border-slate-300">
                                            Start Date
                                        </th>
                                        <th scope="col" class="px-2 border border-slate-300">
                                            End Date
                                        </th>
                                        <th scope="col" class="px-2 border border-slate-300">
                                            Employee in charge of Training
                                        </th>
                                        <th scope="col" class="px-2 border border-slate-300">
                                            Department/Section
                                        </th>
                                        <th scope="col" class="px-2 border border-slate-300">
                                            Score and Remarks
                                            <p class="font-medium">( 1 = low; 5 = high )</p>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($practical_evaluations as $practical_evaluation)
                                        <tr id="row{{ $loop->index }}">
                                            <td class="px-2 border border-slate-300">
                                                {{ $practical_evaluation->topic }}
                                            </td>
                                            <td class="px-2 border border-slate-300">
                                                {{ $practical_evaluation->start_date }}
                                            </td>
                                            <td class="px-2 border border-slate-300">
                                                {{ $practical_evaluation->end_date }}
                                            </td>
                                            <td class="px-2 border border-slate-300">
                                                {{ $practical_evaluation->employee }}
                                            </td>
                                            <td class="px-2 border border-slate-300">
                                                {{ $practical_evaluation->department }}
                                            </td>
                                            <td class="px-2 border border-slate-300">
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
