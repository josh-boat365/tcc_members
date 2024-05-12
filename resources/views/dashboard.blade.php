<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <button data-modal-target="large-modal" data-modal-toggle="large-modal"
            class="block w-full md:w-auto float-right text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            Add Member
        </button>
    </div>

    <!-- Large Modal -->
    <div id="large-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        Add New Member Info
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="large-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form method="POST" action="{{ route('save-member') }}">
                        @csrf
                        <!-- Frist Name -->
                        <div>
                            <x-input-label for="first_name" :value="__('First Name')" />
                            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                :value="old('first_name')" placeholder="Joshua" required autofocus autocomplete="first_name" />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>

                        <!-- Last Name-->
                        <div class="mt-4">
                            <x-input-label for="last_name" :value="__('Last Name')" />
                            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                :value="old('last_name')" placeholder="Nyarko Boateng" autocomplete="last_name" />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>

                        <!-- Contact 1-->
                        <div class="mt-4">
                            <x-input-label for="contact_1" :value="__('Contact 1')" /> <span class="text-xs">(contact must
                                begin with country code (+233))</span>
                            <x-text-input id="contact_1" class="block mt-1 w-full" type="text" name="contact_1"
                                :value="old('contact_1')" placeholder="+233550746180" autocomplete="contact_1" />
                            <x-input-error :messages="$errors->get('contact_1')" class="mt-2" />
                        </div>

                        <!-- COntact 2-->
                        <div class="mt-4">
                            <x-input-label for="contact_2" :value="__('Contact 2 (Optional)')" />
                            <x-text-input id="contact_2" class="block mt-1 w-full" type="text" name="contact_2"
                                :value="old('contact_2')" placeholder="+233206501108" autocomplete="contact_2" />
                            <x-input-error :messages="$errors->get('contact_2')" class="mt-2" />
                        </div>

                        <!-- Location-->
                        <div class="mt-4">
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location"
                                :value="old('location')" placeholder="Cantoments" autocomplete="location" />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <!-- Department-->
                        <div class="mt-4">
                            <x-input-label for="department" :value="__('Department')" />
                            <x-text-input id="department" class="block mt-1 w-full" type="text" name="department"
                                :value="old('department')" placeholder="Media" autocomplete="department" />
                            <x-input-error :messages="$errors->get('department')" class="mt-2" />
                        </div>

                        <!-- image-->
                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Image')" />
                            <x-text-input id="image" class="block mt-1 w-full" type="file" name="image"
                                :value="old('image')" autocomplete="image" />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-primary-button class="ms-4">
                                {{ __('Save Member') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    {{--  <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">

            </div>
        </div>
    </div>  --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
                    <div
                        class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">

                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="table-search-users"
                                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search for users">
                        </div>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-all-search" type="checkbox"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Member ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Contact
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Location
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Department
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($members as $member)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-table-search-1" type="checkbox"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <th scope="row"
                                        class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        <img class="w-10 h-10 rounded-full"
                                            src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                                        <div class="ps-3">
                                            <div class="text-base font-semibold">{{ $member->first_name }}
                                                {{ $member->last_name ? ', '.$member->last_name : '' }}</div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $member->code ?? '--' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $member->contact_1 ?? '--' }}  {{  $member->contact_2 ? '/'.$member->contact_2 : '' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $member->location ?? '--' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $member->department ?? '--' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <!-- Modal toggle -->
                                        <a href="#" type="button"
                                            data-modal-target="editUserModal_{{ $member->id }}"
                                            data-modal-show="editUserModal_{{ $member->id }}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                            user</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <div>
                                        NO RECORDS FOUND...........
                                    </div>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="p-4">
                        {!! $members->links() !!}
                    </div>
                    <!-- Edit user modal -->
                    @foreach ($members as $member)
                        <div id="editUserModal_{{ $member->id }}" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Edit user
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="editUserModal">
                                            <svg class="w-3 h-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                   <div class="p-4">
                                     <form method="POST" action="{{ route('save-member') }}">
                                        @csrf
                                        <!-- Frist Name -->
                                        <div>
                                            <x-input-label for="first_name" :value="__('First Name')" />
                                            <x-text-input id="first_name" class="block mt-1 w-full" type="text"
                                                name="first_name" :value="old('first_name')" placeholder="Joshua" required
                                                autofocus autocomplete="first_name" />
                                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                        </div>

                                        <!-- Last Name-->
                                        <div class="mt-4">
                                            <x-input-label for="last_name" :value="__('Last Name')" />
                                            <x-text-input id="last_name" class="block mt-1 w-full" type="text"
                                                name="last_name" :value="old('last_name')" placeholder="Nyarko Boateng"
                                                autocomplete="last_name" />
                                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                        </div>

                                        <!-- Contact 1-->
                                        <div class="mt-4">
                                            <x-input-label for="contact_1" :value="__('Contact 1')" /> <span
                                                class="text-xs">(contact must begin with country code (+233))</span>
                                            <x-text-input id="contact_1" class="block mt-1 w-full" type="text"
                                                name="contact_1" :value="old('contact_1')" placeholder="+233550746180"
                                                autocomplete="contact_1" />
                                            <x-input-error :messages="$errors->get('contact_1')" class="mt-2" />
                                        </div>

                                        <!-- COntact 2-->
                                        <div class="mt-4">
                                            <x-input-label for="contact_2" :value="__('Contact 2 (Optional)')" />
                                            <x-text-input id="contact_2" class="block mt-1 w-full" type="text"
                                                name="contact_2" :value="old('contact_2')" placeholder="+233206501108"
                                                autocomplete="contact_2" />
                                            <x-input-error :messages="$errors->get('contact_2')" class="mt-2" />
                                        </div>

                                        <!-- Location-->
                                        <div class="mt-4">
                                            <x-input-label for="location" :value="__('Location')" />
                                            <x-text-input id="location" class="block mt-1 w-full" type="text"
                                                name="location" :value="old('location')" placeholder="Cantoments"
                                                autocomplete="location" />
                                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                                        </div>

                                        <!-- Department-->
                                        <div class="mt-4">
                                            <x-input-label for="department" :value="__('Department')" />
                                            <x-text-input id="department" class="block mt-1 w-full" type="text"
                                                name="department" :value="old('department')" placeholder="Media"
                                                autocomplete="department" />
                                            <x-input-error :messages="$errors->get('department')" class="mt-2" />
                                        </div>

                                        <!-- image-->
                                        <div class="mt-4">
                                            <x-input-label for="image" :value="__('Image')" />
                                            <x-text-input id="image" class="block mt-1 w-full" type="file"
                                                name="image" :value="old('image')" autocomplete="image" />
                                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                        </div>

                                        <div class="flex items-center justify-end mt-4">

                                            <x-primary-button class="ms-4">
                                                {{ __('Save Member') }}
                                            </x-primary-button>
                                        </div>
                                    </form>
                                   </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
