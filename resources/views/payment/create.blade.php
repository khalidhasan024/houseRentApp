@extends('template')


@section('content')
    <form action="{{route('payment.store')}}" method="post">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-6">
                <label for="">Amount</label>
                <input class="form-control" type="number" min="1" name="amount" id="" value="{{$flat->tenant->account->due ?? 0}}">
            </div>
        </div>
        <input type="hidden" name="id" value="{{$flat->id}}">
        <input type="submit" class="btn btn-success" value="Make payment">
    </form>
@endsection