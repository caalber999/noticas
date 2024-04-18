<!DOCTYPE html>
<html>
<head>
    <title>Noticiero</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
    <body>
        <div class="container mt-5">
            <h1 class="text-center mb-4">Noticiero</h1>

            <div class="row">
                @foreach ($news as $key => $article)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <img src="{{ $authors[$key]['picture'] }}" class="card-img-top" alt="{{ $authors[$key]['name'] }} {{ $authors[$key]['last_name'] }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $article['title'] }}</h5>
                                <p class="card-text flex-fill">{{ $article['description'] }}</p>
                                <p class="card-text mt-2"><small class="text-muted">Por: {{ $authors[$key]['name'] }} {{ $authors[$key]['last_name'] }}</small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="mt-4">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                    @if ($page > 1)
                        <li class="page-item"><a class="page-link" href="/?page={{ $page - 1 }}">Anterior</a></li>
                    @endif
                    
                    @for ($i = 1; $i <= $totalPages && $i <= 10; $i++)
                        <li class="page-item {{ $i == $page ? 'active' : '' }}"><a class="page-link" href="/?page={{ $i }}">{{ $i }}</a></li>
                    @endfor

                    @if ($page < $totalPages)
                        <li class="page-item"><a class="page-link" href="/?page={{ $page + 1 }}">Siguiente</a></li>
                    @endif
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
