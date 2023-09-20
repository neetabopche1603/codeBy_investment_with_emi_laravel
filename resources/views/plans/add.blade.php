@extends('layouts.main')

@push('page-title')
<title>{{ __('Add New Plan')}}</title>
@endpush

@push('heading')
{{ __('Add New Plan') }}
@endpush

@section('content')

<x-status-message/>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                
                <form method="post" action="{{ route('plan.save') }}">
                    @csrf
                    <h4 class="card-title mb-3">{{__('Plan Details')}}</h4>      
                    
                    <div class="row">
                        <div class="col-lg-6">
                           <x-form.input name="name" label="Plan Name"/>
                        </div>
                        <div class="col-lg-6">
                            <x-form.input name="payment_percent" label="Payout Percentage (Payment per cycle)"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <x-form.input name="first_payment_duration" label="First Payment in (days)"/>
                        </div>

                        <div class="col-lg-6">
                            <x-form.input name="other_payment_duration" label="Other Payments in (days)"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <x-form.input name="total_emi" label="No. of EMIs" />
                        </div>

                        @if (Auth::user()->role == 'admin')
                        <div class="col-lg-6">
                            <x-form.select name="manager" label="Manager" :options="$managers"/>  
                        </div>
                        @endif

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <x-form.textarea name="details" label="Details" />
                        </div>
                    </div>
                    
                    
                    <div>
                        <button class="btn btn-primary" type="submit">{{__('Add Plan')}}</button>
                    </div>
                </form>
           </div>
        </div>
    </div>
</div>

@endsection