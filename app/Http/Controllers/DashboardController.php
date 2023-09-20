<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $investments = Investment::all();
        $total['invested'] = $investments->sum('investment_amount');

        $transactions = Transaction::orderBy('payout_date')->get();
        
        $total['pending'] = $transactions->where('status','pending')->sum('payout_amount');
        $total['paid'] = $transactions->where('status','paid')->sum('payout_amount');
        $total['payment_this_month'] = Transaction::where('status','pending')->whereMonth('payout_date', date('n'))->whereYear('payout_date',date('Y'))->sum('payout_amount');
        
        $upcoming_transactions = $transactions->where('status','pending')->take(5);
        return view('dashboard')->with(compact('upcoming_transactions','total'));
    }
}
