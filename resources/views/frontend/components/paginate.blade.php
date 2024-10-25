@foreach ($transactions as $transaction)
    <a href="{{ route('transaction.show' , $transaction->id ) }}">
        <div role="alert" class="p-3 rounded-lg shadow-lg">
            <div class="flex max-w-3xl justify-between">
                <div class="flex items-center justify-start">
                    <div class="me-2">
                        <svg class="{{ $transaction->type === 1 ? 'stroke-success' : 'stroke-error' }}  h-6 w-6 shrink-0"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div class="justify-start">
                        <h3 class="font-bold">Transfer {{ $transaction->type === 1 ? 'from' : 'to' }}
                            {{ $transaction->user->name }}</h3>
                        <div class="text-xs text-start">{{ $transaction->created_at }}</div>
                    </div>
                </div>
                <div class="justify-end">
                    <h3> {{ $transaction->type === 1 ? '+' : '-' }} {{ $transaction->amount }} MMK</h3>
                </div>
            </div>
        </div>
    </a>
    <div class="divider"></div>
@endforeach
