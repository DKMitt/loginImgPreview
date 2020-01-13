<?php

// if (isset($_POST['save-user'])) {
//     echo "<pre>", print_r($_POST), "</pre>";  //displays all variable from post data
//     echo "<pre>", print_r($_FILES), "</pre>"; // displays image or file data
//     echo "<pre>", print_r($_FILES['profileImage']), "</pre>";  //displays image of file data for profileImage
//     echo "<pre>", print_r($_FILES['profileImage']['name']), "</pre>"; //displays image of file data for profileImage name
//     die();
// }

$msg = "";
$css_class = "";

$conn = mysqli_connect('localhost', 'root', 'password', 'bio_test', '3308');

if (isset($_POST['save-user'])) {
    echo "<pre>", print_r($_FILES['profileImage']['name']), "</pre>";

    $bio = $_POST['bio'];
    $profileImageName = time() . '_' . $_FILES['profileImage']['name'];

    $target = 'uploads/' . $profileImageName;

    if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $target)) {
        $sql = "INSERT INTO users (profile_image, bio) VALUES ('$profileImageName', '$bio')";
        if (mysqli_query($conn, $sql)) {
            $msg = "Image uploaded and saved successfully!";
            $css_class = "alert-success";
        } else {
            $msg = "Database Error: Failed save to users table!";
            $css_class = "alert-danger";
        }
    } else {
        $msg = "Failed to upload to target location!";
        $css_class = "alert-danger";
    }
}
