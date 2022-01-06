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
if( isset($_POST['name']) ) {
    masukkanKeDB($_POST['name'],$_POST['address'],$_POST['birthday'],$_POST['email'],$_POST['phone']);
}
?>

<form id="theform" method="POST">
    <label for="name">Name</label><br/>
    <input id="name" type="text" name="name" /><br/>
    <br/>
    <label for="address">Address</label><br/>
    <input id="address" type="text" name="address" /><br/>
    <br/>
    <label for="birthday">Birthday</label><br/>
    <input id="birthday" type="date" name="birthday" value="" /><br/>
    <br/>
    <label for="email">Email</label><br/>
    <input id="email" type="email" name="email" /><br/>
    <br/>
    <label for="phone">Phone</label><br/>
    <input id="phone" type="text" name="phone" /><br/>
    <br/>
    <button id="submit" type="submit">Submit</button>
</form>


<table id="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Address</th>
            <th>Birthday</th>
            <th>Age</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="printarea">
        <?php
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            // Pilih semua kolom dari tabel X, urutkan berdasarkan X
            $sql = "SELECT * FROM Tabel ORDER BY id DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // cetak template di sini
                    echo '
                    <tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['name'] . '</td>
                        <td>' . $row['address'] . '</td>
                        <td>' . reformatDate($row['birthday']) . '</td>
                        <td>' . age($row['birthday']) . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>' . $row['phone'] . '</td>
                        <td><a href="' . HOME_DIR . 'edit.php?id=' . $row['id'] . '">Edit</a></td>
                    </tr>
                    ';
                }
            }

            $conn->close();
        ?>
    </tbody>
</table>
    
<script src="script.js"></script>
</body>
</html>