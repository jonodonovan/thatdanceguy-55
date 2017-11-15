@if (Session::has('success'))

    <div class="alert alert-success" role="alert">
        <strong>Success:</strong> {{ Session::get('success') }}
    </div>

@endif

@if (Session::has('errors'))

    <div class="alert alert-danger" role="alert">

        <strong>Error:</strong>
        <ul>

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

        </ul>
    </div>

@endif

@if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif
