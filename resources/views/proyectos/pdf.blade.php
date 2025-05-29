<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PDF Proyectos</title>
</head>
<body>
    <h1>{{ $proyecto->nombre }}</h1>
    <p><strong>Cliente:</strong> {{ $proyecto->empresa }}</p>
    <hr>
    @foreach($proyecto->productos as $producto)
        <h2>{{ $producto->nombre }} ({{ $producto->precio, 2 }} €)</h2>
        <table style="margin-bottom: 20px;">
            <tr>
                <td rowspan="4">
                    @if($producto->foto)
                        <img src="{{ public_path('storage/' . $producto->foto) }}" alt="{{ $producto->nombre }}" width="210" style="margin-right: 40px">
                    @endif
                </td>
                <td>
                    <strong>Medidas:</strong> {{ $producto->medidas }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Color:</strong> {{ $producto->color }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Materiales:</strong>
                    <ul>
                        @foreach($producto->materiales as $material)
                            <li>
                                {{ $material->nombre }} ({{$material->pivot->m2, 2 }} m²)
                                @if($material->pivot->principal)
                                    (Principal)
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Gastos de fabricación:</strong>
                    <ul>
                        @foreach($producto->gastos as $gasto)
                            <li>{{ $gasto->nombre }} ({{ $gasto->pivot->horas }} horas)</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        </table>
        <hr>
    @endforeach
</body>
</html>
