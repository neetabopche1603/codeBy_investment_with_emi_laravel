@extends('layouts.main')

@push('page-title')
<title>All Managers</title>
@endpush

@push('heading')
{{ 'Managers' }}
@endpush

@section('content')
@push('style')
    
@endpush

<x-status-message />

<div class="row">
    <div class="col-12">
        <div class="card">
            <x-search.table-search action="{{ route('managers') }}" method="get" name="search"  value="{{isset($_REQUEST['search'])?$_REQUEST['search']:''}}"
            btnClass="search_btn"/>
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>{{ 'Name' }}</th>
                            <th>{{ 'Email' }}</th>
                            <th>{{ 'Role' }}</th>
                            <th>{{ 'Actions' }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($managers as $m)
                        <tr>
                            <td>{{ $m->name }}</td>
                            <td>{{ $m->email }}</td>
                            <td>{{ $m->role }}</td>
                            <td>
                                <div class="action-btns text-center" role="group">
                                    <a href="{{ route('manager.edit',['manager'=> $m->id ]) }}" class="btn btn-info waves-effect waves-light edit">
                                        <i class="ri-pencil-line"></i>
                                    </a>
                                    <a href="{{ route('manager.delete',['manager'=> $m->id ]) }}" class="btn btn-danger waves-effect waves-light del">
                                        <i class="ri-delete-bin-line"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $managers->onEachSide(5)->links() }}
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

  

@endsection

@push('script')

@endpush