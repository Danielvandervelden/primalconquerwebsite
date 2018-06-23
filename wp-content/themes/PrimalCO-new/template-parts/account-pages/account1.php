<div class="table">
    <?php  if($acca === NULL) {
        echo "You have no characters yet!";
            } else { ?>
            <div class="row">
                <div class="cell">AccountName:</div>
                <div class="cell"><?php echo $acca["Name"]; ?></div>
            </div>
            <div class="row">
                <div class="cell">Total Silver:</div>
                <div class="cell"><?php echo $acca["Money"]; ?></div>
            </div>
            <div class="row">
                <div class="cell">Account Status:</div>
                <div class="cell"><?php 
                if($acca['Online'] === 1) {
                    echo "Online";
                    } else {
                    echo "Offline";
                    } ?></div>
            </div>
            <div class="row">
                <div class="cell">Sex:</div>
                <div class="cell"><?php echo Sex($acca['Body']); ?></div>
            </div>
            <?php    } ?>
    
</div>