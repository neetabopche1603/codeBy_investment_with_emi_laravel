<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Investor;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
{
    $query = $request->input('search');
    $dateQuery = date('Y-m-d', strtotime($query));

    $investments = Investment::with('investor', 'manager', 'plan')
        ->whereHas('investor', function ($queryBuilder) use ($query) {
            $queryBuilder->whereRaw("CONCAT(investors.title, ' ', investors.first_name, ' ', investors.last_name) LIKE ?", ["%$query%"]);
        })
        ->orWhere('investment_amount', 'LIKE', "%$query%")
        ->orWhereDate('investment_date', '=', $dateQuery)
        ->orWhereHas('plan', function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'LIKE', "%$query%");
        })
        ->orWhereHas('manager', function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'LIKE', "%$query%");
        })
        ->paginate(10);

    return view('investment.all')->with(compact('investments'));
}
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $investors = optionsHelper( Investor::all(), "id", "title.first_name.last_name");
        $plans = optionsHelper(Plan::all(), $key="id", $value="name");
        $managers = optionsHelper(User::where('role','manager')->get());
        
        return view('investment.add')->with(compact('investors','plans','managers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'investor_id' => 'required',
            'investment_amount' => 'required',
            'investment_plan_id' => 'required',
            'investment_date' => 'required|date|after:yesterday',
        ],[
            'investment_date.after' => "Previous dates not allowed!"
        ]);

        DB::beginTransaction();
        try{
            $investmnt = Investment::create(
                $request->all()
            );
            
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('status',$e->getMessage());    
        }

        $this->createPayoutTransactions($investmnt);
        DB::commit();
       
        return redirect()->back()->with('status','Investment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Investment $investment)
    {
        $transactions = Transaction::where('investment_id', $investment->id )->orderBy('status','asc')->orderBy('payout_date')->get();
        $total =[
            'invested' => $investment->investment_amount,
            'paid' => $transactions->where('status','paid')->sum('payout_amount'),
            'pending' => $transactions->where('status','pending')->sum('payout_amount'),
            'payment_this_month' =>  Transaction::where('status','pending')->whereMonth('payout_date', date('n'))->whereYear('payout_date',date('Y'))->sum('payout_amount'),
        ];

        return view('investment.view')->with(compact('investment','total','transactions'));
    }


    // create all transaction for investment
    protected function createPayoutTransactions($investment) {

        $date = Carbon::parse($investment->investment_date);
        $plan = $investment->plan;
        $payout_date = $date->add($plan->first_payment_duration, 'day');
        $payout_amount = ($investment->investment_amount * $plan->payment_percent) / 100;

        for ($t=0; $t < $plan->total_emi; $t++) { 
            Transaction::create([
                'investment_id' => $investment->id,
                'payout_amount' => $payout_amount,
                'payout_date' => $payout_date,
                'status' => 'pending',
            ]);
            $payout_date->add($plan->other_payment_duration,'day');
        }
            // full amount return after EMI
        Transaction::create([
            'investment_id' => $investment->id,
            'payout_amount' => $investment->investment_amount,
            'payout_date' => $payout_date,
            'status' => 'pending',
        ]);
    }


}