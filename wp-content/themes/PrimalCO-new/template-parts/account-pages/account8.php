<div class="table">
            <div class="row">
                <div class="cell">AccountName:</div>
                <div class="cell"><?php echo $acca8["Name"]; ?></div>
            </div>
            <div class="row">
                <div class="cell">Total Silver:</div>
                <div class="cell"><?php echo $acca8["Money"]; ?></div>
            </div>
            <div class="row">
                <div class="cell">Account Status:</div>
                <div class="cell"><?php 
                if($acca8['Online'] === 1) {
                    echo "Online";
                    } else {
                    echo "Offline";
                    } ?></div>
            </div>
            <div class="row">
                <div class="cell">Sex:</div>
                <div class="cell"><?php echo Sex($acca8['Body']); ?></div>
            </div>   
</div>