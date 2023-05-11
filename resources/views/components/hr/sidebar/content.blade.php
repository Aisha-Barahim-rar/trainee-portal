<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="Dashboard" href="{{ route('hr.dashboard') }}" :isActive="request()->routeIs('hr.dashboard')">
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
            <x-sidebar.sublink title="{{ $student->name }}" href="{{ route('hr.plan.index',$student->ID) }}" :active="request()->routeIs('hr.plan.index',$student->ID)" />
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
            <x-sidebar.sublink title="{{ $student->name }}" href="{{ route('hr.attendance.index',$student->ID) }}" :active="request()->routeIs('hr.attendance.index',$student->ID)" />
        @endforeach

    </x-sidebar.dropdown>

    <x-sidebar.dropdown title="Evaluation" :active="Str::contains(
        request()
            ->route()
            ->uri(),
        'evaluation',
    )">
        <x-slot name="icon">
            <x-heroicon-o-clipboard-check class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>


        @foreach ($students as $student)
            <x-sidebar.sublink title="{{ $student->name }}" href="{{ route('hr.hr-evaluation.index',$student->ID) }}" :active="request()->routeIs('hr.hr-evaluation.index',$student->ID)" />
        @endforeach

    </x-sidebar.dropdown>



</x-perfect-scrollbar>
