@extends('layouts.main')

@push('page-title')
<title>Edit Investor</title>
@endpush

@push('heading')
{{ 'Edit Investor' }} : {{$investor->first_name}}
@endpush

@section('content')

<x-status-message />

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                
                <form method="post" action="{{ route('investor.update',[$investor->id]) }}">
                    @csrf
                    <h4 class="card-title mb-3">Personal Details</h4>   

                    @if (Auth::user()->role == 'admin')
                    <div class="row">
                        <div class="col-lg-12">
                            <x-form.select name="manager" label="Manager" :options="$managers" :selected="$investor->user->id"/>
                        </div>
                    </div>
                    @endif


                    <div class="row">
                        <div class="col-lg-2">
                            <x-form.select name="title" label="Title" :options="['Mr'=>'Mr','Ms'=>'Ms','Other'=>'Other']" :selected="$investor->title"/>
                        </div>

                        <div class="col-lg-5">
                           <x-form.input name="first_name" label="First Name" :value="$investor->first_name"/>
                        </div>
                        <div class="col-lg-5">
                            <x-form.input name="last_name" label="Last Name" :value="$investor->last_name"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <x-form.input name="phone" label="Phone" :value="$investor->phone"/>
                        </div>
                        <div class="col-lg-6">
                            <x-form.input name="email" label="Email Address" :value="$investor->email"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <x-form.input name="address" label="Address" :value="$investor->address"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                           <x-form.input name="city" label="City" :value="$investor->city"/>
                        </div>
                        <div class="col-lg-4">
                            <x-form.input name="state" label="State" :value="$investor->state"/>    
                        </div>
                        <div class="col-lg-4">
                            <x-form.input name="zip" label="Postal Code / Zip" :value="$investor->zip"/>    
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <x-form.input name="pan" label="PAN Card Number" :value="$investor->pan"/>
                        </div>

                        <div class="col-lg-6">
                            <x-form.input name="adhaar" label="Adhaar Card Number" :value="$investor->adhaar"/>
                        </div>
                    </div>
                    
                    <h4 class="card-title mt-3 mb-3">Bank Details</h4>      

                    <div class="row">
                        <div class="col-lg-6">
                            <x-form.input name="bank_account_holder_name" label="Account Holder Name" :value="$investor->bank_account_holder_name"/>
                        </div>

                        <div class="col-lg-6">
                            <x-form.input name="bank_account_no" label="Account Number" :value="$investor->bank_account_no"/>
                        </div>
                    </div>
                    
                    <div class="row">
                        
                        <div class="col-lg-4">
                           <x-form.input name="bank_account_type" label="Account Type" :value="$investor->bank_account_type"/>
                        </div>


                        <div class="col-lg-4">
                           <x-form.input name="bank_ifsc" label="IFSC Code" :value="$investor->bank_ifsc"/>
                        </div>

                        <div class="col-lg-4">
                           <x-form.input name="bank_name" label="Bank Name" :value="$investor->bank_name"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <x-form.input name="bank_branch_name" label="Branch Name / Branch Address" :value="$investor->bank_branch_name"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <x-form.textarea name="bank_remarks" label="Remarks / Notes" rows="2" :value="$investor->bank_remarks"/>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit">Update Investor</button>
                    </div>
                </form>
           </div>
        </div>
    </div>
</div>

@endsection