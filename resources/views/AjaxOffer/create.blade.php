@extends('layouts.app');
@section('content')
<div class="container">
    <div class="alert alert-success" id="success-msg" style="display: none">Offer has been successfully added</div>
    <div class="alert alert-danger" id="error-msg" style="display: none">Bid adding failed, please try again</div>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{__("message.Add your offer")}}
            </div>
            
            <form id="offerform" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('message.Choose the offer image')}}</label>
                    <input type="file" class="form-control" name="photo" id="exampleInputEmail1"
                        aria-describedby="emailHelp" >
                        <small id="photo_error" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('message.offer name ar')}}</label>
                    <input type="text" class="form-control" name="name_ar" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="{{__('message.offer name')}}">
                        <small id="name_ar_error" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('message.offer name en')}}</label>
                    <input type="text" class="form-control" name="name_en" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="{{__('message.offer name')}}">
                        <small id="name_en_error" class="form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{__("message.offer price")}}</label>
                    <input type="number" class="form-control" name="price" id="exampleInputPassword1"
                        placeholder="{{__("message.offer price")}}">
                        <small id="price_error" class="form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{__("message.offer details ar")}}</label>
                    <input type="text" class="form-control" name="details_ar" id="exampleInputPassword1"
                        placeholder="{{__("message.offer details")}}">
                        <small id="details_ar_error" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__("message.offer details en")}}</label>
                    <input type="text" class="form-control" name="details_en" id="exampleInputPassword1"
                        placeholder="{{__("message.offer details")}}">
                        <small id="details_en_error" class="form-text text-danger"></small>
                </div>

                <button id="insert-offer" class="btn btn-primary">{{__("message.add")}}</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).on('click','#insert-offer',function(e){
            e.preventDefault();
            var formData=new FormData($('#offerform')[0]);
            $('#photo_error').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#price_error').text('');
            $('#details_ar_error').text('');
            $('#details_en_error').text('');
            $.ajax({
            type:'post',
            enctype:"multipart/form-data",
            url:"{{route('ajax.offer.insert')}}",
            data:formData,
            processData:false,
            contentType:false,
            cache:false,
            success:function(data){
                if(data.status==true){
                    $('#success-msg').show();
                }
            },
            error:function(reject){
                var response=parse.JSON(reject.responseText);
                $.each(response.errors,function(key,val){
                    $('#'+key+'_error').text(val[0]);
                });
            }
        });
        });
        
    </script>
@endsection