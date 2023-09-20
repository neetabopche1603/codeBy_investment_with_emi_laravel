@extends('layouts.main')

@push('page-title')
<title>{{ "Investor - ". $investor->first_name }}</title>
@endpush

@push('heading')
{{ 'Investor Detail' }}
@endpush

@push('heading-right')
<button onclick="print()" class="flex-end btn btn-primary">PRINT DETAILS</button>    
@endpush

@section('content')

{{-- investor details --}}
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <h5 class="card-header">{{ 'Investor Details' }}</h5>
            <div class="card-body">
                
                <h5 class="card-title">
                    <span>Name :</span> 
                    <span>
                        {{ $investor->title }} {{ $investor->first_name }} {{ $investor->last_name }} 
                    </span>
                </h5>
                <hr>
                <h5 class="card-title">
                    <span>Email :</span>
                    <span>{{ $investor->email }}</span>
                </h5>
                <hr>
                <h5 class="card-title">
                    <span>Phone : </span>
                    <span>{{ $investor->phone }}</span>
                </h5>
                <hr>
                <h5 class="card-title">
                    <span>Address : </span>
                    <span>{{ $investor->address }}</span>
                </h5>
                <hr/>
                <h5 class="card-title">
                    <span>City : </span>
                    <span>{{ $investor->city }}</span>
                </h5>
                <hr/>
                <h5 class="card-title">
                    <span>state : </span>
                    <span>{{ $investor->state }}</span>
                </h5>
                <hr/>
                <h5 class="card-title">
                    <span>Postal Code : </span>
                    <span>{{ $investor->zip }}</span>
                </h5>
                <hr/>
                <h5 class="card-title">
                    <span>Adhaar Number : </span>
                    <span>{{ $investor->adhaar }}</span>
                </h5>
                <hr/>
                <h5 class="card-title">
                    <span>PAN Number : </span>
                    <span>{{ $investor->pan }}</span>
                </h5>
                <hr>
                 @if(request()->user()->role == 'admin')
                    <h5 class="card-title">
                        <span>Manager :</span>
                        @isset($investor->user)
                            <span>{!! $investor->user->name !!}</span>
                        @endisset()
                    </h5>
                @endif
                
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <h5 class="card-header">Bank Details</h5>
            <div class="card-body">    
                <h5 class="card-title">
                    <span>Bank Name :</span> 
                    <span>{{ $investor->bank_name }}</span>
                </h5>
                <hr>
                <h5 class="card-title">
                    <span>Account Holder Name : </span>
                    <span>{{ $investor->bank_account_holder_name }}</span>
                </h5>
                <hr>
                <h5 class="card-title">
                    <span>Account Number : </span>
                    <span>{{ $investor->bank_account_no }}</span>
                </h5>
                <hr>
                <h5 class="card-title">
                    <span>IFSC : </span>
                    <span>{{ $investor->bank_ifsc }}</span>
                </h5>
                <hr>
                <h5 class="card-title">
                    <span>Acccount Type : </span>
                    <span>{{ $investor->bank_account_type }}</span>
                </h5>
                <hr>
                <h5 class="card-title">
                    <span>Branch Name : </span>
                    <span>{{ $investor->bank_branch_name }}</span>
                </h5>
                <hr>
                <h5 class="card-title">
                    <span>Remarks : </span>
                    <span>{{ $investor->bank_remarks }}</span>
                </h5>
                <hr>
            </div>
        </div>
    </div>

</div>

{{-- investment details --}}

<div class="row investment-details">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">{{ __('Investment Details') }} </h5>
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>{{ 'Investor' }}</th>
                            <th>{{ 'Investment' }} {{'( ₹ )'}}</th>
                            <th>{{ 'Investment Plan' }}</th>
                            <th>{{ 'Investment Date' }}</th>
                            @if(request()->user()->role == 'admin')
                                <th>{{ 'Manager' }}</th>
                            @endif
                            <th>{{ 'Actions' }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($investments as $i)
                        <tr>
                            <td>
                                @isset($i->investor)
                                    {{ $i->investor->title }} {{ $i->investor->first_name }} {{ $i->investor->last_name }}
                                @endisset
                                
                            </td>
                            <td>{{ $i->investment_amount }}</td>

                            <td>
                                @isset($i->plan)
                                    {!! $i->plan->name !!}
                                @endisset
                            </td>
                            <td>{{ $i->investment_date }}</td>
                            @if(request()->user()->role == 'admin')
                                <td> 
                                @isset($i->manager)
                                    {!! $i->manager->name !!}
                                @endisset
                                </td>
                            @endif
                            <td>
                                <div class="action-btns " role="group">
                                    <a href="{{ route('investment.view',['investment'=> $i->id ]) }}" class="btn btn-primary waves-effect waves-light view">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    {{-- <a href="{{ route('investment.edit',['investment'=> $i->id ]) }}" class="btn btn-info waves-effect waves-light edit">
                                        <i class="ri-pencil-line"></i>
                                    </a> --}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection