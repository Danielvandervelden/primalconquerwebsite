<table class="table">
            <tr>
                <td>AccountName:</td>
                <td><?php echo $acca7["Name"]; ?></td>
            </tr>
            <tr>
                <td>Total Silver:</td>
                <td><?php echo $acca7["Money"]; ?></td>
            </tr>
            <tr>
                <td>Account Status</td>
                <td><?php 
                if($acca7['Online'] === 1) {
                    echo "Online";
                    } else {
                    echo "Offline";
                    } ?></td>
            </tr>
            <tr>
                <td>Sex</td>
                <td><?php echo Sex($acca7['Body']); ?></td>
            </tr>    
</table>