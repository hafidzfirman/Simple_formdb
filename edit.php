<?php require('functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
body {
    margin: 0;
    text-align: center;
    background: #000;
    color: #fff;
}
a {
    color: #fff;
}

form {
    display: inline-block;
    text-align: left;
}

table {
    margin-top: 20px;
    border-collapse: collapse;
    width: 100%;
}
th,td {
    border: 1px solid #fff;
    padding: 4px 8px;
}
    </style>
</head>
<body>


<?php


$id = $_GET['id'];


if( isset($_POST['name']) ) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    editKontenDB($id,$name,$address,$birthday,$email,$phone);
}




/** isi value form dengan konten database */
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql = "SELECT * FROM Tabel WHERE id=$id";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $address = $row['address'];
        $birthday = $row['birthday'];
        $email = $row['email'];
        $phone = $row['phone'];
    }
}



?>

<form id="theform" method="POST">
    <label for="name">Name</label><br/>
    <input id="name" type="text" name="name" value="<?php echo $name; ?>" /><br/>
    <br/>
    <label for="address">Address</label><br/>
    <input id="address" type="text" name="address" value="<?php echo $address; ?>" /><br/>
    <br/>
    <label for="birthday">Birthday</label><br/>
    <input id="birthday" type="date" name="birthday" value="<?php echo $birthday; ?>" /><br/>
    <br/>
    <label for="email">Email</label><br/>
    <input id="email" type="email" name="email" value="<?php echo $email; ?>" /><br/>
    <br/>
    <label for="phone">Phone</label><br/>
    <input id="phone" type="text" name="phone" value="<?php echo $phone; ?>" /><br/>
    <br/>
    <button id="submit" type="submit">Submit</button>
</form>
    

<script src="script.js"></script>
</body>
</html>