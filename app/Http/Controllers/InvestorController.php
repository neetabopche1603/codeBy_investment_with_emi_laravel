<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Investor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvestorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $investors = Investor::with('user');

        // if (Auth::user()->role == 'admin') {
        if ($query != "") {
            $investors->where(function ($queryBuilder) use ($query) {
                $queryBuilder
                    // ->orWhere([
                    //     ['email', 'LIKE', "%$query%"],
                    //     ['phone', 'LIKE', "%$query%"],
                    //     ['city', 'LIKE', "%$query%"],
                    // ])
                    ->orWhere('email', 'LIKE', "%$query%")
                    ->orWhere('phone', 'LIKE', "%$query%")
                    ->orWhere('city', 'LIKE', "%$query%")

                    ->orWhereHas('user', function ($subQuery) use ($query) {
                        $subQuery->where('name', 'LIKE', "%$query%");
                    })
                    ->orWhereRaw("CONCAT(investors.title, ' ', investors.first_name, ' ', investors.last_name) LIKE ?", ["%$query%"]);
            });
        }
        // }
        if (Auth::user()->role == 'manager') {
            $investors->where('manager', Auth::id());
        }
        $investors = $investors->paginate(10);
        $data = compact('investors');
        return view('investor.all')->with($data);
    }
        

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $managers = optionsHelper(User::where('role','manager')->get()); 
        return view('investor.add')->with(compact('managers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'zip' => 'required|max:10',
            'adhaar' => 'required|max:20',
            'pan' => 'required|max:12',
            'bank_name' => 'required|max:255',
            'bank_account_holder_name' => 'required|max:255',
            'bank_account_no' =>'required',
            'bank_account_type' => 'required',
            'bank_ifsc' =>  'required',
            'bank_branch_name' => 'required'
        ]);
        
        DB::beginTransaction();
        try {
            $data = $request->all();
            if(!isset($data['manager']))
                $data['manager'] = Auth::id();
                
            Investor::create($data);

        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->route('investor.add')->with('status',$e->getMessage());
        }
        
        DB::commit();
        return redirect()->route('investor.add')->with('status',"Investor Created Successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function view(Request $request ,Investor $investor)
    {
        if(Auth::user()->role != 'admin' && Auth::id() != $investor->manager) {
            abort(404);
        }
        $investments = Investment::where('investor_id', $investor->id)->get();
        return view('investor.view')->with(compact('investor','investments'));       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Investor $investor)
    {   
        if(Auth::user()->role != 'admin' && Auth::id() != $investor->manager) {
            abort(404);              
        }
        $managers = optionsHelper(User::where('role','manager')->get()); 
        return view('investor.edit', compact('investor','managers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Investor $investor)
    {
        $request->validate([
            'title' => 'required',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'zip' => 'required|max:10',
            'adhaar' => 'required|max:20',
            'pan' => 'required|max:12',
            'bank_name' => 'required|max:255',
            'bank_account_holder_name' => 'required|max:255',
            'bank_account_no' =>'required',
            'bank_account_type' => 'required',
            'bank_ifsc' =>  'required',
            'bank_branch_name' => 'required'
        ]);

        DB::beginTransaction();
        try{
            $investor->update(
                $request->all()
            );
        }
        catch(\Exception $e){
            return redirect()->back()->with('status',$e->getMessage());
            DB::rollBack();
        }
        DB::commit();
        return redirect()->back()->with('status','Details updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Investor $investor)
    {
        DB::beginTransaction();
        try{
            $investor->delete();

        } catch(\Exception $e){
            return redirect()->route('investor')->with('status',$e->getMessage());
            DB::rollBack();
        }
        DB::commit();
        return redirect()->route('investors')->with('status','Investor deleted successfully!');
    }    

 

}
