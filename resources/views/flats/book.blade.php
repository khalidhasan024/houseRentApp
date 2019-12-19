@extends('template')

@section('stylesheets')
{{-- ========= active for only native desktop ======== --}}
<link rel="stylesheet" href="/css/jquery-ui.css">
@endsection


@section('content')

    <form action="{{route('tenant.store')}}" method="post">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="" class="">Name</label>
                <input class="form-control" required type="text" name="name" id="" placeholder="Tenant's Name">
            </div>
            <div class="form-group col-lg-6">
                <label for="" class="">Phone no.</label>
                <input class="form-control" required type="phone" name="phone" id="" placeholder="Tenant's phone no">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="">Permanent Address</label>
            <input class="form-control" required type="text" name="address" id="" placeholder="Tenant's address">
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="" class="">Profession</label>
                <input class="form-control" required type="text" name="profession" id="" placeholder="Tenant's profession">
            </div>
            <div class="form-group col-lg-6">
                <label for="" class="">National ID card no</label>
                <input class="form-control" required type="text" name="id_no" id="" placeholder="Tenant's national id">
            </div>
        </div>
        <div id="members_area">
            <div class="row single_rel">
                <div class="form-group col-lg-6">
                    <label for="" class="">Members' name</label>
                    <input class="form-control" required placeholder="Member's name" type="text" name="names[]" id="">
                </div>
                <div class="form-group col-lg-6">
                    <label for="" class="">Relation with the Tenant</label>
                    <div class="row">
                        <div class="form-group col-md-9">
                            <input class="form-control mr-4" required placeholder="Relation" type="text" name="rel[]" id="">
                        </div>
                        <div class="form-group col-md-3">
                            <a href="#" class="btn btn-outline-primary btn_add">+</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="">Start from:</label>
                <input type='text' required name="date_from" class='month_picker form-control'>
            </div>
            <div class="form-group col-lg-6">
                <label for="">Security money</label>
                <input type='number' required name="security_money" class='form-control'>
            </div>
        </div>
        <input type="hidden" name="id" id="" value="{{base64_encode($flat->id)}}">
        <input class="btn btn-success" type="submit" value="Book Flat" name="submit">
    </form>

@endsection

@section('scripts')
    
<script src="/js/jquery-ui.js"></script>
<script src="/js/jquery.ui.monthpicker.js"></script>
<script>
        var html = '<div class="row single_rel">\
                        <div class="form-group col-lg-6">\
                            <input class="form-control" required placeholder="Member\'s name" type="text" name="names[]" id="">\
                        </div>\
                        <div class="form-group col-lg-6">\
                            <div class="row">\
                                <div class="form-group col-md-9">\
                                    <input class="form-control mr-4" required placeholder="Relation" type="text" name="rel[]" id="">\
                                </div>\
                                <div class="form-group col-md-3">\
                                    <a href="#" class="btn btn-outline-primary btn_add">+</a>\
                                    <a href="#" class="btn btn-outline-primary btn_remove">-</a>\
                                </div>\
                            </div>\
                        </div>\
                    </div>';
        
       
        $("#members_area").on("click", "a.btn_add", function(){
            
            $(html).insertAfter($(this).parents("div.single_rel"));
        });
        $("#members_area").on("click", "a.btn_remove", function(){
           
            $(this).parents("div.single_rel").remove();
        });
        jQuery(".month_picker").monthpicker({
            changeYear: true,
            stepYears: 2,
            buttonImage: "/img/calendar.png",
            buttonImageOnly: false,
            dateFormat: 'MM, yy',
            showButtonPanel: true,
            minDate: new Date(2019,1,25)
		});
    </script>

@endsection