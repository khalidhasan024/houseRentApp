@extends('template')

@section('content')
    
<div class="row">
    <div class="col">
        <form action="{{route('expense.store')}}" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <label for="new_ammount" class="">Ammount</label>
                <input class="form-control" id="expense_ammount" required type="number" name="ammount" placeholder="Ammount">
            </div>
            <div class="form-group">
                <label for="" class="">Note</label>
                <textarea class="form-control" required name="note" rows="5" placeholder="Expense Details"></textarea>
                {{-- <input class="form-control" required type="text" name="note" placeholder="Note"> --}}
            </div>
            <input class="btn btn-success" name="submit" type="submit" value="Save">
        </form>
    </div>
</div>
@endsection