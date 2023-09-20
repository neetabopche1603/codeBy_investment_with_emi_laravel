@extends('layouts.main')

@push('page-title')
<title>Add New Investment</title>
@endpush

@push('heading')
{{ 'Add New Investment' }}
@endpush

@section('content')

<x-status-message/>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                
                <form method="post" action="{{ route('investment.save') }}">
                    @csrf

                     <h4 class="card-title mb-3">Investment Details</h4>     
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <x-form.select label="Investor" name="investor_id" :options="$investors" />
                            </div>
                        </div>

                        <div class="col-lg-6">
                           <x-form.input name="investment_amount" label="Investment Amount"/>
                        </div>
                    </div>

                    <div class="row">
                       <div class="col-lg-6">
                            <div class="mb-3">
                                <x-form.select label="Investment Plan" name="investment_plan_id" :options="$plans" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <x-form.input name="investment_date" label="Investment Date" type="date" :value="date('Y-m-d')" />
                        </div>
                    </div>

                    @if (admin())
                    <div class="row">
                        <div class="col-lg-12">
                            <x-form.select name="manager_id" label="Manager" :options="$managers" />
                        </div>
                    </div>
                    @else
                        <x-form.input name="manager_id" label="" type="hidden" :value="request()->user()->id" />
                    @endif
                    
                    <div>
                        <button class="btn btn-primary" type="submit">Add Investment</button>
                    </div>
                     
                </form>
           </div>
        </div>
    </div>
</div>

@endsection