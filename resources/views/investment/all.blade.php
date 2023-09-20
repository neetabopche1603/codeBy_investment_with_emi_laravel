@extends('layouts.main')

@push('page-title')
<title>All Investment</title>
@endpush

@push('heading')
{{ 'Investment' }}
@endpush

@section('content')
@push('style')

    
@endpush

<x-status-message />

<div class="row">
    <div class="col-12">
        <div class="card">
            <x-search.table-search action="{{ route('investments') }}" method="get" name="search" value="{{isset($_REQUEST['search'])?$_REQUEST['search']:''}}" 
             btnClass="search_btn"/>
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
                                <div class="action-btns text-center" role="group">
                                    <a href="{{ route('investment.view',['investment'=> $i->id ]) }}" class="btn btn-primary waves-effect waves-light view">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    {{-- <a href="{{ route('investment.edit',['investment'=> $i->id ]) }}" class="btn btn-info waves-effect waves-light edit">
                                        <i class="ri-pencil-line"></i>
                                    </a> --}}
                                    {{-- @if(request()->user()->role == 'admin')
                                    <a href="{{ route('investment.delete',['investor'=> $i->id ]) }}" class="btn btn-danger waves-effect waves-light del">
                                        <i class="ri-delete-bin-line"></i>
                                    </a>
                                    @endif --}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $investments->onEachSide(5)->links() }}
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

  

@endsection


