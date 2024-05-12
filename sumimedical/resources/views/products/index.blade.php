<!-- resources/views/products/index.blade.php -->
<html>
<head>
    <title>Lista de Productos</title>
    <!-- Agregar enlaces a los estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Productos</h1>
        <!-- Agregar una tabla con estilos de Bootstrap -->
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>


</html>
