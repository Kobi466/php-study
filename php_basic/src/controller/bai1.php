<?php
    //Kiểm tra xem form đã được submit chưa
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //lấy giá trị từ form, nếu không có thì mặc định bằng không
    $a = isset($_POST['a']) ? ($_POST['a']) : 0;
    $b = isset($_POST['b']) ? ($_POST['b']) : 0;
    $result = '';
    //Xử lý các trường hợp
    if ($a==0){
        if ($b==0){
            $result = 'Phương trình vô số nghiệm';
        }
        else{
            $result = 'Phương trình vô nghiệm';
        }
    }
    else {
        $X = -$b / ($a);
        $result = round($X, 2);
        //lam tron gia tri
    }
    echo '<div class="result">';
    echo "<p>Phương trình: $a x + $b = 0</p>";
    echo "<p><strong>$result</strong></p>";
    echo '</div>';
}
    ?>

<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--<meta charset="UTF-8">-->
<!--    <title>KET QUA GIA PHUONG TRINH BAC NHAT</title>-->
<!--    <style>-->
<!--        /* CSS để tạo giao diện đẹp hơn */-->
<!--        body {-->
<!--            font-family: Arial, sans-serif;-->
<!--            margin: 20px;-->
<!--            line-height: 1.6;-->
<!--        }-->
<!--        .result {-->
<!--            margin: 20px 0;-->
<!--            padding: 15px;-->
<!--            background-color: #f8f9fa;-->
<!--            border: 1px solid #ddd;-->
<!--            border-radius: 4px;-->
<!--        }-->
<!--        .back-link {-->
<!--            display: inline-block;-->
<!--            margin-top: 20px;-->
<!--            padding: 8px 16px;-->
<!--            background-color: #4CAF50;-->
<!--            color: white;-->
<!--            text-decoration: none;-->
<!--            border-radius: 4px;-->
<!--        }-->
<!--        .back-link:hover {-->
<!--            background-color: #45a049;-->
<!--        }-->
<!--    </style>-->
<!--</head>-->
<!--<body>-->
<!--    <h2>Ket qua phuong trinh</h2>-->
<!--    <div class = "result">-->
<!--        <p>Phuong trinh: --><?php //echo $a; ?><!--X + --><?php //echo $b; ?><!-- = 0</p>-->
<!--        <p>Ket qua: <strong>--><?php //echo $result; ?><!--</strong></p>-->
<!--    </div>-->
<!--    <a href="../view/bai1.html" class="back-link">Quay lai</a>-->
<!--</body>-->
<!--</html>-->
