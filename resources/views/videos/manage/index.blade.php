<x-casteaching-layout>

    <div class="mt-10 flex flex-col">
        @if(session()->has('status'))
            <div class="rounded-md bg-green-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <!-- Heroicon name: mini/check-circle -->
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('status') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button type="button" class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                                <span class="sr-only">Dismiss</span>
                                <!-- Heroicon name: mini/x-mark -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @can('videos_manage_create')
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="p-4">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Videos</h3>
                                    <p class="mt-1 text-sm text-gray-600">Informacio bàsica del video</p>
                                </div>
                            </div>
                            <div class="mt-5 md:col-span-2 md:mt-0">
                                <form data-qa="form_video_create" action="#" method="POST">
                                    @csrf
                                    <div class="shadow sm:overflow-hidden sm:rounded-md">
                                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                            <div>
                                                <label for="title"
                                                       class="block text-sm font-medium text-gray-700">Title</label>
                                                <div class="mt-1">
                                                    <input required id="title" name="title" type="text"
                                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                                           placeholder="Titol del video">
                                                </div>
                                                <p class="mt-2 text-sm text-gray-500">Titol curt del nostre video</p>
                                            </div>
                                            <div>
                                                <label for="description"
                                                       class="block text-sm font-medium text-gray-700">Description</label>
                                                <div class="mt-1">
                                                    <textarea required id="description" name="description" rows="3"
                                                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                              placeholder="Description"></textarea>
                                                </div>
                                                <p class="mt-2 text-sm text-gray-500">Brief description for your
                                                    profile. URLs
                                                    are hyperlinked.</p>
                                            </div>

                                            <div class="grid grid-cols-3 gap-6">
                                                <div class="col-span-3 sm:col-span-2">
                                                    <label for="url"
                                                           class="block text-sm font-medium text-gray-700">URL</label>
                                                    <div class="mt-1 flex rounded-md shadow-sm">
                                                <span
                                                    class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">http://</span>
                                                        <input required type="url" name="url" id="url"
                                                               class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                               placeholder="www.example.com">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                            <button type="submit"
                                                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                Crear
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endcan
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="mx-3 overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">VIDEOS</h3>
                    </div>
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ID
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">TITLE</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                DESCRIPTION
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">URL</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($videos as $video)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                    {{ $video->id }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $video->title }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $video->description }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $video->url }}</td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="/videos/{{ $video->id }}" target="_blank"
                                       class="text-indigo-600 hover:text-indigo-900">Show<span
                                            class="sr-only"></span></a>
                                    <a href="#" class="text-green-600 hover:text-indigo-900">Edit<span
                                            class="sr-only"></span></a>
                                    <form class="inline" method="POST" action="/manage/videos/{{ $video->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <a href="#" class="text-red-600 hover:text-indigo-900" onclick="event.preventDefault('form');
                                        this.closest('form').submit()">Delete<span
                                                class="sr-only"></span></a>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-casteaching-layout>
