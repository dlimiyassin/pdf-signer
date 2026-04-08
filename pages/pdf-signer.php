<?php include '../layout/header.php'; ?>

<div class="container">
    <h1>Signer un Relevé de Notes</h1>

    <form action="process-sign.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="pdf" accept="application/pdf" required>
        <button type="submit">Upload & Sign</button>
    </form>
</div>

<?php include '../layout/footer.php'; ?>