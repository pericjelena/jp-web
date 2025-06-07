<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Basic validation
    if ( empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($subject) || empty($message) ) {
        echo "Please fill all fields correctly.";
        exit;
    }

    // Recipient email
    $to = "jelena.peric.24@vipos.edu.rs"; // <-- change this to your email

    // Email subject
    $email_subject = "New Contact Form Message: $subject";

    // Email content
    $email_body = "Ime: $name\n";
    $email_body .= "Email: $email\n\n";
    $email_body .= "Poruka:\n$message\n";

    // Email headers
    $headers = "From: $name <$email>\r\n";

    // Send email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Hvala na poruci! Bićete uskoro kontaktirani.";
    } else {
        echo "Greška prilikom slanja poruke. Molimo pokušajte ponovo.";
    }
} else {
    echo "Nevalidan zahtev.";
}
?>