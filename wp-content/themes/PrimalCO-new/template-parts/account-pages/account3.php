<table class="table">
            <tr>
                <td>AccountName:</td>
                <td><?php echo $acca3["Name"]; ?></td>
            </tr>
            <tr>
                <td>Total Silver:</td>
                <td><?php echo $acca3["Money"]; ?></td>
            </tr>
            <tr>
                <td>Account Status</td>
                <td><?php 
                if($acca3['Online'] === 1) {
                    echo "Online";
                    } else {
                    echo "Offline";
                    } ?></td>
            </tr>
            <tr>
                <td>Sex</td>
                <td><?php echo Sex($acca3['Body']); ?></td>
            </tr>
</table>