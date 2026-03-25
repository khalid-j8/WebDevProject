<?php
$pageTitle = 'Contact | Luxury Vehicle Store';
$currentPage = 'contact';
include __DIR__ . '/includes/header.php';

$host = '127.0.0.1';
$dbname = 'luxury_vehicle_store';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name'] ?? '');
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $message = $conn->real_escape_string($_POST['message'] ?? '');

    if (!empty($name) && !empty($email) && !empty($message)) {
        $sql = "INSERT INTO contacts (name, email, message) 
                VALUES ('$name', '$email', '$message')";

        if ($conn->query($sql) === TRUE) {
            $success = true;
        }
    }
}
?>

<main class="content-page">
    <section class="page-hero">
        <p class="eyebrow">Contact Us</p>
        <h2>Contact our team for help about pricing, financing, and availability</h2>
        <p class="page-intro">
            Get in touch with our team to schedule a showroom visit, vehicle reservations, or any questions about our services.
        </p>
    </section>

    <?php if ($success): ?>
        <p style="color: green; text-align:center;">Thank You! Your message has been received</p>
    <?php endif; ?>

    <section class="content-grid">
        <article class="content-card">
            <span class="section-tag">Showroom</span>
            <h3>Showroom Hours</h3>
            <p>Monday to Friday, 10:00 AM to 7:00 PM. Saturday and Sunday, 10:00 AM to 3:00 PM. Private appointments are available upon request through calling or emailing.</p>
        </article>

        <article class="content-card">
            <span class="section-tag">Connect</span>
            <h3>Client Support</h3>
            <p>Email us at support@luxuryvehicles.com or call 734-203-2005 for questions or luxury assistance.</p>
        </article>
    </section>

    <section class="content-card" style="margin-top: 30px;">
        <h3>Send Us a Message</h3>

        <form method="POST">
            <label>Name</label><br>
            <input type="text" name="name" required><br><br>

            <label>Email</label><br>
            <input type="email" name="email" required><br><br>

            <label>Message</label><br>
            <textarea name="message" rows="5" required></textarea><br><br>

            <button type="submit">Send Message</button>
        </form>
    </section>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
