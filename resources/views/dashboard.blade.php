<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Dashboard Content -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <!-- Customer Management Section -->
                    <div class="mt-6">

                        <div class="space-y-3">
                            <!-- Create Customer -->
                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                <div>
                                    <h4 class="font-medium text-gray-900">Add New Customer</h4>
                                    <p class="text-sm text-gray-600">Create a new customer record</p>
                                </div>
                                <a href="/customers/create"
                                   class="px-4 py-2 bg-blue-600 text-black text-sm font-medium rounded hover:bg-blue-700">
                                    Create
                                </a>
                            </div>

                            <!-- View All Customers -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <h4 class="font-medium text-gray-900">View Customers</h4>
                                    <p class="text-sm text-gray-600">See all your customers</p>
                                </div>
                                <a href="/customers"
                                   class="px-4 py-2 bg-gray-600 text-black text-sm font-medium rounded hover:bg-gray-700">
                                    View All
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
