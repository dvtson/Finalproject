<?php
session_start(); // Bắt đầu phiên làm việc

// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root"; // Thay đổi nếu cần
$password = ""; // Thay đổi nếu cần
$database = "myDB";

$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu có yêu cầu xóa sản phẩm
if (isset($_POST['remove_id'])) {
    $removeId = $_POST['remove_id'];
    if (isset($_SESSION['cart'][$removeId])) {
        unset($_SESSION['cart'][$removeId]); // Xóa sản phẩm khỏi giỏ hàng
        echo "<script>alert('Sản phẩm đã được xóa khỏi giỏ hàng.');</script>";
    }
}

// Kiểm tra nếu giỏ hàng đã được khởi tạo
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<h3>Giỏ hàng của bạn đang trống.</h3>";
    exit;
}

$totalPrice = 0;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .cart-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .total {
            font-weight: bold;
            margin-top: 20px;
        }
        .remove-button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <h2>Giỏ Hàng</h2>
        <?php 
        foreach ($_SESSION['cart'] as $id => $quantity): 
            // Lấy thông tin sản phẩm từ cơ sở dữ liệu
            $stmt = $conn->prepare("SELECT name, price FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($name, $price);
            $stmt->fetch();
            $stmt->close();

            if ($name): 
                $totalPrice += $price * $quantity; ?>
                <div class="cart-item">
                    <span><?php echo $name; ?> (x<?php echo $quantity; ?>)</span>
                    <span><?php echo number_format($price * $quantity, 0, ',', '.'); ?> VND</span>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="remove_id" value="<?php echo $id; ?>">
                        <button type="submit" class="remove-button">Xóa</button>
                    </form>
                </div>
            <?php else: ?>
                <div class="cart-item">
                    <span></span>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <div class="total">Tổng cộng: <?php echo number_format($totalPrice, 0, ',', '.'); ?> VND</div>
        <button onclick="location.href='checkout.php'" style="margin-top: 20px;">Thanh toán</button>
    </div>
</body>
</html>

<?php
$conn->close(); // Đóng kết nối
?>