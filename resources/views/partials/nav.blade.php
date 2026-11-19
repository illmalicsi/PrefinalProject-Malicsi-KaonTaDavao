<nav class="bg-orange-600 text-white shadow-md">
    <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">

        <a href="{{ route('home') }}" class="text-xl font-bold">
            Kaon Ta! Davao
        </a>

        <div class="flex flex-wrap items-center gap-5 text-sm font-medium">
            <a href="{{ route('home') }}" class="hover:text-orange-200">
                Home
            </a>

            <a href="{{ route('eateries.index') }}" class="hover:text-orange-200">
                Eateries
            </a>

            <a href="{{ route('districts.index') }}" class="hover:text-orange-200">
                Districts
            </a>

            <a href="{{ route('eateries.create') }}"
                class="rounded-lg bg-white px-4 py-2 text-orange-600 hover:bg-orange-100">
                Add Eatery
            </a>
        </div>

    </div>
</nav>