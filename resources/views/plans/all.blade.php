@extends('layouts.main')

@push('page-title')
<title>All Plans</title>
@endpush

@push('heading')
{{ 'Plans' }}
@endpush

@section('content')
@push('style')
<style>
    .dataTables_filter{
        display: none;
    }
</style>
    
<x-status-message />

<div class="row">
    <div class="col-12">
        <div class="card">
           <div class="float-right">
            <x-search.table-search action="{{ route('plans') }}" method="get" name="search"  value="{{isset($_REQUEST['search'])?$_REQUEST['search']:''}}"
            btnClass="search_btn"/>
           </div>
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap table-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>{{ 'Plan Name' }}</th>
                            <th>{{ 'payout percentage' }}</th>
                            <th>{{ 'First payment' }}</th>
                            <th>{{ 'Other payments' }}</th>
                            <th>{{ 'Total EMI' }}</th>
                            <th>{{ 'Created by' }}</th>
                            {{--  <th>{{ 'Actions' }}</th>  --}}
                            <th><b>{{ 'Details : ' }}</b></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($plans as $p)
                        <tr>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->payment_percent }}</td>
                            <td>{{ $p->first_payment_duration }}</td>
                            <td>{{ $p->other_payment_duration}}</td>
                            <td>{{ $p->total_emi}}</td>
                            <td>
                                @isset($p->user->name)
                                    {!! $p->user->name !!}
                                @endisset()
                                   
                            </td>
                            {{--  <td>
                                <a href="" class="btn btn-primary btn-small">View</a>
                            </td>  --}}
                            <td>{{ $p->details}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $plans->onEachSide(5)->links() }}
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

  

@endsection
@push('script')
 
@endpush
