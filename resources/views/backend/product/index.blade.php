<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Product') }}
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            // AJAX DataTable
            var datatable = $('#crudTable').DataTable({
                ajax: {
                    url: '{!! url()->current() !!}',
                },
                columns: [
                    { data: 'category_id', name: 'category_id' },
                    { data: 'category_type_id', name: 'category_type_id' },
                    { data: 'category_detail_id', name: 'category_detail_id' },
                    { data: 'class', name: 'class' },
                    { data: 'price', name: 'price' },
                    { data: 'rc', name: 'rc' },
                    { data: 'value', name: 'value' },
                    { data: 'name', name: 'name' },
                    { data: 'is_sold', name: 'is_sold' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '20%'
                    },
                ],
            });
        </script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="crudTable">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Category Type</th>
                            <th>Category Detail</th>
                            <th>Class</th>
                            <th>Price (Gold)</th>
                            <th>Reseal Count</th>
                            <th>Value</th>
                            <th>Item Name</th>
                            <th>Item Sold</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
