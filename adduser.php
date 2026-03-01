<?php
    $connection = mysqli_connect('localhost', 'root', 'root', 'portfolio', 8889);

    $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    $errors = array();

    $fname = mysqli_real_escape_string($connection, $_POST['fname']);
    if ($fname == NULL) {
        $errors[] = "First name field is empty.";
    }

    $lname = mysqli_real_escape_string($connection, $_POST['lname']);
    if ($lname == NULL) {
        $errors[] = "Last name field is empty.";
    }

    $email = $_POST['email'];
    if ($email == NULL) {
        $errors[] = "Email field is empty.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "\"" . $email . "\" is not a valid email address.";
    }

    $message = mysqli_real_escape_string($connection, $_POST['message']);
    if ($message == NULL) {
        $errors[] = "Message field is empty.";
    }

    $errcount = count($errors);
    if ($errcount > 0) {
        $errmsg = array();
        for ($i = 0; $i < $errcount; $i++) {
            $errmsg[] = $errors[$i];
        }
        echo json_encode(array("errors" => $errmsg));
    } else {
        $querystring = "INSERT INTO tbl_user(user_fname, user_lname, user_email, user_message) VALUES(NULL,'" . $fname . "','" . $lname . "','" . $email . "','" . $message . "')";
        $qpartner = mysqli_query($connection, $querystring);
        echo json_encode(array("message" => "Email submitted. I look forward to connecting!"));
    }
?>