<!DOCTYPE html>
<html lang="en" class="page-margin">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Lista de miembros</title>
    <style>
        .has-text-nowrap {
            white-space: nowrap;
        }
        .has-font-size-23 {
            font-size:0.6rem !important;
        }
        .page-margin {
            margin:0.5in;
        }
        /* @
        page {
            margin:1in;
        } 
        */
    </style>
</head>
<body>
    <div>
        <table class="table is-fullwidth is-striped">
            <thead>
                <tr class="has-background-dark has-font-size-23">
                    <td class="has-text-white">ID</td>
                    <td class="has-text-white">Nombres</td>
                    <td class="has-text-white">Apellidos</td>
                    <td class="has-text-white">Edad</td>
                    <td class="has-text-white">Género</td>
                    <td class="has-text-white has-text-nowrap">Estado civil</td>
                    <td class="has-text-white">Móvil</td>
                    <td class="has-text-white">Teléfono</td>
                    <td class="has-text-white has-text-nowrap">Correo electrónico</td>
                    <td class="has-text-white">Ocupaciones</td>
                    <td class="has-text-white">Emergencias</td>
                    <td class="has-text-white">Membresia</td>
                    <td class="has-text-white">Actualizado</td>
                </tr>
            </thead>
            <tbody>
                @foreach($miembros as $miembro)
                <tr class="has-font-size-23 {{ $loop->iteration % 2 === 0 ? 'has-background-light' : '' }}">
                    <td>{{ $miembro->id }}</td>
                    <td class="has-text-nowrap">{{ $miembro->nombres }}</td>
                    <td class="has-text-nowrap">{{ $miembro->apellidos }}</td>
                    <td>{{ $miembro->tieneFechaNacimiento() ? $miembro->edad : '' }}</td>
                    <td>{{ ucfirst($miembro->genero_biologico) }}</td>
                    <td class="has-text-nowrap">{{ ucfirst($miembro->estado_civil) }}</td>
                    <td class="has-text-nowrap">{{ $miembro->numero_movil }}</td>
                    <td class="has-text-nowrap">{{ $miembro->numero_telefono }}</td>
                    <td>{{ $miembro->correo_electronico }}</td>
                    <td>{{ $miembro->ocupaciones }}</td>
                    <td>{{ $miembro->emergencias }}</td>
                    <td>{{ $miembro->esActivo() ? 'Activa' : 'Inactiva' }}</td>
                    <td class="has-text-nowrap">{{ $miembro->updated_at->toFormattedDateString() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
