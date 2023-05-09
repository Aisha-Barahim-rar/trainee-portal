<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>

    <x-sidebar.link
        title="Dashboard"
        href="{{ route('student.dashboard') }}"
        :isActive="request()->routeIs('student.dashboard')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>


    <x-sidebar.link title="Training Plan" href="{{ route('student.plan.index') }}" :isActive="request()->routeIs('student.plan.index')" />

    <x-sidebar.link title="Attendance" href="{{ route('student.attendance.index') }}" :isActive="request()->routeIs('student.attendance.index')" />
    <x-sidebar.link title="Reports" href="#" />
    <x-sidebar.link title="Important Links" href="{{ route('student.links.index') }}" :isActive="request()->routeIs('student.links.index')"  />
  

</x-perfect-scrollbar>
