<div class="table">
            <div class="row">
                <div class="cell">AccountName:</div>
                <div class="cell"><?php echo $acca2["Name"]; ?></div>
            </div>
            <div class="row">
                <div class="cell">Total Silver:</div>
                <div class="cell"><?php echo $acca2["Money"]; ?></div>
            </div>
            <div class="row">
                <div class="cell">Account Status:</div>
                <div class="cell"><?php 
                if($acca2['Online'] === 1) {
                    echo "Online";
                    } else {
                    echo "Offline";
                    } ?></div>
            </div>
            <div class="row">
                <div class="cell">Sex:</div>
                <div class="cell"><?php echo Sex($acca2['Body']); ?></div>
            </div>   
</div>