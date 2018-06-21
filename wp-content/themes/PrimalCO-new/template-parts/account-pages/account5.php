<table class="table">
            <tr>
                <td>AccountName:</td>
                <td><?php echo $acca5["Name"]; ?></td>
            </tr>
            <tr>
                <td>Total Silver:</td>
                <td><?php echo $acca5["Money"]; ?></td>
            </tr>
            <tr>
                <td>Account Status</td>
                <td><?php 
                if($acca5['Online'] === 1) {
                    echo "Online";
                    } else {
                    echo "Offline";
                    } ?></td>
            </tr>
            <tr>
                <td>Sex</td>
                <td><?php echo Sex($acca5['Body']); ?></td>
            </tr>    
</table>