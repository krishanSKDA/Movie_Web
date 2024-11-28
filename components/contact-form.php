
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="container">
    <h1 class="title">Contact Us</h1>
    <p class="subtitle">We'd love to hear from you. Fill out the form below to reach us!</p>
    
    <div class="content">
        <form id="contactForm" class="contact-form" action="backend/send_email.php" method="post">
            <div class="form-row">
                <div class="form-group">
                    <label for="firstName">First Name *</label>
                    <input type="text" id="firstName" name="firstName" placeholder="Enter your first name" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name *</label>
                    <input type="text" id="lastName" name="lastName" placeholder="Enter your last name" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number (optional)">
            </div>
            <div class="form-group">
                <label for="comments">Message *</label>
                <textarea id="comments" name="comments" placeholder="Write your message here" required></textarea>
            </div>
            <div class="form-group checkbox-group">
                <input type="checkbox" id="terms" name="terms" value="accepted" required>
                <label for="terms">I agree to the <a href="#">Terms & Conditions</a></label>
            </div>
            <button type="submit" name="submitForm" class="submit-btn">SUBMIT</button>
        </form>
        
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.3812075643614!2d79.9404323!3d6.844821199999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25069caa2f53b%3A0xe7eae3a8b1f1214d!2seBEYONDS%20eBusiness%20%26%20Digital%20Solutions!5e0!3m2!1sen!2slk!4v1732729897966!5m2!1sen!2slk" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var messageTest = "<?= $_SESSION['status'] ?? ''; ?>";
    if(messageTest != '') {
    Swal.fire({
  title: "Thank You!",
  text: messageTest,
  icon: "success",
});
<?php unset($_SESSION['status']);  ?>
    }
</script>

</body>
</html>