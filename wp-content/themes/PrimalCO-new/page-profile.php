<?php get_header();
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


// find out gender of the character
function Sex ($magic1) {
if ($magic1==1003)  return 'Male[S]';
if ($magic1==1002)  return 'Female[S]';
if ($magic1==2003)  return 'Male[B]';
if ($magic1==2002)  return 'Female[B]';

return (Empty($magic1) ? '' : 'None'); 
}

?>

<div class="main-content-container profile">
    <main>
     <div class="flex" style="background-image: url('<?php echo $GLOBALS['contentImage'] ?>');">

     <div class="single-post-container flex-100">
       <?php if($loggedin) { ?>
        
        <div class="tab-container">
            <div class="selection-menu">
                <ul>
                    <li class="menu-tab active">Characters</li>
                    <li class="menu-tab">Change Password</li>
                    <li class="menu-tab">Change Email</li>
                </ul>
            </div>

            <div class="tab characters active-tab">
            <?php if($acca != NULL) { ?>
                <div class="left-div-tabcontainer"> 
                    <ul>
                        <?php 
                        if($acca['Name'] != NULL) {
                            echo "<li class=' active inner-menu-tab'>" . $acca['Name'] . "</li>";
                        }
                        if($acca2['Name'] != NULL) {
                            echo "<li class='inner-menu-tab'>" . $acca2['Name'] . "</li>";
                        }
                        if($acca3['Name'] != NULL) {
                            echo "<li class='inner-menu-tab'>" . $acca3['Name'] . "</li>";
                        }
                        if($acca4['Name'] != NULL) {
                            echo "<li class='inner-menu-tab'>" . $acca4['Name'] . "</li>";
                        }
                        if($acca5['Name'] != NULL) {
                            echo "<li class='inner-menu-tab'>" . $acca5['Name'] . "</li>";
                        }
                        if($acca6['Name'] != NULL) {
                            echo "<li class='inner-menu-tab'>" . $acca6['Name'] . "</li>";
                        }
                        if($acca7['Name'] != NULL) {
                            echo "<li class='inner-menu-tab'>" . $acca7['Name'] . "</li>";
                        }
                        if($acca8['Name'] != NULL) {
                            echo "<li class='inner-menu-tab'>" . $acca8['Name'] . "</li>";
                        }
                         ?>
                    </ul>
                </div>
                <?php  } ?>

                <div class="right-div-tabcontainer">
                    <div class="char-info display">
                    <?php require 'template-parts/account-pages/account1.php' ?>
                    </div>

                    <div class="char-info">
                    <?php require 'template-parts/account-pages/account2.php' ?>
                    </div>

                    <div class="char-info">
                    <?php require 'template-parts/account-pages/account3.php' ?>
                    </div>

                    <div class="char-info">
                    <?php require 'template-parts/account-pages/account4.php' ?>
                    </div>

                    <div class="char-info">
                    <?php require 'template-parts/account-pages/account5.php' ?>
                    </div>

                    <div class="char-info">
                    <?php require 'template-parts/account-pages/account6.php' ?>
                    </div>

                    <div class="char-info">
                    <?php require 'template-parts/account-pages/account7.php' ?>
                    </div>

                    <div class="char-info">
                    <?php require 'template-parts/account-pages/account7.php' ?>
                    </div>

                </div>
            </div>

            <div class="tab change-password">
                <?php echo get_template_part('template-parts/change-pass'); ?>
            </div>

            <div class="tab change-email">
                 <?php echo get_template_part('template-parts/change-email'); ?>
            </div>
        </div>



     <?php  } else { ?>  <?php } ?>
     </div>
    </main>
</div>

<?php get_footer()?>
