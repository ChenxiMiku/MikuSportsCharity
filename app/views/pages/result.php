<?php include '../app/views/layouts/head.php'; ?>

<body>
    <?php include '../app/views/layouts/header.php'; ?>
    <?php include '../app/views/layouts/navbar.php'; ?>

    <main>
        <section class="section-padding">
            <div class="container">
                <h2 class="text-center mb-4">Result</h2>
                <p>Payment Successful!</p>
                <p>If you have any questions or concerns, please contact us at <a href="mailto:<?php echo htmlspecialchars($email); ?>">
                        <?php echo htmlspecialchars($email); ?>
                    </a> or call us at <a href="tel:<?php echo htmlspecialchars($phone); ?>"> <?php echo htmlspecialchars($phone); ?></a>.</p>
    </main>

    <?php include '../app/views/layouts/footer.php'; ?>
    <?php include '../app/views/layouts/cookies.php'; ?>
</body>

</html>