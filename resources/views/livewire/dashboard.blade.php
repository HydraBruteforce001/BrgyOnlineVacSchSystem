<div>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    @if (isset($isSelected))
        @if ($isSelected == '1')
                @if (auth()->user()->user_type_id == 1)
                    @livewire('admin.dashboard.timeslots', ['aDid' => $appDateId])
                @else
                {{-- for client --}}
                
                @endif  
        @else
            @if (auth()->user()->user_type_id == 1)
                @livewire('admin.dashboard.personal-section')
            @else
                @livewire('client.dashboard.client-personal-section')
            @endif
        @endif
    
    @else
    <div class="min-h-full px-4 py-16 bg-white rounded-lg sm:px-6 sm:py-24 md:grid md:place-items-center lg:px-8">
        <div class="mx-auto max-w-max">
        <main class="sm:flex">
            <p class="text-4xl font-extrabold text-indigo-600 sm:text-5xl">404</p>
            <div class="sm:ml-6">
            <div class="sm:border-l sm:border-gray-200 sm:pl-6">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">Page not found</h1>
                <p class="mt-1 text-base text-gray-500">Please check the URL in the address bar and try again.</p>
            </div>
            <div class="flex mt-10 space-x-3 sm:border-l sm:border-transparent sm:pl-6">
                <a href="/" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"> Go back home </a>
                <a href="/" class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-700 bg-indigo-100 border border-transparent rounded-md hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"> Contact support </a>
            </div>
            </div>
        </main>
        </div>
    </div>
  
    @endif
</div>