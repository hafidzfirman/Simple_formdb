<?php
define( 'DB_HOST', 'localhost' );
define( 'DB_NAME', 'form_DB' );
define( 'DB_USER', 'root' );
define( 'DB_PASS', '' );

define( 'HOME_DIR', 'http://192.168.1.20/hafidz/simple-form-to-db/' );


function masukkanKeDB($name,$address,$birthday,$email,$phone) {
    $name = simple_validation($name);
    $address = simple_validation($address);
    $birthday = simple_validation($birthday);
    $email = simple_validation($email);
    $phone = simple_validation($phone);

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sql = "INSERT INTO Tabel (name, address, birthday, email, phone)
            VALUES ('$name', '$address', '$birthday', '$email', '$phone')";
    if ($conn->query($sql) === TRUE) {
        echo '<div class="psa psa-g">New record created successfully.</div>';
    } else {
        echo '<div class="psa psa-r">Error: ' . $sql . '<br>' . $conn->error . '</div>';
    }
    $conn->close();
}

function editKontenDB($id,$name,$address,$birthday,$email,$phone) {
    $name = simple_validation($name);
    $address = simple_validation($address);
    $birthday = simple_validation($birthday);
    $email = simple_validation($email);
    $phone = simple_validation($phone);

	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$sql = "UPDATE Tabel SET name='$name', address='$address', birthday='$birthday', email='$email', phone='$phone' WHERE id=$id";
	if ($conn->query($sql) === TRUE) {
		echo '<div class="psa psa-g">Record successfully updated. <a href="'.HOME_DIR.'">Return to main form.</a></div>';
	} else {
		echo '<div class="psa psa-r">Error: ' . $sql . '<br>' . $conn->error . '</div>';
	}
	$conn->close();
};

function simple_validation($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function reformatDate($date,$format='F jS, Y') {
    $newDate = date($format, strtotime($date));  
    return $newDate;  
}

function age($birthday) {
    $age = date_create($birthday)->diff(date_create('today'))->y;
    return $age;
}

function slugify($text) {
    // Strip html tags
    $text=strip_tags($text);
    // Replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    // Transliterate
    setlocale(LC_ALL, 'en_US.utf8');
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // Remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    // Trim
    $text = trim($text, '-');
    // Remove duplicate -
    $text = preg_replace('~-+~', '-', $text);
    // Lowercase
    $text = strtolower($text);
    // Check if it is empty
    if (empty($text)) { return 'n-a'; }
    // Return result
    return $text;
}