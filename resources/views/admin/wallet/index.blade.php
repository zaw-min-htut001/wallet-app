<x-admin-layout>
    <h1 class="text-3xl font-medium mt-3 mx-5">Wallet</h1>

    <div class="max-w-6xl p-4 mt-5 bg-base-300 rounded-md shadow-md mx-5">
        <table id="example" class="display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Account No</th>
                    <th>User info</th>
                    <th>Amount - MMK</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th>Account No</th>
                    <th>User info</th>
                    <th>Amount - MMK</th>
                    <th>created_at</th>
                    <th>updated_at</th>
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
            order: [[4, 'asec']],
            ajax: "{{ route('wallet.index') }}",
            columns: [
                {
                    data: 'account_number',
                    name: 'account_number'
                },
                {
                    data: 'user_info',
                    name: 'user_info'
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
            ]
        });
    });
</script>
