<x-admin-layout>
    <h1 class="text-3xl font-medium mt-3 mx-5">Create Admin User</h1>

    <div class="flex items-center justify-center">
        <div class="p-4 mt-5 bg-base-300 rounded-md shadow-md mx-5 max-w-xl w-full">
            <form id="create-form" action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" placeholder="Type here" class="input input-bordered w-full max-w-xl block" />
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="Type here email" class="input input-bordered w-full max-w-xl block" />
                </div>

                <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input id="phone" name="phone" type="number" placeholder="Type here phone" class="input input-bordered w-full max-w-xl block" />
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" placeholder="Type here password" class="input input-bordered w-full max-w-xl block" />
                </div>

                <div class="mb-3 flex justify-between">
                    <button type="button" id="cancel" class="btn">Cancel</button>
                    <button type="submit" class="btn btn-neutral btn-md w-32">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>

<!-- Laravel Javascript Validation -->
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\StoreAdminUserRequest', '#create-form'); !!}

<script type="text/javascript">
    $(function () {


    });
  </script>
