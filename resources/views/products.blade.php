<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>
    @foreach($products as $product)
        {{ $product->product_name }} - {{ $product->price }}
    @endforeach
</body>
</html>