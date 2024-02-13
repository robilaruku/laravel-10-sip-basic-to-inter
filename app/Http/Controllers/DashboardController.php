<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Transaction::select(DB::raw("MONTHNAME(trx_date) AS month"), DB::raw("COUNT(*) AS total"))
            ->groupBy(DB::raw("MONTH(trx_date)"))
            ->orderByRaw("MONTH(trx_date)")
            ->get();

        $months = [];
        $totals = [];

        foreach ($transactions as $key => $value) {
            $months[] = $value->month;
            $totals[] = $value->total;
        }

        $chart = [
            'months' => $months,
            'totals' => $totals,
        ];

        $trx_all = Transaction::orderBy('updated_at', 'DESC')->limit(10)->get();

        return view('admin.dashboard', compact('chart', 'trx_all'));
    }
}
