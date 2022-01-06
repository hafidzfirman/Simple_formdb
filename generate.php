<?php

require_once('functions.php');

$first_names = array( 'Anne', 'Beth', 'Charlie', 'Doodoo', 'Chtulhu', 'Zach' );
$last_names = array( 'Allspark', 'LMAO', 'of the End', 'the Ringmaster' );

$street_names = array( 'Alexandria', 'Lindbulm', 'Kapasan' );
$street_names_ext = array( '', 'Lor', 'Wetan' );

$email_providers = array( 'google.com', 'yahoo.com', 'downloadfreeram.com', 'thenftbay.org' );

$limit = 20;
$counter = 0;

while( $counter < $limit ) {
    $full_name = $first_names[array_rand($first_names)] . ' ' . $last_names[array_rand($last_names)];
    $full_address = $street_names[array_rand($street_names)] . ' ' . $street_names_ext[array_rand($street_names_ext)] . ' No ' . mt_rand(1,99);
    $full_birthday = date('Y-m-d', mt_rand(915123601,1009817999));
    $full_email = slugify(strtolower($full_name)) . '@' . $email_providers[array_rand($email_providers)];
    $full_phone = '6285' . str_pad(mt_rand(0,999999999),9,'0',STR_PAD_LEFT);

    masukkanKeDB(
        $full_name,
        $full_address,
        $full_birthday,
        $full_email,
        $full_phone
    );
    $counter++;
}