@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-12">
    <h2 class="text-2xl font-semibold text-center mb-6">Add new member</h2>

    <form action="{{ route('members.store') }}" method="POST">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter member name" required>
            @error('name')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter email address" required>
            @error('email')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone -->
        <div class="mb-4">
            <label for="phone" class="block text-gray-700 font-medium">Phone</label>
            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter phone number" pattern="\d{10,15}" maxlength="15" title="Phone number must be between 10 and 15 digits" required>
            @error('phone')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>


        <!-- Submit Button -->
        <div class="mt-6 flex justify-end">
            <button type="submit"
                class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300">
                Create Member
            </button>
        </div>
    </form>

</div>

@stop