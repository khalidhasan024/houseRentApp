@extends('template')

@section('content')
<form action="{{route('flats.update',$flat)}}" method="POST">
    {{ csrf_field() }}
        <div class="row">
            <div class="form-group col">
                <label for="flat_name">Flat Name</label>
            <input type="text" required class="form-control" id="flat_name" name="flat_name" value="{{$flat->name}}" placeholder="Flat Name">
            </div>
            <div class="form-group col">
                <label for="flat_size">Flat Size</label>
                <input type="number"  min="300" max="1000" step="50" required
                value="{{$flat->size}}" class="form-control" name="flat_size" placeholder="Flat Size">
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                <label for="flat_rent">Rent</label>
                <input type="number" required min="3000" max="10000" step="500" 
            value="{{$flat->bill->rent}}" class="form-control" name="flat_rent" placeholder="Rent">
            </div>
            <div class="form-group col">
                <label for="unit_price">Electricity Unit price</label>
                <input type="number" required min="5" max="15" step="1" value="{{$flat->bill->unit_bill}}" 
                class="form-control" name="unit_price" placeholder="Electricity Unit price">
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                <label for="gas_bill">Gas bill</label>
                <input type="number" required min="800" max="1500" step="50" value="{{$flat->bill->gas_bill}}" 
                class="form-control" name="gas_bill" placeholder="Gas bill">
            </div>
            <div class="form-group col">
                <label for="other_bill">Others bill</label>
                <input type="number" required min="50" max="200" step="10" value="{{$flat->bill->others_bill}}" 
                class="form-control" name="others_bill" placeholder="Others bill">
            </div>
        </div>
        <input type="hidden" name="_method" value="PUT">
        <button type="submit" name="edit" class="btn btn-success">Save Changes</button>

    </form>
@endsection