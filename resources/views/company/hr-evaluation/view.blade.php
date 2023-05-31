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
                    @if (session('status') === 'evaluation-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                            class="text-sm mt-2 mb-6 font-medium text-green-600">
                            {{ __('Changes saved.') }}
                        </p>
                    @endif
                    <header>
                        <div class="grid grid-cols-2">
                            <div>
                                <h2 class="text-lg font-medium">
                                    {{ __('CO-OP Trainee Evaluation') }}
                                </h2>
                            </div>
                            @if($user->ID)
                            <div class="place-self-end">
                                <a class="text-gray-600" href="{{ route('hr.hr-evaluation.print', $user->ID) }}" target=_blank>
                               <x-heroicon-o-printer class="flex-shrink-0 w-8 h-8" aria-hidden="true" />
                                </a>
                            </div>
                            @endif
                        </div>
                    </header>

                    <form method="post" action="{{ route('hr.evaluation.store',$user->SID) }}">
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
                                        class="block w-full" :value="old('student_name', $user->student_name?$user->student_name:$user->name)" autofocus
                                        autocomplete="student_name" />

                                    <x-form.error :messages="$errors->get('student_name')" />
                                </div>

                                <!-- ID -->
                                <div class="space-y-2">
                                    <x-form.label for="student_identification" :value="__('ID')" />
                                    <x-form.input id="student_identification" name="student_identification"
                                        type="text" class="block w-full" :value="old('student_identification', $user->student_identification?$user->student_identification:$user->academic_id)" autofocus
                                        autocomplete="student_identification" />

                                    <x-form.error :messages="$errors->get('student_identification')" />
                                </div>

                                <!-- University -->
                                <div class="space-y-2">
                                    <x-form.label for="student_university" :value="__('University')" />
                                    <x-form.input id="student_university" name="student_university" type="text"
                                        class="block w-full" :value="old('student_university', $user->student_university?$user->student_university:$user->university)" autofocus
                                        autocomplete="student_university" />

                                    <x-form.error :messages="$errors->get('student_university')" />
                                </div>

                                <!-- Major -->
                                <div class="space-y-2">
                                    <x-form.label for="student_major" :value="__('Major')" />
                                    <x-form.input id="student_major" name="student_major" type="text"
                                        class="block w-full" :value="old('student_major', $user->student_major?$user->student_major:$user->major)" autofocus
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
                                        class="block w-full" :value="old('student_mobile', $user->student_mobile?$user->student_mobile:$user->mobile)" autofocus
                                        autocomplete="student_mobile" />

                                    <x-form.error :messages="$errors->get('student_mobile')" />
                                </div>

                                <!-- Email -->
                                <div class="space-y-2">
                                    <x-form.label for="student_email" :value="__('Email')" />
                                    <x-form.input id="student_email" name="student_email" type="email"
                                        class="block w-full" :value="old('student_email', $user->student_email?$user->student_email:$user->semail)" autocomplete="student_email" />

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
                                    <x-form.label for="mentor_name" :value="__('Name')" />
                                    <x-form.input id="mentor_name" name="mentor_name" type="text"
                                        class="block w-full" :value="old('mentor_name', $user->mentor_name?$user->mentor_name:$mentor->name)" autofocus
                                        autocomplete="mentor_name" />

                                    <x-form.error :messages="$errors->get('mentor_name')" />
                                </div>

                                <!-- Department -->
                                <div class="space-y-2">
                                    <x-form.label for="mentor_department" :value="__('Department')" />
                                    <x-form.input id="mentor_department" name="mentor_department" type="text"
                                        class="block w-full" :value="old('mentor_department', $user->mentor_department?$user->mentor_department:$mentor->department)" autofocus
                                        autocomplete="mentor_department" />

                                    <x-form.error :messages="$errors->get('mentor_department')" />
                                </div>


                                <!-- Telephone -->
                                <div class="space-y-2">
                                    <x-form.label for="mentor_telephone" :value="__('Telephone')" />

                                    <x-form.input id="mentor_telephone" name="mentor_telephone" type="text"
                                        class="block w-full" :value="old('mentor_telephone', $user->mentor_telephone)" autofocus
                                        autocomplete="mentor_telephone" />

                                    <x-form.error :messages="$errors->get('mentor_telephone')" />
                                </div>

                                <!-- Mobile -->
                                <div class="space-y-2">
                                    <x-form.label for="mentor_mobile" :value="__('Mobile')" />

                                    <x-form.input id="mentor_mobile" name="mentor_mobile" type="text"
                                        class="block w-full" :value="old('mentor_mobile', $user->mentor_mobile?$user->mentor_mobile:$mentor->mobile)" autofocus
                                        autocomplete="mentor_mobile" />

                                    <x-form.error :messages="$errors->get('mentor_mobile')" />
                                </div>

                                <!-- Email -->
                                <div class="space-y-2">
                                    <x-form.label for="mentor_email" :value="__('Email')" />
                                    <x-form.input id="mentor_email" name="mentor_email" type="email"
                                        class="block w-full" :value="old('mentor_email', $user->mentor_email?$user->mentor_email:$mentor->email)" autocomplete="mentor_email" />

                                    <x-form.error :messages="$errors->get('mentor_email')" />
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
                                        class="block w-full" :value="old('head_of_training', $user->head_of_training)" autofocus
                                        autocomplete="head_of_training" />

                                    <x-form.error :messages="$errors->get('head_of_training')" />
                                </div>

                                <!-- Phone -->
                                <div class="space-y-2">
                                    <x-form.label for="phone" :value="__('Phone')" />
                                    <x-form.input id="phone" name="phone" type="text" class="block w-full"
                                        :value="old('phone', $user->phone)" autofocus autocomplete="phone" />

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
                                    <x-form.label for="email" :value="__('Email')" />
                                    <x-form.input id="email" name="email" type="email"
                                        class="block w-full" :value="old('email', $user->email)"
                                        autocomplete="email" />

                                    <x-form.error :messages="$errors->get('email')" />
                                </div>

                                <!-- Date -->
                                <div class="space-y-2">
                                    <x-form.label for="date" :value="__('Date')" />
                                    <x-form.input id="date" name="date" type="date" class="block w-full"
                                        :value="old('date', $user->date)" autocomplete="date" />

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

                                                    <x-form.select id="select{{$loop->index}}" name="score[{{$loop->index}}]" class="score block w-full"
                                                        >
                                                        <option value=""
                                                        @foreach($scores as $score)
                                                        @if($score->criteria_id=== $criteria->ID && $score->companye_id===$user->ID)
                                                            @if ($score->score === '') selected @endif
                                                        @endif
                                                        @endforeach
                                                            ></option>
                                                        <option value="1"
                                                        @foreach($scores as $score)
                                                        @if($score->criteria_id=== $criteria->ID && $score->companye_id===$user->ID)
                                                            @if ($score->score === 1) selected @endif
                                                        @endif
                                                        @endforeach
                                                            >1</option>
                                                        <option value="2"
                                                            @foreach($scores as $score)
                                                        @if($score->criteria_id=== $criteria->ID && $score->companye_id===$user->ID)
                                                            @if ($score->score === 2) selected @endif
                                                        @endif
                                                        @endforeach
                                                            >2</option>
                                                        <option value="3"
                                                            @foreach($scores as $score)
                                                        @if($score->criteria_id=== $criteria->ID && $score->companye_id===$user->ID)
                                                            @if ($score->score === 3) selected @endif
                                                        @endif
                                                        @endforeach
                                                            >3</option>
                                                        <option value="4"
                                                            @foreach($scores as $score)
                                                        @if($score->criteria_id=== $criteria->ID && $score->companye_id===$user->ID)
                                                            @if ($score->score === 4) selected @endif
                                                        @endif
                                                        @endforeach
                                                            >4</option>
                                                        <option value="5"
                                                            @foreach($scores as $score)
                                                        @if($score->criteria_id=== $criteria->ID && $score->companye_id===$user->ID)
                                                            @if ($score->score === 5) selected @endif
                                                        @endif
                                                        @endforeach
                                                            >5</option>
                                                    </x-form.select>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="px-6 py-4 border border-slate-300 font-semibold">
                                                Total Score
                                            </td>
                                            <td class="px-6 py-4 border border-slate-300 font-semibold">
                                            <input id="total_score" name="total_score" type="hidden" />
                                                <span id="total"></span> out of 50
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 border border-slate-300 font-semibold">
                                            <input id="percentage" name="percentage" type="hidden" />
                                                Percentage
                                            </td>
                                            <td class="px-6 py-4 border border-slate-300 font-semibold">
                                               <span id="percentage1" ></span> %
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
                                            <th scope="col" class="px-6 py-3 border border-slate-300">

                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($practical_evaluations && $practical_evaluations->count() > 0)
                                            @foreach ($practical_evaluations as $practical_evaluation)
                                                @if ($loop->index == 0)
                                                    <tr id="row{{ $loop->index }}">
                                                        <td class="px-2 py-2 border border-slate-300">
                                                            <x-form.input id="topic"
                                                                name="practical_evaluation[0][0]" type="text"
                                                                class="block w-full" :value="old('topic', $practical_evaluation->topic)" autofocus
                                                                autocomplete="topic" />
                                                        </td>
                                                        <td class="px-2 py-2 border border-slate-300">
                                                            <x-form.input id="start_date"
                                                                name="practical_evaluation[0][1]" type="date"
                                                                class="block w-full" :value="old(
                                                                    'start_date',
                                                                    $practical_evaluation->start_date,
                                                                )" autofocus
                                                                autocomplete="start_date" />
                                                        </td>
                                                        <td class="px-2 py-2 border border-slate-300">
                                                            <x-form.input id="end_date"
                                                                name="practical_evaluation[0][2]" type="date"
                                                                class="block w-full" :value="old(
                                                                    'end_date',
                                                                    $practical_evaluation->end_date,
                                                                )" autofocus
                                                                autocomplete="end_date" />
                                                        </td>
                                                        <td class="px-2 py-2 border border-slate-300">
                                                            <x-form.input id="employee"
                                                                name="practical_evaluation[0][3]" type="text"
                                                                class="block w-full" :value="old(
                                                                    'employee',
                                                                    $practical_evaluation->employee,
                                                                )" autofocus
                                                                autocomplete="employee" />
                                                        </td>
                                                        <td class="px-2 py-2 border border-slate-300">
                                                            <x-form.input id="department"
                                                                name="practical_evaluation[0][4]" type="text"
                                                                class="block w-full" :value="old(
                                                                    'department',
                                                                    $practical_evaluation->department,
                                                                )" autofocus
                                                                autocomplete="department" />
                                                        </td>
                                                        <td class="px-2 py-2 border border-slate-300">
                                                            <x-form.select id="select" class="block w-full"
                                                                name="practical_evaluation[0][5]">
                                                                <option value=""
                                                                    @if ($practical_evaluation->score === '') selected @endif>
                                                                </option>
                                                                <option value="1"
                                                                    @if ($practical_evaluation->score === 1) selected @endif>1
                                                                </option>
                                                                <option value="2"
                                                                    @if ($practical_evaluation->score === 2) selected @endif>2
                                                                </option>
                                                                <option value="3"
                                                                    @if ($practical_evaluation->score === 3) selected @endif>3
                                                                </option>
                                                                <option value="4"
                                                                    @if ($practical_evaluation->score === 4) selected @endif>
                                                                    4</option>
                                                                <option value="5"
                                                                    @if ($practical_evaluation->score === 5) selected @endif>
                                                                    5</option>
                                                            </x-form.select>
                                                        </td>
                                                        <td class="px-2 py-2 border border-slate-300">
                                                            <x-button variant="success" size="sm" name="add"
                                                                id="add" type="button"
                                                                class="rounded-l-md border-t border-b border-r">
                                                                <x-heroicon-o-plus class="flex-shrink-0 w-6 h-6"
                                                                    aria-hidden="true" />
                                                            </x-button>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr id="row{{ $loop->index }}">
                                                        <td class="px-2 py-2 border border-slate-300">
                                                            <x-form.input id="topic"
                                                                name="practical_evaluation[$loop->index][0]"
                                                                type="text" class="block w-full" :value="old('topic', $practical_evaluation->topic)"
                                                                autofocus autocomplete="topic" />
                                                        </td>
                                                        <td class="px-2 py-2 border border-slate-300">
                                                            <x-form.input id="start_date"
                                                                name="practical_evaluation[$loop->index][1]"
                                                                type="date" class="block w-full" :value="old(
                                                                    'start_date',
                                                                    $practical_evaluation->start_date,
                                                                )"
                                                                autofocus autocomplete="start_date" />
                                                        </td>
                                                        <td class="px-2 py-2 border border-slate-300">
                                                            <x-form.input id="end_date"
                                                                name="practical_evaluation[$loop->index][2]"
                                                                type="date" class="block w-full" :value="old(
                                                                    'end_date',
                                                                    $practical_evaluation->end_date,
                                                                )"
                                                                autofocus autocomplete="end_date" />
                                                        </td>
                                                        <td class="px-2 py-2 border border-slate-300">
                                                            <x-form.input id="employee"
                                                                name="practical_evaluation[$loop->index][3]"
                                                                type="text" class="block w-full" :value="old(
                                                                    'employee',
                                                                    $practical_evaluation->employee,
                                                                )"
                                                                autofocus autocomplete="employee" />
                                                        </td>
                                                        <td class="px-2 py-2 border border-slate-300">
                                                            <x-form.input id="department"
                                                                name="practical_evaluation[$loop->index][4]"
                                                                type="text" class="block w-full" :value="old(
                                                                    'department',
                                                                    $practical_evaluation->department,
                                                                )"
                                                                autofocus autocomplete="department" />
                                                        </td>
                                                        <td class="px-2 py-2 border border-slate-300">

                                                            <x-form.select id="select" class="block w-full"
                                                                name="practical_evaluation[$loop->index][5]">
                                                                <option value=""
                                                                    @if ($practical_evaluation->score === '') selected @endif>
                                                                </option>
                                                                <option value="1"
                                                                    @if ($practical_evaluation->score === 1) selected @endif>
                                                                    1
                                                                </option>
                                                                <option value="2"
                                                                    @if ($practical_evaluation->score === 2) selected @endif>
                                                                    2
                                                                </option>
                                                                <option value="3"
                                                                    @if ($practical_evaluation->score === 3) selected @endif>
                                                                    3
                                                                </option>
                                                                <option value="4"
                                                                    @if ($practical_evaluation->score === 4) selected @endif>
                                                                    4</option>
                                                                <option value="5"
                                                                    @if ($practical_evaluation->score === 5) selected @endif>
                                                                    5</option>
                                                            </x-form.select>
                                                        </td>
                                                        <td class="px-2 py-2 border border-slate-300">
                                                            <x-button variant="danger" onclick="myFunction({{$loop->index}})" size="sm" name="remove"
                                                                id="{{ $loop->index }}" type="button"
                                                                class="rounded-l-md border-t border-b border-r btn_remove">
                                                                <x-heroicon-o-minus class="flex-shrink-0 w-6 h-6"
                                                                    aria-hidden="true" />
                                                            </x-button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @else
                                            <tr id="row0">
                                                <td class="px-2 py-2 border border-slate-300">
                                                    <x-form.input id="topic" name="practical_evaluation[0][0]" type="text"
                                                        class="block w-full" :value="old('topic')" autofocus
                                                        autocomplete="topic" />
                                                </td>
                                                <td class="px-2 py-2 border border-slate-300">
                                                    <x-form.input id="start_date" name="practical_evaluation[0][1]" type="date"
                                                        class="block w-full" :value="old('start_date')" autofocus
                                                        autocomplete="start_date" />
                                                </td>
                                                <td class="px-2 py-2 border border-slate-300">
                                                    <x-form.input id="end_date" name="practical_evaluation[0][2]" type="date"
                                                        class="block w-full" :value="old('end_date')" autofocus
                                                        autocomplete="end_date" />
                                                </td>
                                                <td class="px-2 py-2 border border-slate-300">
                                                    <x-form.input id="employee" name="practical_evaluation[0][3]" type="text"
                                                        class="block w-full" :value="old('employee')" autofocus
                                                        autocomplete="employee" />
                                                </td>
                                                <td class="px-2 py-2 border border-slate-300">
                                                    <x-form.input id="department" name="practical_evaluation[0][4]" type="text"
                                                        class="block w-full" :value="old('department')" autofocus
                                                        autocomplete="department" />
                                                </td>
                                                <td class="px-2 py-2 border border-slate-300">

                                                    <x-form.select id="select" name="practical_evaluation[0][5]" class="block w-full"
                                                        >
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
                                                    <x-button variant="success" size="sm" name="add"
                                                        id="add" type="button"
                                                        class="rounded-l-md border-t border-b border-r">
                                                        <x-heroicon-o-plus class="flex-shrink-0 w-6 h-6"
                                                            aria-hidden="true" />
                                                    </x-button>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="flex flex justify-end sm:flex-col sm:items-end mt-6 gap-4">
                            <x-button type="submit">
                                {{ __('Save') }}
                            </x-button>
                        </div>
                    </form>
                </section>

            </div>


        </div>
    </div>
</x-company-layout>
