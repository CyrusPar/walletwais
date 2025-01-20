<?php

// Include the header layout
include realpath(__DIR__ . '/app/layout/header.php');

// Check if the form has been submitted
if (isset($_POST['update'])) {
    // Retrieve the submitted data from the form
    $data = $_POST['data'];
    $dataId = $_POST['data_id'];

    // Validate that the data is not empty
    if (empty($data)) {
        // If the data is empty, add an error message to the $invalid array
        array_push($invalid, "Data should not be empty.");
    } else {
        // Attempt to update the provided data in the database
        $update = $modelsFacade->update($data, $dataId);
        
        // Check if the update was successful
        if ($update) {
            // If successful, add a success message to the $success array
            array_push($success, "Data has been updated successfully.");
        }
    }
}

?>

<?php include realpath(__DIR__ . '/errors.php') ?>
<form action="create.php" method="post">
    <?php
    $read = $modelsFacade->read();
    foreach ($read as $data) { ?>
        <input type="text" placeholder="Data" name="data" value="<?= $data['data'] ?>">
        <input type="hidden" name="data_id" value="<?= $data['id'] ?>">
        <button type="submit" name="update">Update</button>
    <?php } ?>
</form>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>