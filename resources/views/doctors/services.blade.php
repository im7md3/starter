@extends('layouts.app');
@section('content')
<div class="container">
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Service name</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($services)&&$services->count()>0)
                @foreach($services as $ser)
                    <th scope="row">{{$ser->id}}</th>
                        <td>{{$ser->name}}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <br><br><br>


    <div class="flex-center position-ref full-height">
        <div class="content">
            <form method="POST" action="{{route('save.ser')}}" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Choose Doctors</label>
                    <select class="form-control" name="doctor_id" >
                        @if (isset($doctors)&&$doctors->count()>0)
                            @foreach ($doctors as $doc)
                                <option value="{{$doc->id}}" @if ($doc_id==$doc->id)
                                    selected
                                @endif>{{$doc->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Choose Service</label>
                    <select class="form-control" name="services_id[]" multiple>
                        @if (isset($allServices)&&$allServices->count()>0)
                            @foreach ($allServices as $serv)
                                <option value="{{$serv->id}}">{{$serv->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">{{__("message.add")}}</button>
            </form>
        </div>
    </div> 


</div>
@endsection