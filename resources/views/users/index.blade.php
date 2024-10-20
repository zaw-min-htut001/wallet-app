<x-admin-layout>
    <h1 class="text-3xl font-medium mt-3 mx-5">Users</h1>
    <div class="m-5">
        <a href="{{ route('users.create') }}">
            <button class="btn btn-neutral">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add New User
            </button>
        </a>
    </div>
    <div class="max-w-6xl p-4 mt-5 bg-base-300 rounded-md shadow-md mx-5">
        <table id="example" class="display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Ip</th>
                    <th>User Agent</th>
                    <th>updated_at</th>
                    <th>Last Login</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Ip</th>
                    <th>User Agent</th>
                    <th>updated_at</th>
                    <th>Last Login</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</x-admin-layout>

<script type="text/javascript">
    $(function() {
        var table = $('#example').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            fixedHeader: true,
            mark: true,
            columnDefs: [
                { targets: [3,4,5], searchable: false},
                { targets: [5], visible: false,},
            ],
            order: [[5, 'asec']],
            ajax: "{{ route('users.index') }}",
            columns: [
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'ip',
                    name: 'ip'
                },
                {
                    data: 'user_agent',
                    name: 'user_agent'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'last_login',
                    name: 'last_login'
                },
                {
                    data: 'Actions',
                    name: 'Actions'
                },
            ]
        });
        // Check for session message
        @if (session('created'))
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('created') }}"
            });
        @endif

        @if (session('updated'))
        const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('updated') }}"
            });
        @endif

        // Delete record
        $('#example').on('click', '#deleteItem', function() {
            var user = $(this).data('id');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: `users/${user}`,
                        dataType: 'json',
                        success: function(res) {
                            if (res.success === 1) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        table.ajax.reload();
                                    }
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>
