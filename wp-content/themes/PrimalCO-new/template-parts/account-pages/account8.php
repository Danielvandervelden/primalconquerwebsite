<table class="table">
            <tr>
                <td>AccountName:</td>
                <td><?php echo $acca8["Name"]; ?></td>
            </tr>
            <tr>
                <td>Total Silver:</td>
                <td><?php echo $acca8["Money"]; ?></td>
            </tr>
            <tr>
                <td>Account Status</td>
                <td><?php 
                if($acca8['Online'] === 1) {
                    echo "Online";
                    } else {
                    echo "Offline";
                    } ?></td>
            </tr>
            <tr>
                <td>Sex</td>
                <td><?php echo Sex($acca8['Body']); ?></td>
            </tr>    
</table>