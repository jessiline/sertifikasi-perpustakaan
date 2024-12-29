@extends('layouts.app')

@section('content')
<div>
    <div class="my-6 flex justify-end">
        <a href="{{ route('books.create') }}"
            class="bg-slate-300 p-2 rounded-md text-sm font-semibold hover:bg-slate-400 ">
            create new book
        </a>
    </div>
    <table class="text-sm table-auto border-collapse border border-gray-300 w-full text-left">
    <thead>
        <tr class="bg-gray-200">
            <th class="border border-gray-300 px-4 py-2">No</th>
            <th class="border border-gray-300 px-4 py-2">Title</th>
            <th class="border border-gray-300 px-4 py-2">Author</th>
            <th class="border border-gray-300 px-4 py-2">Publisher</th>
            <th class="border border-gray-300 px-4 py-2">Published Date</th>
            <th class="border border-gray-300 px-4 py-2">Genre</th>
            <th class="border border-gray-300 px-4 py-2">Number of Pages</th>
            <th class="border border-gray-300 px-4 py-2">Available Copies</th>
            <th class="border border-gray-300 px-4 py-2">Actions</th> 
        </tr>
    </thead>
    <tbody>
        @forelse ($books as $index => $book)
            <tr class="{{ $loop->even ? 'bg-gray-100' : '' }}">
                <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $book->title }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $book->author }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $book->publisher }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $book->published_date }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $book->genre }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $book->number_of_pages }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $book->available_copies }}</td>
                
                <!-- action button -->
                <td class="border-t px-4 py-2 flex space-x-2">
                    <!-- edit button (pencil icon) -->
                    <a href="{{ route('books.edit', $book->id) }}" class="text-blue-500 hover:text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </a>

                    <!-- delete button (X icon) -->
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                            </svg>

                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="border border-gray-300 px-4 py-2 text-center">No books available</td>
            </tr>
        @endforelse
    </tbody>
</table>

</div>

@stop