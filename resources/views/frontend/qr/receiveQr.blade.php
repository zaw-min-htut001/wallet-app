<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My QR') }}
        </h2>
    </x-slot>

    <div class="min-h-screen py-5 mb-8">
        <div class="max-w-4xl lg:mx-auto sm:px-6 lg:px-8 mx-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-start text-base mb-6">{{ $user->name }} - ({{ $user->phone }})</h1>

                    <h1 class="text-center text-xl mb-3">Scan to pay me</h1>

                    <div class="flex justify-center">
                        <div class="">
                            {{ QrCode::size(150)->color(58, 53, 66)->generate($user->phone) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
    $(function() {


    })
</script>
