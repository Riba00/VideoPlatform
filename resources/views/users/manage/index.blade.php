<x-casteaching-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="flex flex-col mt-10">
        <div class="mx-auto sm:px-6 lg:px-8 w-full max-w-7xl">
            <div class="px-4 sm:px-6 lg:px-8">
                <x-status></x-status>
                @can('users_manage_create')
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="p-4">
                                <div class="md:grid md:grid-cols-3 md:gap-6 bg-white md:bg-transparent">
                                    <div class="md:col-span-1">
                                        <div class="px-4 sm:px-0">
                                            <h3 class="text-lg font-medium leading-6 text-gray-900">Users</h3>
                                            <p class="mt-1 text-sm text-gray-600">Dades de l'usuari</p>
                                        </div>
                                    </div>
                                    <div class="mt-5 md:col-span-2 md:mt-0">
                                        <form data-qa="form_user_create" action="#" method="POST">
                                            @csrf
                                            <div class="shadow sm:overflow-hidden sm:rounded-md">
                                                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                                    <div>
                                                        <label for="name"
                                                               class="block text-sm font-medium text-gray-700">Nom</label>
                                                        <div class="mt-1">
                                                            <input required id="name" name="name" type="text"
                                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                                                   placeholder="Nom">
                                                        </div>
                                                        <p class="mt-2 text-sm text-gray-500">Nom de l'usuari</p>
                                                    </div>
                                                    <div>
                                                        <label for="email"
                                                               class="block text-sm font-medium text-gray-700">Email</label>
                                                        <div class="mt-1">
                                                            <input required id="email" name="email" type="email"
                                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                                                   placeholder="Correu electrònic">
                                                        </div>
                                                        <p class="mt-2 text-sm text-gray-500">Email de l'usuari</p>
                                                    </div>
                                                    <div>
                                                        <label for="password"
                                                               class="block text-sm font-medium text-gray-700">Password</label>
                                                        <div class="mt-1">
                                                            <input required id="password" name="password" type="password"
                                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                                                   placeholder="Constrasenya">
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

                <div class="mt-8 flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">USERS</h3>
                                </div>
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ID</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">NAME</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">EMAIL</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">SUPERADMIN</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                {{ $user->id }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $user->name }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $user->superadmin }}</td>
                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                {{--                                        <a href="/users/{{ $user->id }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Show<span class="sr-only"></span></a>--}}
                                                <a href="#" class="text-green-600 hover:text-indigo-900">Edit<span class="sr-only"></span></a>
                                                <form class="inline" method="POST" action="/manage/users/{{ $user->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" class="text-red-600 hover:text-indigo-900" onclick="event.preventDefault('form'); this.closest('form').submit()">Delete<span class="sr-only"></span></a>
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
            </div>
        </div>
    </div>
</x-casteaching-layout>
