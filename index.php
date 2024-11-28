<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Web</title>
    <link rel="icon" type="image/x-icon" href="assets/icon/favicon.ico">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact-form.css">
    
</head>

<body>
    <!-- Include Navbar -->
    <?php include 'components/navbar.html'; ?>

    <!-- Main Content -->
    <main>
        <?php include 'components/main.html'; ?>
        <?php include 'components/site.html';?>
        <?php include 'components/introduction.html'; ?>
        <?php include 'components/contact-form.php'; ?>
    </main>

    <!-- Include Footer -->
    <?php include 'components/footer.html'; ?>
    <script src="js/main.js"></script>
</body>

</html>
