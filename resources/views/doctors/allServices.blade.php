@extends('layouts.app');
@section('content')
<div class="container">
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Service name</th>
                <th scope="col">Number of Doctors</th>
                <th scope="col">Name of Doctors</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($services)&&$services->count()>0)
                @foreach($services as $ser)
                    <tr>
                        <th scope="row">{{$ser->id}}</th>
                        <td>{{$ser->name}}</td>
                        <td>{{$ser->doctors->count()}}</td>
                        <td>
                            @foreach ($ser->doctors as $doc)
                                {{$doc->name}} , 
                            @endforeach
                        </td>
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
                                <option value="{{$doc->id}}">{{$doc->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Choose Service</label>
                    <select class="form-control" name="services_id[]" multiple>
                        @if (isset($services)&&$services->count()>0)
                            @foreach ($services as $serv)
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