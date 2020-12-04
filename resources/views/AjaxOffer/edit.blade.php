@extends('layouts.app');
@section('content')
<div class="container">
    <div class="alert alert-success" id="success-msg" style="display: none">Offer has been successfully Edited</div>
    <div class="alert alert-danger" id="error-msg" style="display: none">Bid adding failed, please try again</div>

    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Edit Your Offer
            </div>

            <form id="offerform" enctype="multipart/form-data">
                @csrf
            <div class="form-group"><input type="hidden" name="id" value="{{$offer->id}}"></div>
                <div class="form-group">
                    <label
                        for="exampleInputEmail1">{{ __('message.Choose the offer image') }}</label>
                    <input type="file" class="form-control" name="photo"
                        id="exampleInputEmail1" aria-describedby="emailHelp">
                    @error('photo')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('message.offer name ar') }}</label>
                    <input type="text" class="form-control" name="name_ar" value="{{ $offer->name_ar }}"
                        id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="{{ __('message.offer name') }}">
                    @error('name_ar')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('message.offer name en') }}</label>
                    <input type="text" class="form-control" name="name_en" value="{{ $offer->name_en }}"
                        id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="{{ __('message.offer name') }}">
                    @error('name_en')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{ __("message.offer price") }}</label>
                    <input type="number" class="form-control" name="price" value="{{ $offer->price }}"
                        id="exampleInputPassword1" placeholder="{{ __("message.offer price") }}">
                    @error('price')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label
                        for="exampleInputPassword1">{{ __("message.offer details ar") }}</label>
                    <input type="text" class="form-control" name="details_ar" value="{{ $offer->details_ar }}"
                        id="exampleInputPassword1" placeholder="{{ __("message.offer details") }}">
                    @error('details_ar')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label
                        for="exampleInputPassword1">{{ __("message.offer details en") }}</label>
                    <input type="text" class="form-control" name="details_en" value="{{ $offer->details_en }}"
                        id="exampleInputPassword1" placeholder="{{ __("message.offer details") }}">
                    @error('details_en')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button id="insert-offer" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).on('click', '#insert-offer', function (e) {
        e.preventDefault();
        var formData = new FormData($('#offerform')[0]);
        $.ajax({
            type: 'post',
            enctype: "multipart/form-data",
            url: "{{ route('ajax.offer.update') }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if (data.status == true) {
                    $('#success-msg').show();
                }
            },
            error: function (reject) {

            }
        });
    });

</script>
@endsection
