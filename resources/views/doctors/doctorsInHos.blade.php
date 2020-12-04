@extends('layouts.app');
@section('content')
<div class="container">
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Doctor name</th>
                <th scope="col">Doctor title</th>
                <th scope="col">Hospital name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doc)
                <th scope="row">{{$doc->id}}</th>
                    <td>{{$doc->name}}</td>
                    <td>{{$doc->title}}</td>
                    <td>{{$doc->hospital->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection