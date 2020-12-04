<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li class="nav-item active">
                    <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }} <span class="sr-only">(current)</span></a>
                </li>
                @endforeach
            </ul>
        </div>
    </nav>
    
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
                <th scope="col">{{__('message.offer name')}}</th>
                <th scope="col">{{__("message.offer price")}}</th>
                <th scope="col">{{__("message.offer details")}}</th>
                <th scope="col">{{__("message.offer image")}}</th>
                <th scope="col">Status</th>
                <th scope="col">{{__("message.operation")}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($offers as $offer)
                <tr>
                <th scope="row">{{$offer->id}}</th>
                    <td>{{$offer->name}}</td>
                    <td>{{$offer->price}}</td>
                    <td>{{$offer->details}}</td>
                    <td><img src="{{asset('images/offers/'.$offer->photo)}}" alt="{{__("message.offer image")}}" width="90" height="90"></td>
                    <td>{{$offer->status}}</td>
                    <td>
                        <a href="{{url('offer/edit/'.$offer->id)}}" class="btn btn-primary">{{__('message.edit')}}</a>
                        <a href="{{url('offer/delete/'.$offer->id)}}" class="btn btn-danger ml-2">{{__('message.delete')}}</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{route('inactive.offer')}}" class="btn btn-primary">Inactive Offers</a>
    <div class="d-flex justify-content-center">
        {{-- {!! $offers->links() !!} --}}
    </div>
</body>

</html>
