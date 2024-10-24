<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-9 mx-3">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 mb-7">
                <div class="col-span-2 w-14 h-14 mx-auto">
                    <img src="{{ asset('photos/qr-code-svgrepo-com.svg')}}" alt="" srcset="">
                    <p class="text-center">Receive</p>
                </div>
                <div class="col-span-2 w-14 h-14 mx-auto">
                    <img src="{{ asset('photos/scan-o-svgrepo-com.svg')}}" alt="" srcset="">
                    <p class="text-center">Scan</p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between">
                        <div class="">
                            <p class="font-thin">e-Wallet Balance (MMk) </p>
                        </div>
                        <div class="">
                            <span id="toggleAmount" class="toggle-amount">
                                <!-- Eye Icon (SVG) -->
                                <svg id="showIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                                <!-- Eye Slash Icon (SVG) -->
                                <svg id="hideIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hidden">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <span class="text-2xl font-semibold" id="walletAmount">****</span>

                    <spam class="divider"></spam>

                    <div class="flex justify-between">
                        <p class="font-thin">Total Balance (MMk) </p>
                        <span id="walletAmount1">****</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-4 mb-5 mt-3">
                <div class="mx-auto flex flex-col justify-center items-center">
                    <a href="{{ route('transfer.index') }}">
                        <div class="avatar w-20 h-20">
                            <div class="w-24 rounded-full bg-base-300">
                                <img src="{{ asset('photos/transfer-svgrepo-com.svg')}}" />
                            </div>
                        </div>
                        <p class="text-lg">Transfer</p>
                    </a>
                  </div>
                  <div class="mx-auto flex flex-col justify-center items-center">
                    <div class="avatar w-20 h-20 ">
                        <div class="w-24 rounded-full bg-base-300">
                          <img src="{{ asset('photos/dollar-wallet-money-svgrepo-com.svg')}}" />
                        </div>
                      </div>
                      <p class="text-lg">Wallet</p>
                  </div>
                  <div class="mx-auto flex flex-col justify-center items-center">
                    <div class="avatar w-20 h-20">
                        <div class="w-24 rounded-full bg-base-300">
                          <img src="https://ui-avatars.com/api/?name={{ Auth::guard('web')->user()->name }}?background=random"  />
                        </div>
                      </div>
                      <p class="text-lg">Profile</p>
                  </div>
                  <div class="mx-auto flex flex-col justify-center items-center">
                    <div class="avatar w-20 h-20">
                        <div class="w-24 rounded-full bg-base-300">
                          <img src="{{ asset('photos/website-history-web-svgrepo-com.svg')}}" />
                        </div>
                      </div>
                      <p class="text-lg">History</p>
                  </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Initial amount (this would usually come from your app's data)
    const actualAmount = ({{ $wallet->amount }}).toLocaleString();

    // Get the amount display, the toggle button, and the SVG icons
    const walletAmount = document.getElementById("walletAmount");
    const walletAmount1 = document.getElementById("walletAmount1");
    const toggleAmount = document.getElementById("toggleAmount");
    const showIcon = document.getElementById("showIcon");
    const hideIcon = document.getElementById("hideIcon");

    // Add event listener to the toggle button
    toggleAmount.addEventListener("click", function () {
        // Check if the amount is hidden
        if (walletAmount.textContent === "****" ) {
            // If hidden, show the actual amount
            walletAmount.textContent = actualAmount;
            walletAmount1.textContent = actualAmount;
            // Hide the "show" icon and display the "hide" icon
            showIcon.style.display = "none";
            hideIcon.style.display = "inline";
        } else {
            // If shown, hide the amount
            walletAmount.textContent = "****";
            walletAmount1.textContent = "****";
            // Show the "show" icon and hide the "hide" icon
            showIcon.style.display = "inline";
            hideIcon.style.display = "none";
        }
    });
</script>
