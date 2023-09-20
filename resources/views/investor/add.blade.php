@extends('layouts.main')

@push('page-title')
<title>Add New Investor</title>
@endpush

@push('heading')
{{ 'Add New Investor' }}
@endpush

@section('content')

<x-status-message/>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                
                <form method="post" action="{{ route('investor.save') }}">
                    @csrf
                    <h4 class="card-title mb-3">Personal Details</h4>      
                    
                    @if (Auth::user()->role == 'admin')
                    <div class="row">
                        <div class="col-lg-12">
                            <x-form.select name="manager" label="Manager" :options="$managers"/>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-2">
                            <x-form.select name="title" label="Title" :options="['Mr'=>'Mr','Ms'=>'Ms','Other'=>'Other']" />
                        </div>

                        <div class="col-lg-5">
                           <x-form.input name="first_name" label="First Name"/>
                        </div>
                        <div class="col-lg-5">
                            <x-form.input name="last_name" label="Last Name"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <x-form.input name="phone" label="Phone"/>
                        </div>
                        <div class="col-lg-6">
                            <x-form.input name="email" label="Email Address"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <x-form.input name="address" label="Address" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                           <x-form.input name="city" label="City"/>
                        </div>
                        <div class="col-lg-4">
                            <x-form.input name="state" label="State"/>    
                        </div>
                        <div class="col-lg-4">
                            <x-form.input name="zip" label="Postal Code / Zip"/>    
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <x-form.input name="pan" label="PAN Card Number"/>
                        </div>

                        <div class="col-lg-6">
                            <x-form.input name="adhaar" label="Adhaar Card Number"/>
                        </div>
                    </div>
                    
                    <h4 class="card-title mt-3 mb-3">Bank Details</h4>      

                    <div class="row">
                        <div class="col-lg-6">
                            <x-form.input name="bank_account_holder_name" label="Account Holder Name"/>
                        </div>

                        <div class="col-lg-6">
                            <x-form.input name="bank_account_no" label="Account Number"/>
                        </div>
                    </div>
                    
                    <div class="row">
                        
                        <div class="col-lg-4">
                           <x-form.input name="bank_account_type" label="Account Type"/>
                        </div>


                        <div class="col-lg-4">
                           <x-form.input name="bank_ifsc" label="IFSC Code"/>
                        </div>

                        <div class="col-lg-4">
                           <x-form.input name="bank_name" label="Bank Name"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <x-form.input name="bank_branch_name" label="Branch Name / Branch Address"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <x-form.textarea name="bank_remarks" label="Remarks / Notes" rows="2"/>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit">Add Investor</button>
                    </div>
                </form>
           </div>
        </div>
    </div>
</div>

@endsection