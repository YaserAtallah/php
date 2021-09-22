<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <style>
        table tr td {
            border: solid 1px;
        }

        table th {
            border: solid 2px;
        }

        form {
            display: inline-block;
            margin-left: 1rem;
            margin-right: 1rem;
        }

        td {
            text-align: center;
        }
    </style>
    <?php include 'header.php'?>

</head>

<body>
    <h2>عرض بيانات</h2>
    <?php include 'navbar.php';
include 'conn.php';

$connection = new conn();
$allUsers = $connection->Users();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $connection = new conn();
    $idd = $_POST['id'];
    $connection->deleteUser($idd);
}

?>
    <?php if (isset($_GET['Message'])) {
    $postStatus = $_GET['status'];
    ?><div class="alert alert-<?php if ($_GET['status'] == 1) {
        echo 'success';
    } else {
        echo 'danger';
    }

    ?>
    ">
        <?php echo $_GET['Message'];
    ?></div><?php
}

?><table class="table" style="width: 100%;">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">الايميل</th>
                <th scope="col">كلمت المرور</th>
                <th scope="col">تاريخ</th>
                <th scope="col">رقم الجوال</th>
                <th scope="col">سنة الانضمام</th>
                <th scope="col">العمليات</th>
            </tr>
        </thead>
        <tbody>
            <?php $x = 1;

foreach ($allUsers as $user) {?>
            <tr>
                <th scope="row"><?php echo $x; ?></th>
                <td><?php echo $user[1]; ?></td>
                <td><?php echo $user[2]; ?></td>
                <td><?php echo $user[3]; ?></td>
                <td><?php echo $user[4]; ?></td>
                <td><?php echo $user[5]; ?></td>
                <td>
                    <form method="post" action="admin.php"><input type="number" name="id"
                            value="<?php echo $user[0]; ?>" hidden><button class="button button3"
                            type="submit">حذف</button></form>
                    <a class="button button2" href="/hw\update.php/<?php echo $user[0] ?>">تعديل</a>
                </td>
            </tr>
            <?php $x++;}?>
        </tbody>
    </table>

    <?php include 'scripts.php'?>

</body>

</html>