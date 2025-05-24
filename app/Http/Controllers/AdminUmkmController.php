<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UmkmImport;
use Maatwebsite\Excel\Facades\Excel;

class AdminUmkmController extends Controller
{
public function importUmkm(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv',
    ]);

    Excel::import(new UmkmImport, $request->file('file'));

    return back()->with('success', 'Data UMKM berhasil diimpor!');
}
}