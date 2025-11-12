<?php
$error = "";
$result = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $investment = (float)($_POST["investment"] ?? 0);
    $interest_rate = (float)($_POST["interest_rate"] ?? 0);
    $years = (int)($_POST["years"] ?? 0);

    if ($interest_rate > 15) {
        $error = "<span style='color:red;'>Interest rate must be less than or equal to 15.</span>";
    } else {
        $future_value = $investment * ((1 + $interest_rate / 100) ** $years);
        $result = "<strong>Future Value:</strong> $" . number_format($future_value, 2);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Future Value Calculator</title>
</head>
<body>
    <h2>Future Value Calculator</h2>
    <form action="Exercise2.php" method="post">
        <label for="investment">Investment Amount:</label>
        <input type="text" id="investment" name="investment" value="<?php echo htmlspecialchars($_POST['investment'] ?? ''); ?>" required><br><br>
        <label for="interest_rate">Yearly Interest Rate:</label>
        <input type="text" id="interest_rate" name="interest_rate" value="<?php echo htmlspecialchars($_POST['interest_rate'] ?? ''); ?>" required><br><br>
        <label for="years">Number of Years:</label>
        <input type="text" id="years" name="years" value="<?php echo htmlspecialchars($_POST['years'] ?? ''); ?>" required><br><br>
        <input type="submit" value="Calculate">
    </form>
    <br>
    <?php
    if ($error) {
        echo $error;
    } elseif ($result) {
        echo $result;
    }
    ?>
    <br><br>
    <div style="font-style: italic;">
        This calculation was done on <?php echo date('n/j/Y'); ?>.
    </div>
</body>
</html>