<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mercado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    </head>
    <style>
            /* Show it is fixed to the top */
            body {
                min-height: 75rem;
                padding-top: 4.5rem;
            }        
            .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: #0000001a;
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em #0000001a, inset 0 .125em .5em #00000026
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8
        }

        .bd-mode-toggle {
            z-index: 1500
        }

        .bd-mode-toggle .bi {
            width: 1em;
            height: 1em
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important
        }

        /* Estilos personalizados para paginação */
        .pagination {
            margin-bottom: 0;
        }
        
        .pagination .page-link {
            border-radius: 0.375rem;
            margin: 0 2px;
            border: 1px solid #dee2e6;
            color: #6c757d;
            font-size: 0.875rem;
            padding: 0.375rem 0.75rem;
            transition: all 0.15s ease-in-out;
        }
        
        .pagination .page-link:hover {
            background-color: #e9ecef;
            border-color: #dee2e6;
            color: #495057;
        }
        
        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }
        
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #fff;
            border-color: #dee2e6;
        }
        
        .pagination .page-link:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }


    </style>
</head>

<body> 
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid"> <a class="navbar-brand" href="#">Mercado</a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item"> <a class="nav-link active" aria-current="page" href="#"></a> </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Compra
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Produto</a></li>
                        <li><a class="dropdown-item" href="#">Orçamento</a></li>
                        <li><a class="dropdown-item" href="#">Ordem Compra</a></li>
                        <li><a class="dropdown-item" href="#">Entrada</a></li>
                    </ul>
                </li>                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Contas Pagar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Fornecedor</a></li>
                        <li><a class="dropdown-item" href="#">Contas a Pagar</a></li>
                        <li><a class="dropdown-item" href="#">Baixa de Conta</a></li>
                    </ul>
                </li>                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Venda
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Cliente</a></li>
                        <li><a class="dropdown-item" href="#">Venda</a></li>
                    </ul>
                </li>                

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Contas Receber
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Baixa</a></li>
                        <li><a class="dropdown-item" href="#">Consulta</a></li>
                    </ul>
                </li>    
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Folha de Pagamento
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('funcionarios.index') }}">Funcionários</a></li>
                        <li><a class="dropdown-item" href="{{ route('ocorrencias.index') }}">Ocorrências</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('folhaPagamento.index') }}">Folhas de Pagamento</a></li>
                        <li><a class="dropdown-item" href="{{ route('folhaPagamento.create') }}">Gerar Folha</a></li>
                    </ul>
                </li>

                </ul>
            </div>
        </div>
    </nav>
    <main class="container-fluid">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>    
</body>

</html>