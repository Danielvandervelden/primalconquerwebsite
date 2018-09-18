<?php get_header()?>

<?php 
require 'database/db.php';
require 'paypal/submit-donation.php';

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
    <form class="no-display" action="/donate-success"><button id="success-button" type="submit">Test</button></form>
    <div class="padding-top padding-bottom padding-sides">
        <?php if($loggedin) { ?>
            
        <div class="white"><p>Hello there! We are very happy to see that you're interested in donating money to our server.
        Please keep in mind that any donation you make CANNOT be refunded under any circumstances. If you 
        are below 18 years old, please make sure you have permission of your caretaker(s). </p>
        
        <p>The currency is in Euro, 1 Euro = 1CPs. Please take note: CPs cannot be traded in game. Their only
        use is the purchase of items in the shopping mall. The items purchased from the shopping mall, however,
        are tradable.</p>

        <p>If you wish to donate, you can do so below. Only WHOLE Euro's are allowed. Any amounts containing decimals
        WILL be rounded. Make sure to double check your payment screen to make sure everything is correct!</p>
        </div>
        <form action="/donate" method="POST">
                <div class="form-group">
                    <input id="donation-amount" type="number" name="donation_amount" min="1" step="1" />
                </div>
            <div id="paypal-button-container"></div>
        </form>
            <?php } else { ?>
                <div class="white">You need to be logged in to use this feature!</div>
            <?php } ?>
    </div>
</div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>


var $ = jQuery;

var donationAmount;
 
 $('#donation-amount').keyup(function() {
     donationAmount = Number($('#donation-amount').val());
 })

 $('#donation-amount').keydown(function(e) {
    var ingnore_key_codes = [188,190];
   if ($.inArray(e.keyCode, ingnore_key_codes) >= 0){
      e.preventDefault();
    }
 })
     // Render the PayPal button
     paypal.Button.render({
  env: 'sandbox', // Optional: specify 'sandbox' environment
  client: {
    sandbox:    'ATShcGVgsH1xyn04dH_bT0Bbe9D0gBx6fVq012aY4EBe9SCj4G_hFNJcAz-3Kzjo02NF6QCyylmJq_bb',
    production: 'xxxxxxxxx'
  },
  commit: true, // Optional: show a 'Pay Now' button in the checkout flow
  payment: function (data, actions) {
    return actions.payment.create({
      payment: {
        transactions: [
          {
            amount: {
              total: Math.round(donationAmount),
              currency: 'EUR'
            }
          }
        ]
      }
    });
  },
  onAuthorize: function (data, actions) {
    // Get the payment details
    return actions.payment.get()
      .then(function (paymentDetails) {
        var donatedAmount = paymentDetails.transactions[0].amount.total;
        
        $.post('/wp-content/themes/PrimalCO-new/paypal/submit-donation.php', {donation: donatedAmount}, function(response) {
            console.log(response);
            toSuccess();            
        })
      });
  }
}, '#paypal-button-container');

function toSuccess() {
    $('#success-button').click();
    console.log('clicked');
}
</script>

<?php get_footer()?>
