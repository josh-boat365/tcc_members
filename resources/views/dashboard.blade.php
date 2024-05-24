<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Session Status -->
    <div class="max-w-7xl mx-auto sm:px-6">
        {{--  <x-auth-session-status class="mb-4" :status="session('status')" />  --}}
        <x-status-success class="mb-4" :success="session('success')" />
        <x-status-error class="mb-4" :error="session('error')" />
        @foreach ($errors->all() as $error)
            <div id="alert-2"
                class="flex items-center p-4 mt-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ $error }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-2" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endforeach

        @if (session('success'))
            <div id="alert-1"
                class="flex items-center p-4 mt-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                    <a href="{{ route('download.members.pdf') }}">Download PDF</a>
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-1" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
    </div>





    <div class="max-w-[95rem] mx-auto sm:px-6 lg:px-8 mt-6">
        <button data-modal-target="large-modal" data-modal-toggle="large-modal"
            class="flex gap-1 w-full md:w-auto float-right text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            <i class="uil uil-user-plus"></i>
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
                    <form method="POST" action="{{ route('save-member') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="columns-2 gap-8 mt-4 mb-4">
                            <!-- image-->
                            <div class="">
                                <x-input-label for="image" :value="__('Image')" />
                                <x-text-input id="image" class="block mt-1 w-full" type="file" name="image"
                                    :value="old('image')" autocomplete="image" accept=".png, .jpg, .jpeg" />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                            <div class="card">
                                <img id="show-image" class="h-[5rem] max-w-xs"
                                    src="{{ asset('images/user-square.svg') }}" alt="image description">
                            </div>

                            <script>
                                document.getElementById('image').addEventListener('change', function(event) {
                                    const file = event.target.files[0];
                                    const imgElement = document.getElementById('show-image');

                                    if (file) {
                                        const reader = new FileReader();

                                        reader.onload = function(e) {
                                            imgElement.src = e.target.result;
                                        };

                                        reader.readAsDataURL(file);
                                    } else {
                                        imgElement.src = '{{ asset('images/user-square.svg') }}'; // Placeholder image path
                                    }
                                });
                            </script>
                        </div>

                        <div class="columns-2 gap-8 mt-4 mb-4">
                            <!-- Frist Name -->
                            <div>
                                <x-input-label for="first_name" :value="__('First Name')" />
                                <x-text-input id="first_name" class="block mt-1 w-full" type="text"
                                    name="first_name" :value="old('first_name')" placeholder="Joshua" required autofocus
                                    autocomplete="first_name" />
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                            </div>

                            <!-- Last Name-->
                            <div class="">
                                <x-input-label for="last_name" :value="__('Last Name')" />
                                <x-text-input id="last_name" class="block mt-1 w-full" type="text"
                                    name="last_name" :value="old('last_name')" placeholder="Nyarko Boateng"
                                    autocomplete="last_name" />
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                            </div>
                        </div>

                        <div class="columns-2 gap-8 mt-4 mb-4">
                            <!-- Contact 1-->
                            <div class="">
                                <x-input-label for="contact_1" :value="__('Contact 1')" /> <span class="text-xs">(contact
                                    must
                                    begin with country code (+233))</span>
                                <x-text-input id="contact_1" class="block mt-1 w-full" type="text"
                                    name="contact_1" :value="old('contact_1')" placeholder="+233550746180"
                                    autocomplete="contact_1" />
                                <x-input-error :messages="$errors->get('contact_1')" class="mt-2" />
                            </div>

                            <!-- COntact 2-->
                            <div class="">
                                <x-input-label for="contact_2" :value="__('Contact 2 (Optional)')" />
                                <span class="text-xs">(contact must
                                    begin with country code (+233))</span>
                                <x-text-input id="contact_2" class="block mt-1 w-full" type="text"
                                    name="contact_2" :value="old('contact_2')" placeholder="+233206501108"
                                    autocomplete="contact_2" />
                                <x-input-error :messages="$errors->get('contact_2')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Location-->
                        <div class="mt-4 mb-4">
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location"
                                :value="old('location')" placeholder="Cantoments" autocomplete="location" />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <div class="columns-2 gap-8 mt-4 mb-4">
                            <!-- Department-->
                            <div class="">
                                <x-input-label for="department" :value="__('Department')" />
                                <x-text-input id="department" class="block mt-1 w-full" type="text"
                                    name="department" :value="old('department')" placeholder="Media"
                                    autocomplete="department" />
                                <x-input-error :messages="$errors->get('department')" class="mt-2" />
                            </div>

                            <!-- Year Joined-->
                            <div class="">
                                <x-input-label for="year_joined" :value="__('Year Joined')" />
                                <x-text-input id="year_joined" class="block mt-1 w-full" type="date"
                                    name="year_joined" :value="old('year_joined')" min="2014-01-01"
                                    autocomplete="year_joined" />
                                <x-input-error :messages="$errors->get('year_joined')" class="mt-2" />
                            </div>
                        </div>
                        <div class="columns-2 gap-8 mt-4 mb-4">
                            <!-- Gender-->
                            <div class="">
                                <x-input-label for="gender" :value="__('Gender')" />
                                <select name="gender"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>

                            <!-- Gender-->
                            <div class="">
                                <x-input-label for="group" :value="__('Group')" />
                                <select name="group"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    id="group">
                                    <option value="">Select Bible Studies Group</option>
                                    <option value="Abraham" {{ old('group') === 'Abraham' ? 'selected' : '' }}>Abraham
                                    </option>
                                    <option value="Moses" {{ old('group') === 'Moses' ? 'selected' : '' }}>Moses
                                    </option>
                                    <option value="Joshua" {{ old('group') === 'Joshua' ? 'selected' : '' }}>Joshua
                                    </option>
                                    <option value="David" {{ old('group') === 'David' ? 'selected' : '' }}>David
                                    </option>
                                </select>
                                <x-input-error :messages="$errors->get('group')" class="mt-2" />
                            </div>
                        </div>



                        <div class="flex items-center justify-end mt-4">

                            <x-success-button class="ms-4">
                                {{ __('Save Member') }}
                            </x-success-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-[95rem] mx-auto sm:px-6 lg:px-8 mt-5">
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
                            <form action="{{ route('search-members') }}">
                                @csrf
                                <input type="text" id="table-search-members"
                                    class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    name="search-members" placeholder="Search for members">
                            </form>
                        </div>
                        <div>
                            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                                class="gap-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button"><i class="uil uil-file-export"></i> Export Data <svg
                                    class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdown"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownDefaultButton">
                                    <li>
                                        <a href="{{ route('export-pdf') }}" 
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">PDF</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Excel</a>
                                    </li>
                                </ul>
                            </div>

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
                                    Gender
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
                                    Group
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Year Joined
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody id="member-table-body">
                            @forelse ($members as $member)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-table-search-1" type="checkbox"
                                                class="w-8 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <th scope="row"
                                        class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        <img class="w-10 h-10 rounded-full"
                                            src="{{ $member->image ? Storage::url($member->image) : asset('images/user-circle.svg') }}"
                                            alt="{{ $member->first_name }} image">
                                        <div class="ps-3">
                                            <div class="text-base font-semibold">{{ $member->first_name }}
                                                {{ $member->last_name ? ', ' . $member->last_name : '' }}</div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $member->code ?? '--' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $member->gender ?? '--' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $member->contact_1 ?? '--' }}
                                        {{ $member->contact_2 ? '/' . $member->contact_2 : '' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $member->location ?? '--' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $member->department ?? '--' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $member->group ?? '--' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $member->year_joined ?? '--' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <!-- Modal toggle -->

                                        <div class="flex gap-1">
                                            <button type="button"
                                                data-modal-target="editUserModal_{{ $member->id }}"
                                                data-modal-show="editUserModal_{{ $member->id }}"
                                                class="flex gap-1 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                <i class="uil uil-edit-alt"></i>
                                                edit
                                            </button>
                                            <form action="{{ route('delete-member', $member->id) }}">
                                                @csrf
                                                <button type="submit"
                                                    class="flex gap-1 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                    <i class="uil uil-trash-alt"></i>
                                                    delete
                                                </button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-gray-500 dark:text-gray-400">No records
                                        found...</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="p-4">
                        {!! $members->links() !!}
                    </div>
                    <!-- Add jQuery library -->
                    <script src="{{ asset('js/ajax.jquery.min.js') }}"></script>
                    <script>
                        $(document).ready(function() {
                            $('#table-search-members').keyup(function() {
                                var searchValue = $(this).val();

                                $.ajax({
                                    url: "{{ route('search-members') }}",
                                    method: 'GET',
                                    data: {
                                        'search-members': searchValue
                                    },
                                    success: function(response) {
                                        $('#member-table-body').html(response);
                                    }
                                });
                            });
                        });
                    </script>
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
                                            data-modal-hide="editUserModal_{{ $member->id }}">
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
                                    <div class="p-4 md:p-5 space-y-4">
                                        <form method="GET" action="{{ route('update-member', $member->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="columns-2 gap-8 mt-4 mb-4">
                                                <!-- image-->
                                                <div class="">
                                                    <x-input-label for="image" :value="__('Image')" />
                                                    <x-text-input id="image2" class="block mt-1 w-full"
                                                        type="file" name="image-update"
                                                        accept=".png, .jpg, .jpeg" />
                                                    <x-input-error :messages="$errors->get('image-update')" class="mt-2" />
                                                </div>
                                                <div class="card">
                                                    <img id="show-image2" class="h-[5rem] max-w-xs"
                                                        src="{{ $member->image ? Storage::url($member->image) : asset('images/user-circle.svg') }}"
                                                        alt="image description">
                                                </div>

                                                <script>
                                                    document.getElementById('image2').addEventListener('change', function(event) {
                                                        const file = event.target.files[0];
                                                        const imgElement = document.getElementById('show-image2');

                                                        if (file) {
                                                            const reader = new FileReader();

                                                            reader.onload = function(e) {
                                                                imgElement.src = e.target.result;
                                                            };

                                                            reader.readAsDataURL(file);
                                                        } else {
                                                            imgElement.src = '{{ asset('images/user-circle.svg') }}'; // Placeholder image path
                                                        }
                                                    });
                                                </script>
                                            </div>

                                            <div class="columns-2 gap-8 mt-4 mb-4">
                                                <!-- Frist Name -->
                                                <div>
                                                    <x-input-label for="first_name" :value="__('First Name')" />
                                                    <x-text-input id="first_name" class="block mt-1 w-full"
                                                        type="text" name="first_name"
                                                        value="{{ $member->first_name }}" placeholder="Joshua"
                                                        required autofocus autocomplete="first_name" />
                                                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                                </div>

                                                <!-- Last Name-->
                                                <div class="">
                                                    <x-input-label for="last_name" :value="__('Last Name')" />
                                                    <x-text-input id="last_name" class="block mt-1 w-full"
                                                        type="text" name="last_name"
                                                        value="{{ $member->last_name }}" placeholder="Nyarko Boateng"
                                                        autocomplete="last_name" />
                                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                                </div>
                                            </div>

                                            <div class="columns-2 gap-8 mt-4 mb-4">
                                                <!-- Contact 1-->
                                                <div class="">
                                                    <x-input-label for="contact_1" :value="__('Contact 1')" /> <span
                                                        class="text-xs">(contact must
                                                        begin with country code (+233))</span>
                                                    <x-text-input id="contact_1" class="block mt-1 w-full"
                                                        type="text" name="contact_1"
                                                        value="{{ $member->contact_1 }}" placeholder="+233550746180"
                                                        autocomplete="contact_1" />
                                                    <x-input-error :messages="$errors->get('contact_1')" class="mt-2" />
                                                </div>

                                                <!-- COntact 2-->
                                                <div class="">
                                                    <x-input-label for="contact_2" :value="__('Contact 2 (Optional)')" />
                                                    <span class="text-xs">(contact must
                                                        begin with country code (+233))</span>
                                                    <x-text-input id="contact_2" class="block mt-1 w-full"
                                                        type="text" name="contact_2"
                                                        value="{{ $member->contact_2 }}" placeholder="+233206501108"
                                                        autocomplete="contact_2" />
                                                    <x-input-error :messages="$errors->get('contact_2')" class="mt-2" />
                                                </div>
                                            </div>

                                            <!-- Location-->
                                            <div class="mt-4 mb-4">
                                                <x-input-label for="location" :value="__('Location')" />
                                                <x-text-input id="location" class="block mt-1 w-full" type="text"
                                                    name="location" value="{{ $member->location }}"
                                                    placeholder="Cantoments" autocomplete="location" />
                                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                                            </div>

                                            <div class="columns-2 gap-8 mt-4 mb-4">
                                                <!-- Department-->
                                                <div class="">
                                                    <x-input-label for="department" :value="__('Department')" />
                                                    <x-text-input id="department" class="block mt-1 w-full"
                                                        type="text" name="department"
                                                        value="{{ $member->department }}" placeholder="Media"
                                                        autocomplete="department" />
                                                    <x-input-error :messages="$errors->get('department')" class="mt-2" />
                                                </div>

                                                <!-- Year Joined-->
                                                <div class="">
                                                    <x-input-label for="year_joined" :value="__('Year Joined')" />
                                                    <x-text-input id="year_joined" class="block mt-1 w-full"
                                                        type="date" name="year_joined"
                                                        value="{{ $member->year_joined . '-01-01' }}"
                                                        min="2014-01-01" autocomplete="year_joined" />
                                                    <x-input-error :messages="$errors->get('year_joined')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="columns-2 gap-8 mt-4 mb-4">
                                                <!-- Gender-->
                                                <div class="">
                                                    <x-input-label for="gender" :value="__('Gender')" />
                                                    <select name="gender"
                                                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                        id="gender">
                                                        <option value="">Select Gender</option>
                                                        <option value="Male"
                                                            {{ $member->gender === 'Male' ? 'selected' : '' }}>Male
                                                        </option>
                                                        <option value="Female"
                                                            {{ $member->gender === 'Female' ? 'selected' : '' }}>
                                                            Female
                                                        </option>
                                                    </select>
                                                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                                </div>

                                                <!-- Gender-->
                                                <div class="">
                                                    <x-input-label for="group" :value="__('Group')" />
                                                    <select name="group"
                                                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                        id="group">
                                                        <option value="">Select Bible Studies Group</option>
                                                        <option value="Abraham"
                                                            {{ $member->group === 'Abraham' ? 'selected' : '' }}>
                                                            Abraham
                                                        </option>
                                                        <option value="Moses"
                                                            {{ $member->group === 'Moses' ? 'selected' : '' }}>Moses
                                                        </option>
                                                        <option value="Joshua"
                                                            {{ $member->group === 'Joshua' ? 'selected' : '' }}>Joshua
                                                        </option>
                                                        <option value="David"
                                                            {{ $member->group === 'David' ? 'selected' : '' }}>David
                                                        </option>
                                                    </select>
                                                    <x-input-error :messages="$errors->get('group')" class="mt-2" />
                                                </div>
                                            </div>



                                            <div class="flex items-center justify-end mt-4">

                                                <x-success-button class="ms-4">
                                                    {{ __('Update Member Details') }}
                                                </x-success-button>
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
