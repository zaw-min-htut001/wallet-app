<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comfirm to transfer') }}
        </h2>
    </x-slot>

    <div class="min-h-screen py-5 mb-8">
        <div class="max-w-4xl lg:mx-auto sm:px-6 lg:px-8 mx-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="py-5">
                        <h1 class="text-xl">Transfer to : {{ $to_user->name }}
                            ({{ '****' . substr($to_user->phone, 7) }})</h1>
                    </div>

                    <div class="flex items-center mb-3">
                        <p class="me-3">Amount : </p>
                        <p class="text-xl">{{ $validatedData['amount'] }}</p>
                    </div>

                    <div class="flex items-center justify-start mb-3">
                        <p class="me-3">Note : </p>
                        <p class="text-xl">{{ $validatedData['note'] }}</p>
                    </div>

                    <spam class="divider"></spam>

                    <div class="flex justify-between">
                        <p class="font-thin">Available Balance (MMk) </p>
                        <span class="lg:text-xl text-sm">{{ number_format($wallet->amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-center items-center">
                <button id="verifyBtn" class="btn btn-neutral btn-wide mt-3">Transfer</button>
            </div>

        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
    $(function() {
        $('#verifyBtn').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: "<strong>Enter your password</strong>",
                html: `
                    <input class='input input-bordered w-full max-w-xs text-center' type="password"  id="password">
                `,
            }).then((result) => {
            if (result.isConfirmed) {
                const password = document.getElementById("password").value; // Get the password value
                const amount = @json($validatedData['amount']);
                const note =  @json($validatedData['note']);
                const to_user =  @json($to_user);

                $.ajax({
                type: "POST",
                url: `transfer/comfirm?password=${password}`,
                data: {
                    amount: amount ,
                    note : note,
                    to_user : to_user
                },
                success: function(res) {
                    window.location.href = `/transaction/${res.id}`;
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
            }
            });
         });
    })
</script>
