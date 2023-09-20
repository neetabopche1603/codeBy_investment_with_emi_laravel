@extends('layouts.main')

@push('page-title')
<title>{{__('Edit Manager')}}</title>
@endpush

@push('heading')
{{ __('Edit Manager') }} : {{ $manager->name }}
@endpush

@section('content')

<x-status-message />

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('manager.update',[$manager->id]) }}">
                    @csrf
                    <h4 class="card-title mb-3">Personal Details</h4>      
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <x-form.input name="name" label="Name" :value="$manager->name"/>
                        </div>
                        <div class="col-lg-6">
                            <x-form.input name="email" label="Email Address" :value="$manager->email"/>
                        </div>
                        <div class="col-lg-6">
                            <x-form.select name="role" label="Role" :options="['admin'=>'Admin', 'manager' => 'Manager']" :selected="$manager->role" />
                        </div>
                    </div>              
                    
                    <div>
                        <button class="btn btn-primary" type="submit">{{__('Update Manager')}}</button>
                    </div>
                </form>
           </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('manager.change-password',[$manager->id]) }}">
                    @csrf
                    <h4 class="card-title mb-3">{{__('Change Password')}}</h4>      
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <x-form.input name="password" label="Password" type="password"/>
                        </div>
                        <div class="col-lg-6">
                            <x-form.input name="password_confirmation" label="Confirm Password" />
                        </div>
                    </div>              
                    
                    <div>
                        <button class="btn btn-primary" type="submit">{{__('Change Password')}}</button>
                    </div>
                </form>
           </div>
        </div>
    </div>
</div>

@endsection