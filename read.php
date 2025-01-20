<?php include realpath(__DIR__ . '/app/layout/header.php') ?>

<table>
    <thead>
        <th>Data</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php
        $read = $modelsFacade->read();
        foreach ($read as $data) { ?>

            <tr>
                <td><?= $data['data']?></td>
                <td>
                    <a href="update.php?id=<?= $data['id'] ?>">Update</a>
                    <a href="delete.php?id=<?= $data['id'] ?>">Delete</a>
                </td>
            </tr>

        <?php } ?>
    </tbody>
</table>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>