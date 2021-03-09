<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Excel CSV Import/Export - laravelcode.com</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
</head>
<body>

<div class="container" style="margin-top: 5rem;">
    @if($message = Session::get('success'))
        <div class="alert alert-info alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Success!</strong> {{ $message }}
        </div>
    @endif
    {!! Session::forget('success') !!}
    <br />
    <h2 class="text-title">Import Export Excel/CSV - LaravelCode</h2>

    <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ route('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="import_file" />
        <button class="btn btn-primary">Import File</button>
    </form>
        <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ route('car_import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" name="import_file" />
            <button class="btn btn-primary">Import File</button>
        </form>
</div>

<!-- import car -->
<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ route('import_car') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="import_file" />
    <button class="btn btn-primary">Import File</button>
</form>
@if (session('import'))
    <span class="help is-success">{{ session('import') }}</span>
@endif
<!-- import car -->
<!-- import spent -->
<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ route('import_spent') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
    @csrf
    <div class="file has-name is-fullwidth">
        <label class="file-label">
                        <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">Choisissez un fichier</span>
                            </span>
            <span class="file-name"></span>


        </label>
        <input class="input" type="file" name="import_file">
    </div>
    <button class="button is-primary">Import File</button>
</form>
@if (session('import'))
    <span class="help is-success">{{ session('import') }}</span>
@endif
<!-- import spent -->
</body>
</html>


