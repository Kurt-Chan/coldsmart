<?php
include "../includes/config.php";

if (isset($_POST['brand'])) {
    $device_type = $_POST['device_type'];
    $brand = $_POST['brand'];

    $query = mysqli_query($conn, "SELECT * from model WHERE brand='$brand' AND device_type='$device_type'");
?>
    <option value="" selected disabled>--select a brand--</option>

    <?php
    while ($row = mysqli_fetch_array($query)) {
    ?>
        <option value="<?= $row['id'] ?>"><?= $row['model'] ?></option>
<?php
    }
}
