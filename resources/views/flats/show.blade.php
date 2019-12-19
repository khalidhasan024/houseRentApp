@extends('template')

@section('content')
    <div class="row">
        <div class="col-md-8 col-lg-5">
            <table class="table table-striped table-sm">
                <tbody>
                    <tr>
                        <td>Flat size:</td>
                        <td>{{$flat->size}} (sqf)</td>
                    </tr>
                    <tr>
                        <td>Rent:</td>
                        <td>{{$flat->bill->rent}} tk.</td>
                    </tr>
                    <tr>
                        <td>Electricity unit price:</td>
                        <td>{{$flat->bill->unit_bill}} tk.</td>
                    </tr>
                    <tr>
                        <td>Gas bill:</td>
                        <td>{{$flat->bill->gas_bill}} tk.</td>
                    </tr>
                    <tr>
                        <td>Others bill:</td>
                        <td>{{$flat->bill->others_bill}} tk.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection