<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="Dashboard" href="{{ route('company.dashboard') }}" :isActive="request()->routeIs('company.dashboard')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.dropdown title="Training Plan" :active="Str::contains(
        request()
            ->route()
            ->uri(),
        'plan',
    )">
        <x-slot name="icon">
            <x-heroicon-o-table class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        @foreach ($students as $student)
            <x-sidebar.sublink title="{{ $student->name }}" href="{{ route('company.plan.index',$student->ID) }}" :active="request()->routeIs('company.plan.index',$student->ID)" />
        @endforeach

    </x-sidebar.dropdown>


    <x-sidebar.dropdown title="Attendance" :active="Str::contains(
        request()
            ->route()
            ->uri(),
        'attendance',
    )">
        <x-slot name="icon">
            <x-heroicon-o-clipboard-check class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>


        @foreach ($students as $student)
            <x-sidebar.sublink title="{{ $student->name }}" href="{{ route('company.attendance.index',$student->ID) }}" :active="request()->routeIs('company.attendance.index',$student->ID)" />
        @endforeach

    </x-sidebar.dropdown>

    <x-sidebar.dropdown title="Reports" :active="Str::contains(
        request()
            ->route()
            ->uri(),
        'buttons',
    )">
        <x-slot name="icon">
            <x-heroicon-o-document-report class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>


        @foreach ($students as $student)
            <x-sidebar.sublink title="{{ $student->name }}" href="{{ route('company.report.index',$student->ID) }}" :active="request()->routeIs('company.report.index',$student->ID)" />
        @endforeach

    </x-sidebar.dropdown>

        <x-sidebar.dropdown title="Learning Materials" :active="Str::contains(
        request()
            ->route()
            ->uri(),
        'link',
    )">
        <x-slot name="icon">
            <x-heroicon-o-link class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>


        @foreach ($students as $student)
            <x-sidebar.sublink title="{{ $student->name }}" href="{{ route('company.links.index',$student->ID) }}" :active="request()->routeIs('company.links.index',$student->ID)" />
        @endforeach

    </x-sidebar.dropdown>


    <x-sidebar.dropdown title="Evaluation" :active="Str::startsWith(
        request()
            ->route()
            ->uri(),
        'buttons',
    )">
        <x-slot name="icon">
            <x-heroicon-o-clipboard-check class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>


        @foreach ($students as $student)
            <x-sidebar.sublink title="{{ $student->name }}" href="{{ route('company.evaluation.index',$student->ID) }}" :active="request()->routeIs('company.evaluation.index',$student->ID)" />
        @endforeach

    </x-sidebar.dropdown>

        <x-sidebar.dropdown title="HR Evaluation" :active="Str::contains(
        request()
            ->route()
            ->uri(),
        'HREvaluation',
    )">
        <x-slot name="icon">
            <x-heroicon-o-clipboard-check class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>


        @foreach ($students as $student)
            <x-sidebar.sublink title="{{ $student->name }}" href="{{ route('hr.evaluation.index',$student->ID) }}" :active="request()->routeIs('hr.evaluation.index',$student->ID)" />
        @endforeach

    </x-sidebar.dropdown>



</x-perfect-scrollbar>
