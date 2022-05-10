<x-app-layout>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div class="mt-8 text-2xl">
            Welcome to your Trading House application!
        </div>

        <div class="mt-6 text-gray-500">
            Counting Traffic and more
        </div>
    </div>

    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
        <div class="p-6">
            <div class="flex items-center">
                <i class="fa fa-cubes fa-2xl" aria-hidden="true"></i>
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Total Item Listing</div>
            </div>

            <div class="ml-12">
                <div class="mt-2 text-2xl text-gray-500">
                    {{ $total_products }} Items
                </div>
            </div>
        </div>

        <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
            <div class="flex items-center">
                <i class="fa fa-cubes fa-2xl" aria-hidden="true"></i>
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Total Item Sold</div>
            </div>

            <div class="ml-12">
                <div class="mt-2 text-2xl text-gray-500">
                   {{ $total_products_sold }} Items
                </div>
                </a>
            </div>
        </div>

        <div class="p-6 border-t border-gray-200">
            <div class="flex items-center">
                <i class="fa fa-group fa-2xl" aria-hidden="true"></i>
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Total User</div>
            </div>

            <div class="ml-12">
                <div class="mt-2 text-2xl text-gray-500">
                    {{ $total_user }} User
                </div>
            </div>
        </div>

        <div class="p-6 border-t border-gray-200 md:border-l">
            <div class="flex items-center">
                <i class="fa fa-group fa-2xl" aria-hidden="true"></i>
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Total Product Visitor</div>
            </div>

            <div class="ml-12">
                <div class="mt-2 text-2xl text-gray-500">
                    {{ $total_products_visit }} Visitor
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
