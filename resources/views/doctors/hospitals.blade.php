@extends('layouts.app');
@section('content')
<div class="container">
    <div id="msg" class="alert alert-success" style="display: none">
        Hospital is deleted
    </div>
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
            <tr id="hosRow{{$hos->id}}">
                <th scope="row">{{$hos->id}}</th>
                    <td>{{$hos->name}}</td>
                    <td>{{$hos->address}}</td>
                    <td>
                        <a href="{{route('doctors',$hos->id)}}" class="btn btn-primary">Doctors</a>
                        <a data-id="{{$hos->id}}" id="del-hos" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{route('hos.has.doc')}}" class="btn btn-success">Hospital Has Doctors</a>
    <a href="{{route('all.doc')}}" class="btn btn-success">Doctors</a>
</div>
@endsection
@section('script')
    <script>
        $(document).on('click','#del-hos',function(e){
            e.preventDefault();
            var id=$(this).data('id');
            $.ajax({
                type:'post',
                url:"{{route('hos.delete')}}",
                data:{
                    '_token':"{{csrf_token()}}",
                    'id':id
                },
                success:function(data){
                    $('#msg').show();
                    $('#hosRow'+data.id).fadeOut('fast');
                },
                error:function(reject){

                }
            })
        });
    </script>
@endsection