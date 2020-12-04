@extends('layouts.app')
@section('content')

<div class="alert alert-success" id="success-msg" style="display: none">Offer has been successfully added</div>
<div class="alert alert-danger" id="error-msg" style="display: none">Bid adding failed, please try again</div>

@if (Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
@endif

@if(Session::has('fail'))
    <div class="alert alert-danger">
        {{Session::get('fail')}}
    </div>
@endif

<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">offer name</th>
            <th scope="col">offer price</th>
            <th scope="col">offer details</th>
            <th scope="col">offer image</th>
            <th scope="col">operation</th>
        </tr>
    </thead>
    <tbody>
        @foreach($offers as $offer)
        <tr class="OfferRow{{$offer->id}}">
            <th scope="row">{{$offer->id}}</th>
                <td>{{$offer->name_en}}</td>
                <td>{{$offer->price}}</td>
                <td>{{$offer->details_en}}</td>
                <td><img src="{{asset('images/offers/'.$offer->photo)}}" alt="offer image" width="90" height="90"></td>
                <td>
                    <a href="{{route('ajax.offer.edit',$offer->id)}}" data-id="{{$offer->id}}" class="btn btn-primary" id="ajax-edit">Ajax Edit</a>

                <a data-id="{{$offer->id}}" class="btn btn-danger ml-2" id="ajax-delete">Ajax Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('script')
    <script>
        $(document).on('click','#ajax-delete',function(e){
            e.preventDefault();
            var offer_id=$(this).data('id');

            $.ajax({
                type:'post',
                url:"{{route('ajax.offer.delete')}}",
                data:{
                    '_token':"{{csrf_token()}}",
                    'id':offer_id,
                },
                success:function(data){
                    if(data.status==true){
                    $('#success-msg').show();
                }
                    $('.OfferRow'+data.data).fadeOut('fast');
                },
                error:function(reject){

                },
            });
        });

    </script>
@endsection