<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {

    //     $query = $request->input('search');
    //     $dateQuery = date('Y-m-d', strtotime($query));
    //     if ($query != "") {
    //         $transactions = Transaction::select(
    //             'transactions.id',
    //             'transactions.investment_id',
    //             'transactions.payout_amount',
    //             'transactions.payout_date',
    //             'transactions.status',
    //             'investors.title',
    //             'investors.first_name',
    //             'investors.last_name',
    //             // 'investors.manager',
    //             'users.name as manager_name',

    //         )
    //             ->where(function ($queryBuilder) use ($query, $dateQuery) {
    //                 $queryBuilder
    //                     ->orWhere('transactions.payout_amount', 'LIKE', "%$query%")
    //                     ->orWhereDate('transactions.payout_date', '=', $dateQuery)
    //                     ->orWhere('users.name', 'LIKE', "%$query%")
    //                     ->orWhereRaw("CONCAT(investors.title, ' ', investors.first_name, ' ', investors.last_name) LIKE ?", ["%$query%"]);
    //             })
    //             ->join('investments', 'transactions.investment_id', '=', 'investments.id')
    //             ->join('users', 'investments.manager_id', '=', 'users.id')
    //             ->join('investors', 'investments.investor_id', '=', 'investors.id')
    //             ->paginate(10)->withQueryString();
    //     } else {
    //     $transactions = Transaction::paginate(10)->withQueryString();
    //     }
    //     return view('transaction.all')->with(compact('transactions'));
    // }

    public function index(Request $request)
    {
        $query = $request->input('search');
        $dateQuery = date('Y-m-d', strtotime($query));
        if ($query != "") {
            $transactions = Transaction::where(function ($queryBuilder) use ($query, $dateQuery) {
                    $queryBuilder
                        ->orWhere('transactions.payout_amount', 'LIKE', "%$query%")
                        ->orWhereDate('transactions.payout_date', '=', $dateQuery)
                        ->orWhere('users.name', 'LIKE', "%$query%")
                        ->orWhereRaw("CONCAT(investors.title, ' ', investors.first_name, ' ', investors.last_name) LIKE ?", ["%$query%"]);
                })
                ->join('investments', 'transactions.investment_id', '=', 'investments.id')
                ->join('users', 'investments.manager_id', '=', 'users.id')
                ->join('investors', 'investments.investor_id', '=', 'investors.id')
                ->paginate(10)->withQueryString();
        } else {
        $transactions = Transaction::paginate(10)->withQueryString();
        }
        return view('transaction.all')->with(compact('transactions'));
    }


    public function status(Transaction $transaction) {
        $status = ($transaction->status == 'pending') ?  'paid' : 'pending';
        $transaction->update([
            'status'=>  $status
        ]);    

        return redirect()->back()->with('status','Transaction status updated!');
    }

}
