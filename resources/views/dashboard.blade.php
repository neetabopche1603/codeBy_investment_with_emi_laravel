@extends('layouts.main')

@push('page-title')
    <title>{{'Dashboard'}}</title>
@endpush

@push('heading')
    {{ 'Dashboard'}}
@endpush

@section('content')


{{-- quick info --}}
<div class="row">
    <x-design.card heading="Total Investment" value="{{$total['invested']}}" desc="Investment received"/>
    <x-design.card heading="Total Paid" value="{{$total['paid']}}" desc="Returned to Investors"/>
    <x-design.card heading="Total Pending" value="{{$total['pending']}}" color="primary" desc="Remaining amount to pay"/>
    <x-design.card heading="{{date('F')}} Payout" value="{{$total['payment_this_month']}}" color="danger" desc="Remaining Payout"/>
</div>

{{-- upcoming transactions --}}

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                {{-- <div class="dropdown float-end">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                    </div>
                </div> --}}

                <h4 class="card-title mb-4">{{__('Upcoming Transactions')}}</h4>

                <div class="table-responsive">
                    <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>Investor</th>
                                <th>Investment Plan</th>
                                <th>Status</th>
                                <th>Payout Amount</th>
                                <th>Payout date</th>
                                <th style="width: 120px;">Manager</th>
                            </tr>
                        </thead><!-- end thead -->
                        <tbody>
                            @foreach ($upcoming_transactions as $t)
                            <tr>
                                <td>
                                    <h6 class="mb-0">
                                        {{$t->investment->investor->title}}  {{$t->investment->investor->first_name}} {{$t->investment->investor->last_name}}
                                    </h6>
                                </td>
                                <td>{{$t->investment->plan->name}}</td>
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
                                <td>{{$t->payout_amount}}</td>
                                <td>{{$t->payout_date}}</td>
                                <td>{{$t->investment->manager->name}}</td>
                            </tr>
                            @endforeach
                            <!-- end -->
                        </tbody><!-- end tbody -->
                    </table> <!-- end table -->
                </div>
            </div><!-- end card -->
        </div><!-- end card -->
    </div>
    <!-- end col -->
</div>

@endsection