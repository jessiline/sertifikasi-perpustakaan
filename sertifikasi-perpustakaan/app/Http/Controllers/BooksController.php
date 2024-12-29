<?php

namespace App\Http\Controllers;

use App\Models\BooksModel;  
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $books = BooksModel::all();
        return view('books.index', compact('books')); 
    }
    
    public function show($id)
    {
        $book = BooksModel::findOrFail($id);  
        return view('books.show', compact('book'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function searchBooks(Request $request)
    {
        $searchTerm = $request->get('q');
        
        // Cari buku berdasarkan judul
        $books = BooksModel::where('title', 'like', "%{$searchTerm}%")
                        ->get(['id', 'title']); // Ambil id dan title buku yang sesuai dengan pencarian

        return response()->json([
            'books' => $books
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:books,title',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'published_date' => 'required|date',
            'genre' => 'required|string',
            'number_of_pages' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:1',
        ]);

        $genresInput = $request->input('genre');
        $genresArray = array_map('trim', explode(';', $genresInput));
        $uniqueGenres = array_unique($genresArray);

        // Gabungkan kembali menjadi string
        $genresString = implode(';', $uniqueGenres);
        
        $book = BooksModel::create($request->only([
            'title',
            'author',
            'publisher',
            'published_date',
            'number_of_pages',
            'available_copies',
        ]) + ['genre' => $genresString]);
    

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    
    public function edit($id)
    {
        $book = BooksModel::findOrFail($id);

        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'title' => 'required|string|max:255|unique:books,title,' . $id,
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'published_date' => 'required|date',
            'genre' => 'required|string|max:255',
            'number_of_pages' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:1',
        ]);
    
        $book = BooksModel::findOrFail($id);
    
        $genresInput = $request->input('genre');
        $genresArray = array_map('trim', explode(';', $genresInput));
        $uniqueGenres = array_unique($genresArray);
    
        $genresString = implode(';', $uniqueGenres);
    
        $book->update($request->only([
            'title',
            'author',
            'publisher',
            'published_date',
            'number_of_pages',
            'available_copies',
        ]) + ['genre' => $genresString]);
    
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }
  
    public function destroy($id)
    {
        $book = BooksModel::findOrFail($id);

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
