@foreach ($notifications as $notification)
    <a href="{{ route('notifications.show' , $notification->id ) }}">
        <div role="alert" class="p-3 rounded-lg shadow-lg {{ $notification->read_at === NULL ?  'bg-slate-400' : ''}}">
            <div class="flex max-w-3xl justify-between">
                <div class="flex items-center justify-start">
                    <div class="me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                    </div>
                    <div class="justify-start">
                        <h3 class="font-bold">{{ $notification->data['title']}}</h3>
                        <div class="text-xs text-start">{{ $notification->data['message']}}</div>
                    </div>
                </div>
                <div class="justify-end">
                    <h3></h3>
                </div>
            </div>
        </div>
    </a>
    <div class="divider"></div>
@endforeach
