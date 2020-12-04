@extends('layouts.app');
@section('content')
<div class="container">
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Hospital name</th>
                <th scope="col">Hospital address</th>
                <th scope="col">operation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hospitals as $hos)
                <th scope="row">{{$hos->id}}</th>
                    <td>{{$hos->name}}</td>
                    <td>{{$hos->address}}</td>
                    <td>
                        <a href="{{route('doctors',$hos->id)}}" class="btn btn-primary">Doctors</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{route('hos')}}" class="btn btn-success">Hospitals</a>
</div>
@endsection