<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $recipient = 'muncaster.josie@gmail.com';

        $subject = 'Inquiry from mydomain.com';

        $first_raw = $_POST['first_name'] ?? '';
        $last_raw = $_POST['last_name'] ?? '';
        $email_raw = $_POST['email'] ?? '';
        $msg_raw = $_POST['message'] ?? '';

        $first = trim(strip_tags($first_raw));
        $last = trim(strip_tags($last_raw));

        $visitor_name = trim($first.' '.$last);

        $email_clean = str_replace(["\r", "\n", "%0a", "%0d"],'',
        trim($email_raw));

        $visitor_email = filter_var($email_clean, 
        FILTER_VALIDATE_EMAIL);

        $message = trim(strip_tags($msg_raw));

        $fail = [];

        if($first === '') {
            $fail[] = 'first_name';
        }

        if($last === '') {
            $fail[] = 'last_name';
        }

        if(!$visitor_email) {
            $fail[] = 'email';
        }

        if($message === '') {
            $fail[] = 'message';
        }

        if (!empty($fail)) {
            echo '<p><strong>Validation failed:</strong></p>';
            echo '<p>Please fix:' . htmlspecialchars(implode(', ', $fail), ENT_QUERIES, 'UTF-8').'<p>';
            exit;
        }

        $emailBody = "You received a new inquiry:\r\n\r\n";
        $emailBody .= "Name: {$visitor_name}\r\n";
        $emailBody .= "Email: {$visitor_email}\r\n\r\n";
        $emailBody .= "Message:\r\n{$message}\r\n";

        $fromAddress = "no-reply@muncaster.com";

        $headers = "From: Jo Muncaster <{$fromAddress}>\r\n";
        $headers .= "Reply-To: {$visitor_email}\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

        $sent = mail($recipient, $subject, $emailBody, $headers);

        if($sent) {
            $thankyou = urlencode("Your message won’t disappear into the void — I promise. I’ll get back to you soon (likely with coffee in hand).");
            header("Location: contact.php?msg=$thankyou");
            exit();
        } else {
            $thankyou = urlencode("Sorry your message was not sent! Please try again later.");
            header("Location: contact.php?msg=$thankyou");
            exit();
        }

    } else {
        echo "<p>Something didn’t load as expected. I’m on it — try refreshing the page, or head back to the homepage to keep exploring.</p>";
    }
?>