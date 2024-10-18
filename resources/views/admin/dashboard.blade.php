<x-admin-layout>
    <div class="navbar bg-base-100">
        <div class="flex-1">
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
        <div class="drawer-content flex flex-col items-start justify-start">
          <!-- Page content here -->
          <label for="my-drawer-2" class="btn btn-circle bg-base-300 drawer-button lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
              </svg>

          </label>
        </div>
        <div class="drawer-side">
          <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
          <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
            <!-- Sidebar content here -->
            <li><a>Dashboard</a></li>
            <li><a>Sidebar Item 2</a></li>
          </ul>
        </div>
    </div>
</x-admin-layout>
