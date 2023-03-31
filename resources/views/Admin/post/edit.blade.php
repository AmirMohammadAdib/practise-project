<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex justify-between items-center">
                    Welcome to the Posts section
                    <a href="{{ route('post.index') }}">
                        <button type="button" style="background-color: #66d94c; padding: 5px 20px;"
                            class="text-white bg-[#3b5998] hover:bg-[#3b5998]/90 focus:ring-4 focus:outline-none focus:ring-[#3b5998]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 mr-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                class="bi bi-person-add" viewBox="0 0 16 16" style="margin-right: 8px">
                                <path fill-rule="evenodd"
                                    d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                                <path fill-rule="evenodd"
                                    d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                            </svg>
                            go back
                        </button>
                    </a>
                </div>
                <hr>
                <div class="flex flex-col w-full">
                    <form action="{{ route('post.update', [$post]) }}" method="POST" class="p-6">
                        @csrf
                        @method("PUT")
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Title
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="title" type="text" placeholder="Title" name="title"
                                value="{{ $post->title }}"
                                @if ($errors->has('title')) style="border: 1px solid #c42727" @endif>
                            @error('title')
                                <span style="color:#c42727">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                                Body
                            </label>
                            <textarea name="body" @if ($errors->has('body')) style="border: 1px solid #c42727" @endif cols="30" placeholder="Body ... " rows="10" class="hadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $post->body }}</textarea>
                            @error('body')
                                <span style="color:#c42727">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="writer">
                                Writer
                            </label>
                            <select name="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" @if ($errors->has('user_id')) style="border: 1px solid #c42727" @endif >
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if($user->id == $post->user_id) selected @endif>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span style="color:#c42727">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="submit" value="Edit" class="w-full p-5"
                            style="background-color: #60A5FA; font-weight: 800; color: #ffffff; padding: 10px; border-radius: 5px">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
