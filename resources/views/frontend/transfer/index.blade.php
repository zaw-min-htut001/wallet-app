<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transfer') }}
        </h2>
    </x-slot>

    <div class="min-h-screen py-5 mb-8">
        <div class="max-w-4xl lg:mx-auto sm:px-6 lg:px-8 mx-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="py-5">
                        <h1>Enter Phone Nummber To Transfer : </h1>
                    </div>

                    <form action="{{ route('transfer.verify') }}" method="POST">
                        @csrf
                        <div class="flex flex-col justify-around items-center gap-3">
                            <input id="phone_number" type="number" placeholder="Please Type Phone Number"
                                class="input input-bordered w-full max-w-xs" />
                            <button id='verifyBtn' type="submit"
                                class="btn btn-neutral lg:btn-wide btn-block">Next</button>
                        </div>
                    </form>

                    <spam class="divider"></spam>
                    <div class="flex justify-between">
                        <p class="font-thin">Available Balance (MMk) </p>
                        <span class="lg:text-xl text-sm">{{ number_format($wallet->amount, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
    $(function() {

        $('#verifyBtn').on('click', function(e) {
            e.preventDefault();

            let phoneNumber = $('#phone_number').val();

            $.ajax({
                type: "POST",
                url: `transfer/verify-number`,
                data: {
                    phone_number: phoneNumber
                },
                success: function(res) {
                    // Step 1: Convert the success object to a JSON string
                    let successData = JSON.stringify(res.success);
                    // Step 2: Base64 encode the JSON string
                    let encodedData = btoa(successData);
                    // Step 3: Redirect with encoded data as part of the URL
                    window.location.href = `/transfer/transfer-to?data=${encodedData}`;
                },
                error: function(xhr, status, error) {
                    let errorMessage = xhr.responseJSON?.fail;
                    Swal.fire({
                        icon: "error",
                        text: errorMessage,
                        confirmButtonText: "Got it",
                    });
                }
            });
        });
    })
</script>
