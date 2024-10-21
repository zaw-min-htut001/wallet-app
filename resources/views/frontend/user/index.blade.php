<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User info') }}
        </h2>
    </x-slot>

    <div class="min-h-screen py-5 mb-8">
        <div class="flex justify-center mb-3">
            <img class="w-32 h-w-32 rounded-full" alt="{{ Auth::guard('web')->user()->name }}"
                src="https://ui-avatars.com/api/?name={{ Auth::guard('web')->user()->name }}?background=random" />
        </div>
        <div class="max-w-4xl lg:mx-auto sm:px-6 lg:px-8 mx-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg min-h-80 p-5">
                <div class="p-2 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between">
                        <p>Name :</p>
                        <p>{{ Auth::guard('web')->user()->name }}</p>
                    </div>
                </div>

                <div class="p-2 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between">
                        <p>Phone :</p>
                        <p>{{ Auth::guard('web')->user()->phone }}</p>
                    </div>
                </div>

                <div class="p-2 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between">
                        <p>Email :</p>
                        <p>{{ Auth::guard('web')->user()->email }}</p>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="p-1 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <p>Edit Profile :</p>
                        <div class="flex justify-center items-center bg-base-300 text-black w-12 h-12 rounded-full">
                            <a href="{{ route('profile.edit')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="p-1 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <p>Logout : </p>
                        <div class="flex justify-center items-center bg-red-500 text-white w-12 h-12 rounded-full">
                            <a id='logoutBtn' href="">
                                <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
$(function(){
    // Delete record
    $('#logoutBtn').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Logout?",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Please confrim !"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            url: `/logout`,
                            success: function() {
                                window.location.replace('/');
                            }
                        });
                    }
                });
            });
})
</script>
