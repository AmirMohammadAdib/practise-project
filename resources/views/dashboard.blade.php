<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                <hr>
                @can('user-view-any')
                    <div class="p-6 text-gray-900">
                        <a href="{{ route('user.index') }}">
                            Users
                        </a>
                    </div>
                @endcan
                @can('post-view-any')
                <div class="p-6 text-gray-900">
                    <a href="{{ route('post.index') }}">
                        Posts
                    </a>
                </div>
            @endcan
            </div>
        </div>
    </div>
</x-app-layout>
