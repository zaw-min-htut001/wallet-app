<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- dataTable Style --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/datatables.mark.js/2.0.0/datatables.mark.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.tailwindcss.css">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.bootstrap5.css">

    {{-- dataTable Script --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.tailwindcss.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js),datatables.mark.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="navbar bg-base-100">
            <div class="flex-1">
                <!-- Drawer button (moved next to PayMoney) -->
                <label for="my-drawer-2" class="btn btn-circle bg-base-300 drawer-button lg:hidden ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                    </svg>
                </label>
                <a class="btn btn-ghost text-xl">PayMoney</a>
            </div>
            <div class="flex-none">

                <div class="dropdown dropdown-end">
                    <div class="btn btn-ghost rounded-btn flex flex-col items-start justify-start">
                        <p class="text-base">{{ Auth::guard('admin_user')->user()->name }}</p>
                        <p class="font-light">{{ Auth::guard('admin_user')->user()->phone }}</p>
                    </div>
                </div>

                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full">
                            <img alt="{{ Auth::guard('admin_user')->user()->name }}"
                                src="https://ui-avatars.com/api/?name={{ Auth::guard('admin_user')->user()->name }}?background=random" />
                        </div>
                    </div>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                        <li>
                            <a class="justify-between">
                                Profile
                                <span class="badge">New</span>
                            </a>
                        </li>
                        <li><a>Settings</a></li>
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <a :href="route('admin.logout')"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="drawer lg:drawer-open">
            <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content ">
                {{ $slot }}
            </div>
            <div class="drawer-side" x-data="{ currentRoute: window.location.pathname }">
                <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
                <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4 gap-1">
                    <!-- Sidebar content here -->
                    <li><a :class="currentRoute === '/admin/dashboard' ? 'bg-base-300' : ''"
                            href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a :class="currentRoute === '/admin/user' ? 'bg-base-300' : ''"
                            href="{{ route('user.index') }}">Admin User Management</a></li>
                    <li><a :class="currentRoute === '/admin/users' ? 'bg-base-300' : ''"
                            href="{{ route('users.index') }}">Users Management</a></li>
                    <li><a :class="currentRoute === '/admin/wallets' ? 'bg-base-300' : ''"
                            href="{{ route('wallet.index') }}">Wallets Management</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    $(function() {
        $('#cancel').on('click', function() {
            window.history.back()
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });
</script>

</html>

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
