<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link href="{{URL::to('/')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{URL::to('/')}}/css/app2.css" rel="stylesheet">
    <link href="{{URL::to('/')}}/css/app.css" rel="stylesheet">
    <link href="{{URL::to('/')}}/css/ui.css" rel="stylesheet">

  </head>
  <body>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1><b>Agropecuaria Carutal "CoVA" F.P</b></h1>
				<br>
				<nav class="navegacion">
					{{HTML::link('/', 'Inicio')}}

					@if(!Auth::user())
						{{HTML::link('/login', 'Iniciar Sesion')}}
					@else
						{{HTML::link('/logout', 'Cerrar Sesion', ['class'=>'cerrar'] )}}

					@endif
				</nav>

					@if(Auth::user())
						<nav class="navegacion2">
							@if(Auth::user()->rol == 0)
                {{HTML::link('/users', 'Gestion de Usuarios')}}
              @endif
							{{HTML::link('/inventario', 'Control de Inventario')}}
							{{HTML::link('/pedidos', 'Gestion de Pedidos')}}
							{{HTML::link('/reporte', 'Gestion de Reportes')}}
						</nav>
					@endif

				<hr>
			</div>
		</div>
	</div>
	@yield('cont')

    <!-- jQuery Version 1.11.0 -->
    <script src="{{URL::to('/')}}/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{URL::to('/')}}/js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{URL::to('/')}}/js/sb-admin-2.js"></script>

    <script src="{{URL::to('/')}}/js/jq.js"></script>
    <script src="{{URL::to('/')}}/js/ui.js"></script>

    @if(Session::get('alert')!=null)
        <script>
            alert("{{Session::get('alert')}}");
        </script>
    @endif


    <script>
        $(function() {
            $( ".datepicker" ).datepicker({
              dateFormat: "yy-mm-dd",
              changeMonth: true,
              changeYear: true,
              yearRange: '-100:+0'
            });
        });

        $(function() {
            $( "#datepicker" ).datepicker({
              dateFormat: "yy-mm-dd",
              changeMonth: true,
              changeYear: true,
              yearRange: '-100:+0'
            });
        });
    </script>

  </body>
</html>