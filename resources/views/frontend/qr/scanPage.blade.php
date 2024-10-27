<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Scan QR') }}
        </h2>
    </x-slot>

    <div class="min-h-screen py-5 mb-8">
        <div class="max-w-4xl lg:mx-auto sm:px-6 lg:px-8 mx-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-center items-center mt-3">
                        <img class="w-96 h-64 rounded-lg shadow-lg"
                            src="{{ asset('photos/close-up-hands-holding-smartphone.jpg') }}" alt="">
                    </div>

                    <div class="flex justify-center items-center p-4">
                        <button id='openModalBtn' class="btn  mb-3 btn-neutral btn-wide">Scan</button>
                    </div>

                    <!-- Modal Container (Hidden by Default) -->
                    <div id="myModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900 bg-opacity-50">
                        <div class="flex items-center justify-center min-h-screen px-4">
                            <!-- Modal Content -->
                            <div class="relative bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                                <h2 class="text-xl font-bold text-gray-800 text-center py-3">Scan QR</h2>
                                <div>
                                    <video id="video" style="width: 500px; height: auto;"></video>
                                </div>
                                <!-- Close Button -->
                                <button id="closeModalBtn"
                                    class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                                    &times;
                                </button>

                                <!-- Modal Footer -->
                                <div class="mt-6 text-right">
                                    <button id="closeModalBtn2"
                                        class="px-4 py-2 mr-2 font-semibold text-gray-600 bg-gray-200 rounded hover:bg-gray-300">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h1 class="text-center text-lg">Click buttom, put QR code in the frame and pay</h1>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
