<?php
include "../includes/config.php";
include "../includes/check_session.php";

if (isset($_POST['device_type'])) {
    $device_type = $_POST['device_type'];

    $query = mysqli_query($conn, "SELECT * from brand WHERE device_type='$device_type'");
?>
    <option value="" selected disabled>--select a brand--</option>

    <?php
    while ($row = mysqli_fetch_array($query)) {
    ?>
        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
<?php
    }
}
