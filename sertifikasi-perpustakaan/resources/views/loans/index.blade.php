@extends('layouts.app')

@section('content')

<div class="flex justify-between mt-6">

    <!-- Filter Form -->
    <form action="{{ route('loans.index') }}" method="GET" class="mb-6 text-sm flex space-x-4">
        <!-- Member Filter -->
        <div>
            <label for="member_id" class="block text-gray-700 font-medium">Filter by Member</label>
            <select name="member_id" id="member_id"
                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">All Members</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}" {{ request('member_id') == $member->id ? 'selected' : '' }}>
                        {{ $member->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filter Button -->
        <div class="flex items-end">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">
                Filter
            </button>
        </div>
    </form>
    
    <div class="my-1">
        <a href="{{ route('loans.create') }}"
            class="bg-slate-300 p-2 rounded-md text-sm font-semibold hover:bg-slate-400">
            Loan a book
        </a>
    </div>

</div>

<!-- Tabel Pinjaman -->
<table class="text-sm table-auto border-collapse border border-gray-300 w-full text-left">
<thead>
        <tr>
            <th class="border border-gray-300 px-4 py-2">Member Name</th>
            <th class="border border-gray-300 px-4 py-2">Book Title</th>
            <th class="border border-gray-300 px-4 py-2">Loan Date</th>
            <th class="border border-gray-300 px-4 py-2">Due Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($loans as $loan)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $loan->member->name }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $loan->book->title }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $loan->loan_date}}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $loan->due_date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@stop
