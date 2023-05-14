<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>

    <x-sidebar.link
        title="Dashboard"
        href="{{ route('admin.dashboard') }}"
        :isActive="request()->routeIs('admin.dashboard')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.dropdown
        title="Training Plan"
        :active="Str::contains(
        request()
            ->route()
            ->uri(),
        'plan',
    )">
        <x-slot name="icon">
            <x-heroicon-o-table class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

    @foreach ($students as $student)
            <x-sidebar.sublink title="{{ $student->name }}" href="{{ route('admin.plan.index',$student->ID) }}" :active="request()->routeIs('admin.plan.index',$student->ID)" />
    @endforeach

    </x-sidebar.dropdown>


    <x-sidebar.dropdown
        title="Attendance"
        :active="Str::contains(
        request()
            ->route()
            ->uri(),
        'attendance',
    )">
        <x-slot name="icon">
            <x-heroicon-o-clipboard-check class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>


    @foreach ($students as $student)
            <x-sidebar.sublink title="{{ $student->name }}" href="{{ route('admin.attendance.index',$student->ID) }}" :active="request()->routeIs('admin.attendance.index',$student->ID)" />
    @endforeach

    </x-sidebar.dropdown>

    <x-sidebar.link title="Trainees" href="{{ route('admin.trainees.index') }}" :isActive="request()->routeIs('admin.trainees.index')" />
    <x-sidebar.link title="Company Supervisors" href="{{ route('admin.company.index') }}" :isActive="request()->routeIs('admin.company.index')" />
    <x-sidebar.link title="University Supervisors" href="{{ route('admin.university.index') }}" :isActive="request()->routeIs('admin.university.index')" />
    <x-sidebar.link title="HR Admins" href="{{ route('admin.hr.index') }}" :isActive="request()->routeIs('admin.hr.index')" />


</x-perfect-scrollbar>
