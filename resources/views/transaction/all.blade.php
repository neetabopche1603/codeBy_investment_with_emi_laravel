@extends('layouts.main')

@push('page-title')
<title>Transactions</title>
@endpush

@push('heading')
{{ 'Transactions' }}
@endpush

@section('content')

<x-status-message />

<div class="row">
    <div class="col-12">
        <div class="card">
            <x-search.table-search action="{{ route('transactions') }}" method="get" name="search"  value="{{isset($_REQUEST['search'])?$_REQUEST['search']:''}}" 
            btnClass="search_btn"/>
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>{{ 'Investor' }}</th>
                            <th>{{ 'Investment' }} {{'( ₹ )'}}</th>
                            <th>{{ 'Payout Amount' }}{{'( ₹ )'}}</th>
                            <th>{{ 'Payout Date' }}</th>
                            @if(request()->user()->role == 'admin')
                                <th>{{ 'Manager' }}</th>
                            @endif
                            <th>{{ __('Status')}}</th>
                           

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($transactions as $t)
                        <tr>
                            <td>
                                {{$t->investment->investor->title}} {{ $t->investment->investor->first_name}} {{$t->investment->investor->last_name}}
                            </td>

                            <td>{{ $t->investment->investment_amount }}</td>

                            <td>{{ $t->payout_amount }}</td>

                            <td>{{ $t->payout_date }}</td>
                            
                            @if(request()->user()->role == 'admin')
                                <td> 
                                @isset($t->investment->manager)
                                    {!! $t->investment->manager->name !!}
                                @endisset
                                </td>
                            @endif

                            <td>
                                  @if ($t->status == 'paid')
                                    <a class="btn btn-outline-success waves-effect waves-light btn-sm d-block fw-bold" href="{{route('transaction.status',[$t->id])}}">
                                        <i class="ri-checkbox-blank-circle-fill align-middle me-2"></i>
                                @else 
                                    <a class="btn btn-outline-warning waves-effect waves-light btn-sm d-block fw-bold" href="{{route('transaction.status',[$t->id])}}">
                                        <i class="ri-checkbox-blank-circle-fill align-middle me-2 "></i>
                                @endif
                                        {{strtoupper($t->status)}}
                                    </a>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $transactions->onEachSide(5)->links() }}
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

  

@endsection

