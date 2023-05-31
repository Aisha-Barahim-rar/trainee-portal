<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="Dashboard" href="{{ route('university.dashboard') }}" :isActive="request()->routeIs('university.dashboard')">
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
            <x-sidebar.sublink title="{{ $student->name }}" href="{{ route('university.plan.index',$student->ID) }}" :active="request()->routeIs('university.plan.index',$student->ID)" />
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
            <x-sidebar.sublink title="{{ $student->name }}" href="{{ route('university.attendance.index',$student->ID) }}" :active="request()->routeIs('university.attendance.index',$student->ID)" />
        @endforeach

    </x-sidebar.dropdown>

    <x-sidebar.dropdown title="Reports" :active="Str::contains(
        request()
            ->route()
            ->uri(),
        'report',
    )">
        <x-slot name="icon">
            <x-heroicon-o-document-report class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>


        @foreach ($students as $student)
            <x-sidebar.sublink title="{{ $student->name }}" href="{{ route('university.report.index',$student->ID) }}" :active="request()->routeIs('university.report.index',$student->ID)" />
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
            <x-sidebar.sublink title="{{ $student->name }}" href="{{ route('university.links.index',$student->ID) }}" :active="request()->routeIs('university.links.index',$student->ID)" />
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
            <x-sidebar.sublink title="{{ $student->name }}" href="{{ route('university.evaluation.index',$student->ID) }}" :active="request()->routeIs('university.evaluation.index',$student->ID)" />
        @endforeach

    </x-sidebar.dropdown>



</x-perfect-scrollbar>
