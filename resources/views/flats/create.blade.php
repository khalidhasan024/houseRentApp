@extends('template')

@section('content')
<form action="{{route('flats.store')}}" method="POST">
    {{ csrf_field() }}
        <div class="row">
            <div class="form-group col">
                <label for="flat_name">Flat Name</label>
                <input type="text" required class="form-control" id="flat_name" name="flat_name" value="" placeholder="Flat Name">
                <small class="text-danger">{{ $errors->first('flat_name') }}</small>
                {{-- <a href="#" onclick="enable_flat_name()">Edit</a> --}}
            </div>
            <div class="form-group col">
                <label for="flat_size">Flat Size</label>
                <input type="number"  min="300" max="1000" step="50" required
                value="" class="form-control" name="flat_size" id="flat_size" placeholder="Flat Size">
                <small class="text-danger">{{ $errors->first('flat_size') }}</small>
                {{-- <a href="#" onclick="enable_flat_size()">Edit</a> --}}
            </div>
        </div>

        <div class="row">
            <div class="form-group col">
                <label for="flat_rent">Rent</label>
                <input type="number" required min="3000" max="10000" step="500" 
                value="" class="form-control" name="flat_rent" placeholder="Rent">
                <small class="text-danger">{{ $errors->first('flat_rent') }}</small>
            </div>
            <div class="form-group col">
                <label for="unit_price">Electricity Unit price</label>
                <input type="number" required min="5" max="15" step="1" value="" 
                class="form-control" name="unit_price" placeholder="Electricity Unit price">
                <small class="text-danger">{{ $errors->first('unit_price') }}</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                <label for="gas_bill">Gas bill</label>
                <input type="number" required min="800" max="1500" step="50" value="" 
                class="form-control" name="gas_bill" placeholder="Gas bill">
                <small class="text-danger">{{ $errors->first('gas_bill') }}</small>
            </div>
            <div class="form-group col">
                <label for="other_bill">Others bill</label>
                <input type="number" required min="50" max="200" step="10" value="" 
                class="form-control" name="others_bill" placeholder="Others bill">
                <small class="text-danger">{{ $errors->first('others_bill') }}</small>
            </div>
        </div>
        
        <button type="submit" name="add" class="btn btn-primary">Add Flat</button>

    </form>
@endsection

@section('scripts')
    <script>
        // var flat_name = document.getElementById("flat_name");
        // var flat_size = document.getElementById("flat_size");
        // flat_name.createAttribute("readonly");
        // flat_size.createAttribute("readonly");
        // function enable_flat_name() {
        // flat_name.createAttribute("readonly");
        //     // flat_name.removeAttribute("readonly");
        // }
        // function enable_flat_size() {
        //     flat_size.removeAttribute("readonly");
        // }
    </script>
@endsection