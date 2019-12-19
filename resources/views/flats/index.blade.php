@extends('template')

@section('heading')
    <div class="row my-2">
        <div class="col">
            <h2>{{ $heading }}</h2>
        </div>
        <div class="col">
            <a href="{{route('flats.create')}}" class="btn btn-secondary float-right">Add New Flat</a>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col">
            @foreach (['danger', 'warning', 'success', 'info'] as $key)
                @if(Session::has($key))
                    <p class="alert alert-{{ $key }}"><strong>{{ Session::get($key) }}</strong></p>
                @endif
            @endforeach
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <table class="table table-sm table-striped table-light">
                <thead>
                    <tr class="table-secondary">
                        <th>Flat name</th>
                        <th>Status</th>
                        <th>Tenant Name</th>
                        <th>Next Tenant</th>
                        <th>Details</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($flats as $flat)
                        <tr>
                            <td>{{$flat->name}}</td>
                            <td><span class="rounded {{$flat->status === \App\Flat::BOOKED ? 'bg-success' : 'bg-warning'}} p-1 px-2">{{$flat->status}}</span></td>
                            <td>{{ $flat->tenant->name ?? '' }}</td>
                            <td>{{ $flat->next_tenant->name ?? '' }}</td>
                            <td><a href="{{route('flats.details',$flat->id)}}" class="btn btn-secondary btn-sm">Details</a></td>
                            <td><a href="{{route('flats.show',$flat->id)}}" class="btn btn-secondary btn-sm">View</a></td>
                            <td><a href="{{route('flats.edit',$flat->id)}}" class="btn btn-secondary btn-sm">Edit</a></td>
                            

                        {{-- <td> --}}
                            @if ( (isset($flat->tenant->period->date_to)  && date_create($flat->tenant->period->date_to) < date_create('now'))
                                || (isset($flat->next_tenant)  && date_create($flat->next_tenant->period->date_from) < date_create('now')) )
                                <td>
                                    <form action="{{route('flats.tenant_update')}}" method="post">
                                        {{ csrf_field()}}
                                        <input type="hidden" name="id" value="{{base64_encode($flat->id)}}">
                                        <input class="btn btn-sm btn-danger" type="submit" value="Update">    
                                    </form> 
                                </td>   
                                {{-- <a class="btn btn-sm btn-danger" href="">hello</a> --}}
                            @else
                                <td></td>
                            @endif
                        {{-- </td> --}}
                        </tr>
                    @endforeach
                </tbody>
    
            </table>
        </div>
    </div>

@endsection