<?php get_header()?>

<?php 
require 'database/db.php';

$loggedin = $_SESSION['logged-in'];
$username = $_SESSION['username'];

$data = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM accounts WHERE Username='$username'"));
$char1 = $data['Character1'];
$char2 = $data['Character2'];
$char3 = $data['Character3'];
$char4 = $data['Character4'];
$char5 = $data['Character5'];
$char6 = $data['Character6'];
$char7 = $data['Character7'];
$char8 = $data['Character8'];


$acca = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM characters WHERE UID='$char1'"));
$acca2 = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM characters WHERE UID='$char2'"));
$acca3 = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM characters WHERE UID='$char3'"));
$acca4 = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM characters WHERE UID='$char4'"));
$acca5 = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM characters WHERE UID='$char5'"));
$acca6 = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM characters WHERE UID='$char6'"));
$acca7 = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM characters WHERE UID='$char7'"));
$acca8 = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM characters WHERE UID='$char8'"));
?>

<div class="main-content-container single">
    <div class="padding-top padding-bottom padding-sides">
        <?php if($loggedin) { ?>

        <form action="/donate" method="POST">
            <div class="form-group">
                <label for="character">What character would you like to receive the donation on?</label>
					<select id="character" name="character">
                        <?php 
                        if($acca['Name'] != NULL) {
                            echo "<option value=". $acca['Name'] .">" . $acca['Name'] . "</option>";
                        }
                        if($acca2['Name'] != NULL) {
                            echo "<option value=". $acca2['Name'] .">" . $acca2['Name'] . "</option>";
                        }
                        if($acca3['Name'] != NULL) {
                            echo "<option value=". $acca3['Name'] .">" . $acca3['Name'] . "</option>";
                        }
                        if($acca4['Name'] != NULL) {
                            echo "<option value=". $acca4['Name'] .">" . $acca4['Name'] . "</option>";
                        }
                        if($acca5['Name'] != NULL) {
                            echo "<option value=". $acca5['Name'] .">" . $acca5['Name'] . "</option>";
                        }
                        if($acca6['Name'] != NULL) {
                            echo "<option value=". $acca6['Name'] .">" . $acca6['Name'] . "</option>";
                        }
                        if($acca7['Name'] != NULL) {
                            echo "<option value=". $acca7['Name'] .">" . $acca7['Name'] . "</option>";
                        }
                        if($acca8['Name'] != NULL) {
                            echo "<option value=". $acca8['Name'] .">" . $acca8['Name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <input type="number" name="donation_amount" />
                </div>
            <button name="submit_donation" type="submit" class="btn btn-primary">Donate</button>
        </form>
            <?php } else { ?>
                <div class="white">You need to be logged in to use this feature!</div>
            <?php } ?>
    </div>
</div>

<?php get_footer()?>
