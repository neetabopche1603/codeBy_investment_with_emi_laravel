@extends('layouts.main')

@push('page-title')
<title>{{ __('Add New Manager')}}</title>
@endpush

@push('heading')
{{ __('Add New Manager') }}
@endpush

@section('content')

<x-status-message/>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                
                <form method="post" action="{{ route('manager.save') }}">
                    @csrf
                    <h4 class="card-title mb-3">{{__('Personal Details')}}</h4>      
                    
                    <div class="row">
                        <div class="col-lg-6">
                           <x-form.input name="name" label="Full Name"/>
                        </div>
                        <div class="col-lg-6">
                            <x-form.input name="email" label="Email Address"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <x-form.input name="password" label="Passsword" type="password"/>
                        </div>

                        <div class="col-lg-6">
                            <x-form.input name="password_confirmation" label="Confirm Password" type="password"/>
                        </div>
                    </div>
                    
                    <div>
                        <button class="btn btn-primary" type="submit">{{__('Add Manager')}}</button>
                    </div>
                </form>
           </div>
        </div>
    </div>
</div>

@endsection