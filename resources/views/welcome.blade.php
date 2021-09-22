<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>


    <div class="container-fluid !direction !spacing">
        <h1>Clientes</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Email</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Viajes</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                    <tr>
                        <th scope="row">{{ $cliente['id'] }}</th>
                        <td>{{ $cliente['nombre'] }}</td>
                        <td>{{ $cliente['apellidos'] }}</td>
                        <td>{{ $cliente['telefono'] }}</td>
                        <td><strong>{{ $cliente['email'] }}</strong></td>
                        <td>{{ $cliente['direccion'] }}</td>
                        <td><img src="{{ asset($cliente['foto']) }}" alt="..." class="img-fluid" style="vertical-align: middle;width: 64px;height: 64px;border-radius: 50%; object-fit:cover"></td>
                        <td>
                            @forelse ($cliente->viajes as $viaje)
                                <div><B>VIAJE</B> {{ $loop->index+1 }}</div>
                                <div>Pais: {{ $viaje->pais }}</div>
                                <div>Ciudad: {{ $viaje->ciudad }}</div>          
                                <div class="mb-2">Fecha: {{ $viaje->fecha }}</div>
                            @empty
                                <div>No registra viajes.</div> 
                            @endforelse                                                          
                        </td>
                        <td>
                            <form method="POST" action="{{ Route('deleteCliente', $cliente['id']) }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <input name="from_gui" type="hidden" value="true">
                                <button type="submit" onclick="return confirm('Está seguro que desea eliminar el Cliente?')" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <td colspan="9">NO EXISTEN CLIENTES, POR FAVOR USE LA API</td>
                @endforelse


            </tbody>
        </table>


    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
