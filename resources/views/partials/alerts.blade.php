<div class="container">
    <div class="row">
        <div class="col-md-12">
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
        </div>
    </div>
</div>
@section('script_footer')
    <script type="text/javascript">
        $(".alert-success").alert();
        window.setTimeout(function() { $(".alert-success").alert('close'); }, 2000);
    </script>
@endsection
