<?php
session_start();
include 'config.inc';
include 'conn.inc';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

$sql = 'SELECT * FROM products WHERE name LIKE ?';
$statement1 = $conn->prepare($sql);
$likeTerm = '%' . $searchTerm . '%';
$statement1->bind_param('s', $likeTerm);
$statement1->execute();
$result1 = $statement1->get_result();

$products = $result1->fetch_all(MYSQLI_ASSOC);

$statement1->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Search Products</title>
    <style>
        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .product-item {
            width: 300px;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .product-item img {
            max-width: 200px;
            height: auto;
        }
    </style>
    <script>
        function addToCart(productId) {
            fetch('add_to_cart.php?id=' + productId, {
                method: 'POST',
            })
            .then(response => response.json())
            .then(data => {
                alert('Sản phẩm đã được thêm vào giỏ hàng.');
            })
            .catch(error => {
                alert('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.');
            });
        }
    </script>
</head>
<body>
    <h1>Search Results</h1>
    <div class="product-container">
        <?php if ($products): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-item">
                    <a href="getproduct.php?id=<?php echo $product['id']; ?>">

                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                    </a>
                    <button onclick="addToCart(<?php echo $product['id']; ?>)">Thêm vào giỏ hàng</button>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>
</body>
</html>