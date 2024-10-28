<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notification Detail') }}
        </h2>
    </x-slot>

    <div class="min-h-screen py-5 mb-8">
        <div class="max-w-xl lg:mx-auto sm:mx-auto mx-4">
            <div class="bg-white rounded-lg shadow-lg min-h-fit">
                <div class="flex items-center justify-center mb-0 bg-base">
                    <div class="p-3">
                        <h1 class="font-bold text-2xl">{{ $notification->data['title'] }}</h1>
                    </div>
                </div>

                <div class="flex justify-center p-3 items-center">
                    <h1 class="font-medium ">{{ $notification->data['message'] }}</sup></h1>
                </div>
                <div class="flex justify-end p-3">
                    <a class="text-blue-600" href="{{ $notification->data['web_link'] }}">More details</a>
                </div>
                <div>
                    <div class="border-b-2 border-dashed border-base">
                    </div>
                    <div class="p-3">
                        <h1 class="text-center">Thanks for using PayMoney!</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
