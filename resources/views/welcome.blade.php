<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Short URLs</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        <br><br>
        <div class="container">
            @if(session()->has('alert'))
                <div class="alert alert-success" role="alert"><p>{{session('alert')}}</p></div>
                {{session()->flush()}}
            @elseif(session()->has('invalid'))
                <div class="alert alert-danger" role="alert"><p>{{session('invalid')}}</p></div>
                {{session()->flush()}}
            @endif

            <div class="jumbotron bg-primary text-light">
                <h1 class="display-4">Short URLs</h1>
                <p class="lead">A simple URL shortening service created using Laravel.</p>
                <a href="{{url('image_editor')}}" class="btn btn-danger">Image Editor</a>
                <a href="{{url('docxtopdf')}}" class="btn btn-info">DOCX to PDF Converter</a>
                <a href="{{url('pdftoimage')}}" class="btn btn-warning">PDF to IMAGE Converter</a>
            </div>

            <div class="card bg-light">
                <div class="card-body">
                    <form action="{{ route('makeShortUrl') }}" method="post">
                        @csrf <!-- {{ csrf_field() }} -->
                        <div class="input-group mb-3">
                            <input type="url" class="form-control" name="url" placeholder="Enter a URL" autocomplete="off">
                            <input type="submit" class="btn btn-success" value="Submit">
                        </div>
                    </form> 
                </div>
            </div><br>

            <div class="row">
                <div class="col">
                    <a class="btn btn-success btn-block p-3" role="button" href="{{ route('directory') }}">Links Directory</a>
                </div>
            </div><br>

            <div class="card">
                <h3 class="card-header">Most Recent</h3>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">Short Link</th>
                              <th scope="col">Destination</th>
                              <th scope="col">Created at</th>
                            @foreach ($recent as $entries)
                                    <tr>
                                    <td><a href="{{$entries['url']}}" target="_blank">{{$_SERVER['HTTP_HOST'].'/url/public/c/'.$entries->code}}<a></td>
                                    <td>{{$entries->url}}</td>
                                    <td>{{$entries->created_at->format('d/m/Y')}}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><br>
            
            <div class="card">
                <h3 class="card-header">Most Used</h3>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">Clicks</th>
                              <th scope="col">Short Link</th>
                              <th scope="col">Destination</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clicked as $entries)
                                <tr>
                                    <td>{{$entries->clicks}}</td>
                                    <td><a href="{{$entries['url']}}" target="_blank">{{$_SERVER['HTTP_HOST'].'/url/public/c/'.$entries->code}}<a></td>
                                    <td>{{$entries->url}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><br><br>
        </div>
    </body>
</html>