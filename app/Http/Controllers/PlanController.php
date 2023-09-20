<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    /**
     * Handle the incoming request.
     */
  
    public function index(Request $request)
    {
        $query = $request->input('search');
    
        $plans = Plan::with('user')
            ->whereHas('user', function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'LIKE', "%$query%");
            })
            ->orWhere(function ($queryBuilder) use ($query) {
                $searchFields = [
                    'name',
                    'payment_percent',
                    'first_payment_duration',
                    'other_payment_duration',
                    'total_emi',
                ];
                foreach ($searchFields as $field) {
                    $queryBuilder->orWhere($field, 'LIKE', "%$query%");
                }
            })
            ->paginate(10);
    
        return view('plans.all')->with(compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $managers = optionsHelper(User::where('role','manager')->get());
        return view('plans.add')->with(compact('managers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'payment_percent' => 'required|max:255|numeric',
    //         'first_payment_duration' => 'required|max:255|numeric',
    //         'other_payment_duration' => 'required|max:255|numeric',
    //         'total_emi' => 'required|max:255|numeric',
    //         'details' => 'required|max:255',
    //     ]);
        
    //     DB::beginTransaction();
    //     try {
    //         $data = $request->all();
          
    //             if (!isset($data['manager'])) {
    //                 $data['manager'] = Auth::id();
    //             }
               
    //         Plan::create($data);

    //     } catch(\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->route('plan.add')->with('status',$e->getMessage());
    //     }
        
    //     DB::commit();
    //     return redirect()->route('plan.add')->with('status',"New Plan Created Successfully!");
    // }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'payment_percent' => 'required|max:255|numeric',
            'first_payment_duration' => 'required|max:255|numeric',
            'other_payment_duration' => 'required|max:255|numeric',
            'total_emi' => 'required|max:255|numeric',
            'details' => 'required|max:255',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->all();
            if (!isset($data['manager']))
                $data['manager'] = Auth::id();
                
            Plan::create($data);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('plan.add')->with('status', $e->getMessage());
        }

        DB::commit();
        return redirect()->route('plan.add')->with('status', "New Plan Created Successfully!");
    }


    /**
     * Display the specified resource.
     */
    // public function view(Request $request ,Investor $investor)
    // {
    //     if(Auth::user()->role != 'admin' && Auth::id() != $investor->manager) {
    //         abort(404);
    //     }
    //     $investments = Investment::where('investor_id', $investor->id)->get();
    //     return view('investor.view')->with(compact('investor','investments'));       
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {   
        if(Auth::user()->role != 'admin' && Auth::id() != $plan->manager) {
            abort(404);              
        }
        return view('plan.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Investor $investor)
    // {
    //     $request->validate([
    //         'title' => 'required',
    //         'first_name' => 'required|max:255',
    //         'last_name' => 'required|max:255',
    //         'email' => 'required|max:255|email',
    //         'phone' => 'required|max:255',
    //         'address' => 'required|max:255',
    //         'city' => 'required|max:255',
    //         'state' => 'required|max:255',
    //         'zip' => 'required|max:10',
    //         'adhaar' => 'required|max:20',
    //         'pan' => 'required|max:12',
    //         'bank_name' => 'required|max:255',
    //         'bank_account_holder_name' => 'required|max:255',
    //         'bank_account_no' =>'required',
    //         'bank_account_type' => 'required',
    //         'bank_ifsc' =>  'required',
    //         'bank_branch_name' => 'required'
    //     ]);

    //     DB::beginTransaction();
    //     try{
    //         $investor->update(
    //             $request->all()
    //         );
    //     }
    //     catch(\Exception $e){
    //         return redirect()->back()->with('status',$e->getMessage());
    //         DB::rollBack();
    //     }
    //     DB::commit();
    //     return redirect()->back()->with('status','Details updated successfully!');
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Investor $investor)
    // {
    //     DB::beginTransaction();
    //     try{
    //         $investor->delete();

    //     } catch(\Exception $e){
    //         return redirect()->route('investor')->with('status',$e->getMessage());
    //         DB::rollBack();
    //     }
    //     DB::commit();
    //     return redirect()->route('investors')->with('status','Investor deleted successfully!');
    // }


    // 

    

}
