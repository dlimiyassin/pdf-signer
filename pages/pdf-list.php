<?php include '../layout/header.php'; ?>

<div class="container">
    <h1>Liste des Relevés de Notes</h1>

    <table>
        <tr>
            <th>File</th>
            <th>Action</th>
        </tr>

        <?php
        $files = glob("../signed/*.pdf");

        foreach ($files as $file) {
            $fileName = basename($file);

            echo "<tr>
                <td>$fileName</td>
                <td>
                    <a href='$file' target='_blank'>View</a> |
                    <a href='delete.php?file=$fileName' onclick=\"return confirm('Delete this file?')\">Delete</a>
                </td>
            </tr>";
        }
        ?>

    </table>
</div>

<?php include '../layout/footer.php'; ?>