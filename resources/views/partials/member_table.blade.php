@forelse ($members as $member)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        <td class="w-4 p-4">
            <div class="flex items-center">
                <input id="checkbox-table-search-1" type="checkbox"
                    class="w-8 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
            </div>
        </td>
        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
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
                <button type="button" data-modal-target="editUserModal_{{ $member->id }}"
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

            {{--  Edit Member Modal  --}}
            <div id="editUserModal_{{ $member->id }}" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Edit user
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="editUserModal_{{ $member->id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4">
                            <form method="POST" action="{{ route('update-member', $member->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="columns-2 gap-8 mt-4 mb-4">
                                    <!-- image-->
                                    <div class="">
                                        <x-input-label for="image" :value="__('Image')" />
                                        <x-text-input id="image-update" class="block mt-1 w-full" type="file"
                                            name="image" value="{{ Storage::url($member->image) }}"
                                            autocomplete="image" />
                                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                    </div>
                                    <div class="card">
                                        <img id="show-image-update" class="h-[5rem] max-w-xs"
                                            src="{{ $member->image ? Storage::url($member->image) : asset('images/user-circle.svg') }}"
                                            alt="image description">
                                    </div>

                                    <script>
                                        document.getElementById('image-update').addEventListener('change', function(event) {
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
                                            name="first_name" value="{{ $member->first_name }}" placeholder="Joshua"
                                            required autofocus autocomplete="first_name" />
                                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                    </div>

                                    <!-- Last Name-->
                                    <div class="">
                                        <x-input-label for="last_name" :value="__('Last Name')" />
                                        <x-text-input id="last_name" class="block mt-1 w-full" type="text"
                                            name="last_name" value="{{ $member->last_name }}"
                                            placeholder="Nyarko Boateng" autocomplete="last_name" />
                                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="columns-2 gap-8 mt-4 mb-4">
                                    <!-- Contact 1-->
                                    <div class="">
                                        <x-input-label for="contact_1" :value="__('Contact 1')" /> <span
                                            class="text-xs">(contact must
                                            begin with country code (+233))</span>
                                        <x-text-input id="contact_1" class="block mt-1 w-full" type="text"
                                            name="contact_1" value="{{ $member->contact_1 }}"
                                            placeholder="+233550746180" autocomplete="contact_1" />
                                        <x-input-error :messages="$errors->get('contact_1')" class="mt-2" />
                                    </div>

                                    <!-- COntact 2-->
                                    <div class="">
                                        <x-input-label for="contact_2" :value="__('Contact 2 (Optional)')" />
                                        <span class="text-xs">(contact must
                                            begin with country code (+233))</span>
                                        <x-text-input id="contact_2" class="block mt-1 w-full" type="text"
                                            name="contact_2" value="{{ $member->contact_2 }}"
                                            placeholder="+233206501108" autocomplete="contact_2" />
                                        <x-input-error :messages="$errors->get('contact_2')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- Location-->
                                <div class="mt-4 mb-4">
                                    <x-input-label for="location" :value="__('Location')" />
                                    <x-text-input id="location" class="block mt-1 w-full" type="text"
                                        name="location" value="{{ $member->location }}" placeholder="Cantoments"
                                        autocomplete="location" />
                                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                                </div>

                                <div class="columns-2 gap-8 mt-4 mb-4">
                                    <!-- Department-->
                                    <div class="">
                                        <x-input-label for="department" :value="__('Department')" />
                                        <x-text-input id="department" class="block mt-1 w-full" type="text"
                                            name="department" value="{{ $member->department }}" placeholder="Media"
                                            autocomplete="department" />
                                        <x-input-error :messages="$errors->get('department')" class="mt-2" />
                                    </div>

                                    <!-- Year Joined-->
                                    <div class="">
                                        <x-input-label for="year_joined" :value="__('Year Joined')" />
                                        <x-text-input id="year_joined" class="block mt-1 w-full" type="date"
                                            name="year_joined" value="{{ $member->year_joined . '-01-01' }}"
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
                                                {{ $member->gender === 'Female' ? 'selected' : '' }}>Female
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
                                                {{ $member->group === 'Abraham' ? 'selected' : '' }}>Abraham
                                            </option>
                                            <option value="Moses" {{ $member->group === 'Moses' ? 'selected' : '' }}>
                                                Moses
                                            </option>
                                            <option value="Joshua"
                                                {{ $member->group === 'Joshua' ? 'selected' : '' }}>Joshua
                                            </option>
                                            <option value="David" {{ $member->group === 'David' ? 'selected' : '' }}>
                                                David
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

        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" class="px-6 py-4 text-gray-500 dark:text-gray-400">NO RECORDS FOUND FOR SEARCH.......</td>
    </tr>
@endforelse
