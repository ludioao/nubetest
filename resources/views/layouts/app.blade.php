<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{!! config('app.name') !!}</title>
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css') !!}
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.19.3/sweetalert2.min.css') !!}
</head>
<body>
    <header class="container" style="margin-bottom: 20px">
        <div class="row">
            <div class="col-md-4">
                <img src="http://cdn2.bigcommerce.com/n-arxsrf/fhqhzj/product_images/uploaded_images/super-heroes-trivia-category-comic-trivia-night.jpg?t=1398725710" width="100%" />
            </div>
            <div class="col-md-8">
                <h1>SuperHeroes</h1>
                <h2>Let's have fun with some CRUD actions. ;-)</h2>
                <p>Made by: Lúdio Oliveira</p>
            </div>
        </div>
    </header>
    <main class="container">
        
        <div class="row">
            <aside class="col-md-4">
                <div class="list-group">
                    <a class="list-group-item" href="{!! route('superhero.create') !!}">Add superhero</a>
                    <a class="list-group-item" href="{!! route('superhero.index') !!}">List all</a>
                </div>
            </aside>
            <div class="col-md-8">
                @if($errors->any())
                    <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{!! $error !!}</p>
                    @endforeach
                    </div>
                @endif
                
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {!! session()->pull('success') !!}
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </main>
    {!! Html::script('https://code.jquery.com/jquery-3.3.1.slim.min.js') !!}
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.min.js') !!}
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.19.3/sweetalert2.min.js') !!}
    <script>
        $(document).on('click', '.swa-confirm', function (e) {
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                title: $(this).data("swa-title"),
                text: $(this).data("swa-text"),
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#cc3f44",
                confirmButtonText: $(this).data("swa-btn-txt"),
                html: false,
                cancelButtonText: "Nope, abort!",
            }).then((result) => {
                if (result.value) {
                swal(
                    'Deleted!',
                    'Your item has been deleted.',
                    'success'
                );
                form.submit();
            }
            });
        });
    </script>
</body>
</html>
