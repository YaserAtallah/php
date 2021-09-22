<?php
include 'conn.php';
$connection = new conn();
$parts = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$res = $connection->edit($parts[3]);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $parts[3];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $Yearofjoining = $_POST['Yearofjoining'];
    $date = $_POST['bod'];

    if (($Yearofjoining >= 2018) && ($Yearofjoining <= 2021)) {

        $update = $connection->update($id, $email, $password, $date, $phone, $Yearofjoining);
        $Message = "record updated successfully";
        $status = 1;
        header("Location:../admin.php/?Message={$Message}&status={$status}");
    } else {
        $Message = "Your Year of joining under 2018 and above 2021 you can't be in join with us. ";
        $status = 0;
        header("Location:../admin.php/?Message={$Message}&status={$status}");
    }

} else {
    foreach ($res as $row) {
        $email = $row[1];
        $password = $row[2];
        $date = $row[3];
        $phone = $row[4];
        $Yearofjoining = $row[5];
    }
    if (is_null($email)) {
        header("Location:../admin.php?Message=This User not found&status=0");
    }
}

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <?php include 'header.php'?>

</head>

<body>
    <h2>تعديل سجل</h2>

    <?php
include 'navbar.php';

if (isset($_GET['Message'])) {
    $postStatus = $_GET['status'];
    ?>
    <div style='background-color: <?php if ($_GET['status'] == 1) {
        echo 'green';
    } else {
        echo 'red';
    }?>;'>
        <?php
echo $_GET['Message'];
    ?>
    </div>
    <?php }?>



    <form action="" method="post">
        <div class="form-group ">
            <label for="inputEmail4">الإيميل</label>
            <input type="email" name="email" placeholder="الإييمل" id="inputEmail4" required value="<?php echo $email; ?>">
        </div>
        <div class="form-group">
            <label for="inputPassword4">كملت السر</label>
            <input type="password" id="inputPassword4" name="password" minlength="8" maxlength="10" required value="<?php echo $password; ?>">
        </div>
        <div class="form-group">
            <label for="bod">تاريخ الميلاد</label>
            <input type="date" id="bod" name="bod" required value="<?php echo $date; ?>">
        </div>
        <div class="form-group">
            <label for="phone">رقم الهاتف</label>
            <input type="number" id="phone" name="phone" placeholder="0599886677" minlength="9" maxlength="10" value="<?php echo $phone; ?>">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Yearofjoining">سنة الإنضمام الى الكلية الجامعية</label>
                <input type="number" name="Yearofjoining" placeholder="2021" required value="<?php echo $Yearofjoining; ?>">
            </div>
        </div>
        <button class="button button6" type="submit">حفظ</button>

    </form>
    <?php include 'scripts.php'?>

</body>

</html>