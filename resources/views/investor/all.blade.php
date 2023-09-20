@extends('layouts.main')

@push('page-title')
<title>All Investors</title>
@endpush

@push('heading')
{{ 'Investors' }}
@endpush

@section('content')
@push('style')
<style>
    .dataTables_filter{
        display: none;
    }
</style>
    
@endpush

<x-status-message />

<div class="row">
    <div class="col-12">
        <div class="card">
            
            <x-search.table-search action="{{ route('investors') }}" method="get" name="search" value="{{isset($_REQUEST['search'])?$_REQUEST['search']:''}}" id="tbl_search" btnClass="search_btn"/>
            <div class="card-body">
                <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>{{ 'Name' }}</th>
                            <th>{{ 'Email' }}</th>
                            <th>{{ 'Phone' }}</th>
                            <th>{{ 'City' }}</th>
                            @if(request()->user()->role == 'admin')
                                <th>{{ 'Manager' }}</th>
                            @endif
                            <th>{{ 'Actions' }}</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($investors as $i)
                        <tr>
                            <td>{{ $i->title }} {{ $i->first_name }} {{ $i->last_name }}</td>
                            <td>{{ $i->email }}</td>
                            <td>{{ $i->phone }}</td>
                            <td>{{ $i->city }}</td>
                            @if(request()->user()->role == 'admin')
                                <td> 
                                @isset($i->user)
                                    {!! $i->user->name !!}
                                @endisset()
                                </td>
                            @endif
                            <td>
                                <div class="action-btns " role="group">
                                    <a href="{{ route('investor.view',['investor'=> $i->id ]) }}" class="btn btn-primary waves-effect waves-light view">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    <a href="{{ route('investor.edit',['investor'=> $i->id ]) }}" class="btn btn-info waves-effect waves-light edit">
                                        <i class="ri-pencil-line"></i>
                                    </a>
                                    @if(request()->user()->role == 'admin')
                                    <a href="{{ route('investor.delete',['investor'=> $i->id ]) }}" class="btn btn-danger waves-effect waves-light del">
                                        <i class="ri-delete-bin-line"></i>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $investors->onEachSide(5)->links() }}
            </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

  

@endsection

