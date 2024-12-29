<?php

namespace App\Http\Controllers;

use App\Models\LoansModel;
use App\Models\BooksModel; 
use App\Models\MembersModel; 
use Illuminate\Http\Request;

class LoansController extends Controller
{

    public function index(Request $request)
    {
        // Query awal untuk mengambil buku dengan relasi
        $query = LoansModel::with(['member']);

        // Filter berdasarkan member
        if ($request->has('member_id') && $request->member_id) {
            $query->where('member_id', $request->member_id);
        }

        // Ambil data buku berdasarkan filter
        $loans = $query->get();

        // Ambil data members dan categories untuk dropdown filter
        $members = MembersModel::all();

        return view('loans.index', compact('loans', 'members'));
    }
    // public function index()
    // {
    //     $loans = LoansModel::with(['member', 'book'])->get();

    //     return view('loans.index', compact('loans'));
    // }

    public function create()
    {
        $members = MembersModel::all();
        $books = BooksModel::all();

        return view('loans.create', compact('members', 'books'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id', 
            'loan_date' => 'required|date|before_or_equal:due_date',
            'due_date' => 'required|date|after:loan_date', 
        ]);
    
        LoansModel::create([
            'member_id' => $request->input('member_id'),
            'book_id' => $request->input('book_id'),
            'loan_date' => $request->input('loan_date'),
            'due_date' => $request->input('due_date'),
        ]);
    
        return redirect()->route('loans.index')->with('success', 'Loan created successfully.');
    }
}
