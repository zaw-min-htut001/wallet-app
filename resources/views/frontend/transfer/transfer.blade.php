<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transfer to') }}
        </h2>
    </x-slot>

    <div class="min-h-screen py-5 mb-8">
        <div class="max-w-4xl lg:mx-auto sm:px-6 lg:px-8 mx-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="py-5">
                        <h1 class="text-xl">Transfer to : {{ $to_user->name}}
                            ({{ '****' . substr($to_user->phone, 7) }})</h1>
                    </div>

                    <form id="create-form" action="{{ route('transfer.transfer')}}" method="POST">
                        @csrf
                        <div class="flex flex-col justify-around items-center gap-3">
                            <input type="hidden" name="to_user" value="{{ $to_user->id}}">

                            <div class="">
                                <label for="">Amount</label>
                                <input name="amount" id="amount" type="number" placeholder="Please Type Ammount"
                                class="input input-bordered w-full max-w-lg block" />
                            </div>

                            <div class="">
                                <label for="">Note</label>
                                <input name="note" id="note" type="text" placeholder="Please Type notes"
                                class="input input-bordered w-full max-w-lg block" />
                            </div>

                            <button  type="submit"
                                class="btn btn-neutral btn-wide">Next</button>
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

<!-- Laravel Javascript Validation -->
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\StoreTransactionRequest', '#create-form'); !!}

<script type="text/javascript">
    $(function() {

    })
</script>


<style>
    .invalid-feedback {
        color: crimson;
    }

    .is-invalid {
        border-color: crimson;
    }

    .is-valid {
        border-color: rgb(0, 75, 0);
    }
</style>
