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
        :active="Str::startsWith(request()->route()->uri(), 'buttons')"
    >
        <x-slot name="icon">
            <x-heroicon-o-table class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

    @foreach ($students as $student)
        <x-sidebar.sublink
            title="{{ $student->name }}"
            href="{{ route('buttons.text') }}"
            :active="request()->routeIs('buttons.text')"
        />
    @endforeach

    </x-sidebar.dropdown>


    <x-sidebar.dropdown
        title="Attendance"
        :active="Str::startsWith(request()->route()->uri(), 'buttons')"
    >
        <x-slot name="icon">
            <x-heroicon-o-clipboard-check class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>


    @foreach ($students as $student)
        <x-sidebar.sublink
            title="{{ $student->name }}"
            href="{{ route('buttons.text') }}"
            :active="request()->routeIs('buttons.text')"
        />
    @endforeach

    </x-sidebar.dropdown>

        <x-sidebar.dropdown
        title="Evaluation"
        :active="Str::startsWith(request()->route()->uri(), 'buttons')"
    >
        <x-slot name="icon">
            <x-heroicon-o-clipboard-check class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>


    @foreach ($students as $student)
        <x-sidebar.sublink
            title="{{ $student->name }}"
            href="{{ route('buttons.text') }}"
            :active="request()->routeIs('buttons.text')"
        />
    @endforeach

    </x-sidebar.dropdown>



</x-perfect-scrollbar>
