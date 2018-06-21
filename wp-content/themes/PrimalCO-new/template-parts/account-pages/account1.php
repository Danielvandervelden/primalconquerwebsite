<table class="table">
    <?php  if($acca === NULL) {
        echo "You have no characters yet!";
            } else { ?>
            <tr>
                <td>AccountName:</td>
                <td><?php echo $acca["Name"]; ?></td>
            </tr>
            <tr>
                <td>Total Silver:</td>
                <td><?php echo $acca["Money"]; ?></td>
            </tr>
            <tr>
                <td>Account Status</td>
                <td><?php 
                if($acca['Online'] === 1) {
                    echo "Online";
                    } else {
                    echo "Offline";
                    } ?></td>
            </tr>
            <tr>
                <td>Sex</td>
                <td><?php echo Sex($acca['Body']); ?></td>
            </tr>
            <?php    } ?>
    
</table>