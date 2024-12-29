@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-12">
    <h2 class="text-2xl font-semibold text-center mb-6">Add New Loan</h2>

    <form action="{{ route('loans.store') }}" method="POST">
        @csrf

        <!-- Member -->
        <div class="mb-4">
            <label for="member_id" class="block text-gray-700 font-medium">Member</label>
            <select name="member_id" id="member_id" 
                class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required>
                <option value="">Select Member</option>
                @foreach($members as $member)
                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                        {{ $member->name }}
                    </option>
                @endforeach
            </select>
            @error('member_id')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Book -->
        <div class="mb-4">
            <label for="book_id" class="block text-gray-700 font-medium">Book</label>
            <select name="book_id" id="book_id" 
                    class="mt-1 block w-full border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required>
                <option value="">Select Book</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>
            @error('book_id')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>


        <!-- Loan Date -->
        <div class="mb-4">
            <label for="loan_date" class="block text-gray-700 font-medium">Loan Date</label>
            <input type="date" name="loan_date" id="loan_date" value="{{ old('loan_date') }}"
                class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter loan date" required>
            @error('loan_date')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Due Date (Disabled) -->
        <div class="mb-4">
            <label for="due_date" class="block text-gray-700 font-medium">Due Date</label>
            <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}"
                class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                disabled>
            <input type="hidden" name="due_date" id="hidden_due_date" value="{{ old('due_date') }}">
            @error('due_date')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>


        <!-- Submit Button -->
        <div class="mt-6 flex justify-end">
            <button type="submit"
                class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300">
                Create Loan
            </button>
        </div>
    </form>

</div>

<script>
    document.getElementById('loan_date').addEventListener('change', function() {
        var loanDate = new Date(this.value);        
        loanDate.setDate(loanDate.getDate() + 7);
        var dueDate = loanDate.toISOString().split('T')[0];

        document.getElementById('due_date').value = dueDate;
        document.getElementById('hidden_due_date').value = dueDate; 
    });

    $(document).ready(function() {
        $('#book_id').select2({
            placeholder: 'Select a book',
            allowClear: true,
            width: '100%',
            ajax: {
                url: '{{ route('searchBooks') }}',  // This route will handle the search request
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // Search term
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    // You can define the result format and pagination here
                    return {
                        results: data.books.map(function(book) {
                            return {
                                id: book.id,
                                text: book.title
                            };
                        }),
                        pagination: {
                            more: data.pagination
                        }
                    };
                }
            }
        });
    });
</script>


@stop
