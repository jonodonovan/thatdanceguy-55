
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('success'))

                <div class="alert alert-success" role="alert">
                    <strong>Success:</strong> {{ Session::get('success') }}
                </div>
                @section('script_footer')
                    <script type="text/javascript">
                        $(".alert-success").alert();
                        window.setTimeout(function() { $(".alert-success").alert('close'); }, 2000);
                    </script>
                @endsection

            @endif 
            
            @if (session('status'))
                <div class="alert alert-success pull-right" style="position: absolute;right:50px;top:50px;z-index:10000;">
                    {{session('status')}}
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
                @section('script_footer')
                    <script type="text/javascript">
                        $(".alert-success").alert();
                        window.setTimeout(function() { $(".alert-success").alert('close'); }, 2000);
                    </script>
                @endsection

            @endif

        </div>
    </div>
