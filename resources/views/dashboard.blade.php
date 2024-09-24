<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($user->role === 'Administrator')
                        <div class="container mx-auto p-5">
                            <h1 class="text-2xl font-bold mb-4">Companies</h1>
                            <table class="min-w-full bg-black shadow-md rounded-lg overflow-hidden">
                                <thead>
                                    <tr class="bg-gray-800 text-white">
                                        <th class="py-3 px-4 text-left">ID</th>
                                        <th class="py-3 px-4 text-left">Name</th>
                                        <th class="py-3 px-4 text-left">Email</th>
                                        <th class="py-3 px-4 text-left">Logo</th>
                                        <th class="py-3 px-4 text-left">Website</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($companies as $company)
                                        <tr class="hover:bg-gray-600">
                                            <td class="py-3 px-4">{{ $company->id }}</td>
                                            <td class="py-3 px-4">{{ $company->name }}</td>
                                            <td class="py-3 px-4">{{ $company->email }}</td>
                                            <td class="py-3 px-4">
                                                @if ($company->logo)
                                                    <img src="{{ asset($company->logo) }}" alt="{{ $company->name }} Logo" class="w-12 h-12">
                                                @else
                                                    No Logo
                                                @endif
                                            </td>
                                            <td class="py-3 px-4">{{ $company->website }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <h1 class="text-2xl font-bold mt-8 mb-4">Employees</h1>
                            <table class="min-w-full bg-black shadow-md rounded-lg overflow-hidden">
                                <thead>
                                    <tr class="bg-gray-800 text-white">
                                        <th class="py-3 px-4 text-left">ID</th>
                                        <th class="py-3 px-4 text-left">Name</th>
                                        <th class="py-3 px-4 text-left">Email</th>
                                        <th class="py-3 px-4 text-left">Phone</th>
                                        <th class="py-3 px-4 text-left">Profile</th>
                                        <th class="py-3 px-4 text-left">Company</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr class="hover:bg-gray-600">
                                            <td class="py-3 px-4">{{ $employee->id }}</td>
                                            <td class="py-3 px-4">{{ $employee->name }}</td>
                                            <td class="py-3 px-4">{{ $employee->email }}</td>
                                            <td class="py-3 px-4">{{ $employee->phone }}</td>
                                            <td class="py-3 px-4">
                                                @if ($employee->profile)
                                                    <img src="{{ asset($employee->profile) }}" alt="{{ $employee->name }} Profile" class="w-12 h-12">
                                                @else
                                                    No Profile
                                                @endif
                                            </td>
                                            <td class="py-3 px-4">{{ $employee->company->name ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        {{ __("You're logged in!") }}
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
