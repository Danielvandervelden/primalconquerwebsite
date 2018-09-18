var donationAmount;
 
 $('#donation-amount').keyup(function() {
     donationAmount = Number($('#donation-amount').val());
 })
     // Render the PayPal button
 paypal.Button.render({

// Set your environment

env: 'sandbox', // sandbox | production

// Specify the style of the button

style: {
    layout: 'vertical',  // horizontal | vertical
    size:   'medium',    // medium | large | responsive
    shape:  'rect',      // pill | rect
    color:  'gold'       // gold | blue | silver | black
},

// Specify allowed and disallowed funding sources
//
// Options:
// - paypal.FUNDING.CARD
// - paypal.FUNDING.CREDIT
// - paypal.FUNDING.ELV

funding: {
    allowed: [ paypal.FUNDING.CARD, paypal.FUNDING.CREDIT ],
    disallowed: [ ]
},

// PayPal Client IDs - replace with your own
// Create a PayPal app: https://developer.paypal.com/developer/applications/create

client: {
    sandbox:    'ATShcGVgsH1xyn04dH_bT0Bbe9D0gBx6fVq012aY4EBe9SCj4G_hFNJcAz-3Kzjo02NF6QCyylmJq_bb',
    production: '<insert production client id>'
},

payment: function(data, actions) {
    return actions.payment.create({
        payment: {
            transactions: [
                {
                    amount: { total: donationAmount, currency: 'EUR' }
                }
            ]
        }
    });
},

onAuthorize: function(data, actions) {
    return actions.payment.execute().then(function() {
        console.log(data);
        $.post('/wp-content/themes/PrimalCO-new/page-donate-success.php', {paymentID: data.paymentID})
        	
        setTimeout(function() {window.location.href = "http://www.primalconquer.com.test/donate-success"}, 3000);
    });
}

}, '#paypal-button-container');