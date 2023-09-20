@extends('layouts.main')

@push('page-title')
    <title>{{'Investments'}}</title>
@endpush

@push('heading')
    <span class="text-dark border-bottom border-success">{{$investment->investor->first_name}} {{$investment->investor->last_name}}</span> {{ 'Investment for '}} <span class="text-dark border-bottom border-success">{{$investment->plan->name}}</span> {{'plan'}}
@endpush

@section('content')

{{-- quick info --}}
<div class="row">
    <x-design.card heading="Invested Amount" value="{{$total['invested']}}" desc="Investment received"/>
    <x-design.card heading="Paid" value="{{$total['paid']}}" desc="Returned to Investors"/>
    <x-design.card heading="Pending" value="{{$total['pending']}}" color="primary" desc="Remaining amount to pay"/>
    <x-design.card heading="{{date('F')}} Payout" value="{{$total['payment_this_month']}}" color="danger" desc="Remaining Payout"/>
</div>

{{-- upcoming transactions --}}

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-4 justify-content-between d-flex">
                    <h4 class="">{{__('Upcoming Transactions')}}</h4>
                    <button class="btn btn-primary" onclick="print()">PRINT</button>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>Investor</th>
                                <th>Investment Plan</th>
                               
                                <th>Payout Amount</th>
                                <th>Payout date</th>
                                <th>Manager</th>
                                <th style="width: 120px;">Status</th>
                            </tr>
                        </thead><!-- end thead -->
                        <tbody>
                            @foreach ($transactions as $t)
                            <tr>
                                <td>
                                    <h6 class="mb-0">
                                        {{$t->investment->investor->title}}  {{$t->investment->investor->first_name}} {{$t->investment->investor->last_name}}
                                    </h6>
                                </td>
                                <td>{{$t->investment->plan->name}}</td>
                                
                                <td>{{$t->payout_amount}}</td>
                                <td>{{$t->payout_date}}</td>
                                <td>{{$t->investment->manager->name}}</td>
                                <td class="actions">
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