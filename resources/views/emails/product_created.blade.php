<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm mới được tạo</title>
</head>
<body>
    <h1>Sản phẩm mới đã được thêm!</h1>
    <p><strong>Tên sản phẩm:</strong> {{ $product->name }}</p>
    <p><strong>Giá:</strong> {{ $product->price }}</p>
    <p><strong>Mô tả:</strong> {{ $product->description }}</p>
</body>
</html>
