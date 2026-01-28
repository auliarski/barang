<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PembeliDashboardController extends Controller
{
    public function index()
    {
        $pembeli = Auth::guard('pembeli')->user();
        return view('pembeli.dashboard', compact('pembeli'));
    }
}
