<?php
include 'conn.php';
$connection = new conn();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $date = $_POST["bod"];
    $phone = $_POST["phone"];
    $Yearofjoining = $_POST["Yearofjoining"];
    if (($Yearofjoining >= 2018) && ($Yearofjoining <= 2021)) {
        $connection->addUser($email, $password, $date, $phone, $Yearofjoining);
        $Message = "New record created successfully";
        $status = 1;
        header("Location:index.php?Message={$Message}&status={$status}");
    } else {
        $Message = "Your Year of joining under 2018 and above 2021 you can't be in join with us. ";
        $status = 0;
        header("Location:index.php?Message={$Message}&status={$status}");
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include 'header.php'?>

</head>

<body>
    <div class="container-fluid">
        <h2>تسجيل جديد</h2>
        <?php include 'navbar.php';?>

        <?php
if (isset($_GET['Message'])) {
    $postStatus = $_GET['status'];
    ?>
        <div style='background-color:
    <?php if ($_GET['status'] == 1) {
        echo 'green';
    } else {
        echo 'red';
    }?>;'>
            <?php echo $_GET['Message']; ?>
        </div>
        <?php }?>



        <form action="index.php" method="post">


            <div class="form-group ">
                <label for="inputEmail4">الإيميل</label>
                <input type="email" name="email" placeholder="الإييمل" id="inputEmail4" required value="">
            </div>
            <div class="form-group">
                <label for="inputPassword4">كملت السر</label>
                <input type="password" id="inputPassword4" name="password" minlength="8" maxlength="10" required>
            </div>
            <div class="form-group">
                <label for="bod">تاريخ الميلاد</label>
                <input type="date" id="bod" name="bod" required>
            </div>
            <div class="form-group">
                <label for="phone">رقم الهاتف</label>
                <input type="number" id="phone" name="phone" placeholder="0599886677" minlength="9" maxlength="10">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Yearofjoining">سنة الإنضمام الى الكلية الجامعية</label>
                    <input type="number" name="Yearofjoining" placeholder="2021" required>
                </div>
            </div>

            <button class="button button4" type="reset">مسح</button>
            <button class="button button6" type="submit">حفظ</button>
        </form>
    </div>
    <?php include 'scripts.php'?>
</body>

</html>