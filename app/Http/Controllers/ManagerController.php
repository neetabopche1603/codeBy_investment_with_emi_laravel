<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Manager;
use Illuminate\Validation\Rules\Password;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $managersQuery = User::where('role', 'manager');
    
        if (!empty($query)) {
            $managersQuery->where(function ($queryBuilder) use ($query) {
                $queryBuilder
                    ->orWhere('name', 'LIKE', "%$query%")
                    ->orWhere('email', 'LIKE', "%$query%")
                    ->orWhere('role', 'LIKE', "%$query%");
            });
        }
        $managers = $managersQuery->paginate(10);
        return view('manager.all', compact('managers'));
    }
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'], 
            // Password::min(8)->letters()->numbers()->symbols()->mixedCase()->uncompromised()
        ]);

        DB::beginTransaction();
        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } 
        catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('status','Something went wrong!');    
        }
        
        DB::commit();
        return redirect()->back()->with('status','Created Successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $manager)
    {
        return view('manager.edit')->with(compact('manager'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $manager)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required','email']
        ]);

        DB::beginTransaction();
        try{
            $manager->update($request->all());
        } 
        catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('status','Something went wrong! Manager cannot be updated!'); 
        }

        DB::commit();
        return redirect()->back()->with('status',$manager->name. ' Updated Successfully!');
    }

    /*
    * change the manager's password from admin 
    */
    public function change_password(Request $request, User $manager) {

        $request->validate([
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $manager->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'Password updated!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $manager)
    {   
        DB::beginTransaction();
        try{
            $manager->delete();
        }
        catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('status','Manager cannot be deleted. Linked with Investors!');
        }
        DB::commit();
        return redirect()->back()->with('status', 'Manager deleted successfully!');
    }

    
}
