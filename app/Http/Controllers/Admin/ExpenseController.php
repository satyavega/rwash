<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use PDF;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categories = ExpenseCategory::all();
        $expenses = Expense::all();
        $expenses = Expense::orderBy('created_at', 'asc')->paginate(10);
        $totalPages = ceil($expenses->total() / $expenses->perPage());

        return view('admin.expense',
        compact('expenses',
        'categories',
        'user',
        'totalPages'
        ));
    }
    public function create()
    {
        $user = Auth::user();
        $categories = ExpenseCategory::all();
        $expenses = Expense::all();
        return view('admin.expense_input',
        compact('expenses',
        'categories',
        'user',
        ));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'date' => 'required|date',
            'category_id' => 'required',
            'total_amount' => 'required|numeric',
            'description' => 'nullable',
        ]);

        // Simpan data pengeluaran
        Expense::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.expenses.index')->with('success', 'Pengeluaran berhasil disimpan.');
    }

    public function generatePDF()
    {
        // Ambil data pengeluaran dari database
        $expenses = Expense::all();
        $category = ExpenseCategory::all();
        // Load view laporan PDF
        $pdf = PDF::loadView('admin.expenses_report', compact('expenses', 'category'));

        return $pdf->stream('laporan_pengeluaran.pdf');
    }
}
