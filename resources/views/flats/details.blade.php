@extends('template')
 {{-- ======= Custom stylesheets only for this view =========  --}}
@section('stylesheets')
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
@endsection

@section('heading')
<div class="row my-2" >
    <div class="col-md-6">
                <h2>{{ $heading }}</h2>
                <hr>
                <p><strong class="mr-2">Name: </strong>{{$flat->tenant->name ?? ''}}</p>
                <p><strong class="mr-2">Month: </strong>{{ date("F Y",strtotime('last month'))}} </p>
                <p><strong class="mr-2">Start: </strong>{{ isset($flat->tenant->period->date_from) ? date("F Y",strtotime($flat->tenant->period->date_from)) : '' }}</p>
                <p><strong class="mr-2">Leaveing on: </strong><strong class="bg-warning rounded p-1">{{ isset($flat->tenant->period->date_to) ? date("F Y",strtotime($flat->tenant->period->date_to)) : '' }}</strong></p>
                <p><strong class="mr-2">Advance: </strong><strong class="border border-success rounded p-1">{{ $flat->tenant->account->security_money ?? '' }}</strong></p>
                <p><strong class="mr-2">Due: </strong><strong class="border border-danger rounded p-1">{{ $flat->tenant->account->due ?? '' }}</strong></p>
                
            </div>
            <div class="col-md-6">
                <div class="row my-3">
                    <form action="" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{base64_encode($flat->id)}}">
                        @if ($flat->status == \App\Flat::EMPTY)
                            <input type="submit" formaction="{{route('flats.book')}}" name="" class="btn btn-success mr-2" value="Book" >
                        @endif
                        @if (isset($flat->tenant) && !isset($flat->tenant->period->date_to))
                            <input type="submit" formaction="" name="" class="btn btn-success mr-2" value="Leave" >
                        @endif
                        @if (isset($flat->tenant) && $flat->tenant->status == \App\Tenant::ACTIVE)
                            <input type="submit" formaction="{{route('payment.create')}}" name="" class="btn btn-success mr-2" value="Payment" >
                            <input type="submit" formaction="{{route('payment.history')}}" name="" class="btn btn-success mr-2" value="History" >
                        @endif
                        {{-- <input type="submit" formaction="/payment/all_payment.php" name="to_history" class="btn btn-success mr-2" value="History" >
                        <input type="submit" formaction="/flats/flat.php" name="to_edit" class="btn btn-success mr-2" value="Edit" > --}}
                    </form>
                    {{-- {# <a href="/flats/flat?flat_no=102&mode=edit" class="btn btn-success mr-2">Edit</a>
                    <a href="/flats/payment" class="btn btn-success mr-2">Payment</a>
                    <a href="/flats/show_all" class="btn btn-success mr-2">History</a> #} --}}
                </div>
                <div class="row">
                    <input type="text" name="" id="" class="month_picker px-4 py-1" value="">
                    
                </div>
            </div>
        </div>
@endsection

@section('content')
    
<div class="row">
    <p class="col col-md-3"><strong>Electricity bill: </strong></p>
    <div class="col-md-9">
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Previous reading</th>
                            <th>Current reading</th>
                            <th>Consumed unit</th>
                            <th>Unit price</th>
                            <th>Electricity Bill</th>
                            <th>#</th>
                        </tr>
                        <tr>
                            <td>{{$flat->electricity->start_reading ?? 'NaN'}}</td>
                            <td>{{$flat->electricity->end_reading ?? 'NaN'}}</td>
                            <td>{{ isset($flat->electricity) ? $flat->electricity->end_reading - $flat->electricity->start_reading : 'NaN' }}</td>
                            <td>{{ $flat->bill->unit_bill }}</td>
                            <td>{{ isset($flat->electricity) ?  $flat->bill->unit_bill * ($flat->electricity->end_reading - $flat->electricity->start_reading) : 'NaN' }}</td>
                            <td><a href="/electricity/edit" class="btn btn-success btn-sm">Edit</a></td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <hr>
        
        <div class="row">
            <p class="col col-md-3"><strong>Month total: </strong></p>
            <div class="col-md-9">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>House rent</th>
                            <th>Electricity</th>
                            <th>Gas</th>
                            <th>Others</th>
                            <th>Month total</th>
                            <th>Total due</th>
                        </tr>
                        <tr>
                            <td>{{ $flat->bill->rent }}</td>
                            <td>{{ isset($flat->electricity) ?  $flat->bill->unit_bill * ($flat->electricity->end_reading - $flat->electricity->start_reading) : 'NaN' }}</td>
                            <td>{{ $flat->bill->gas_bill }}</td>
                            <td>{{ $flat->bill->others_bill }}</td>
                            <td>{{ isset($flat->electricity) ?  $flat->bill->rent +
                                    $flat->bill->gas_bill +
                                    $flat->bill->others_bill +
                                    ($flat->bill->unit_bill * ($flat->electricity->end_reading - $flat->electricity->start_reading)) : 'NaN' }}</td>
                            <td>{{ $flat->tenant->account->due ?? '' }}</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
@endsection

 {{-- ======= Custom javascript only for this view =========  --}}
@section('scripts')
    
<script src="/js/jquery-ui.js"></script>
<script src="/js/jquery.ui.monthpicker.js"></script>
<script>
        jQuery(".month_picker").monthpicker({
            changeYear: true,
            stepYears: 2,
            showOn:     "both",
            buttonImage: "/img/calendar.png",
            buttonImageOnly: false,
            dateFormat: 'MM, yy',
            showButtonPanel: true
		});
    </script>


@endsection
