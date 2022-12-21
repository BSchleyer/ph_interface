<?php
    $session = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

    echo "
    <!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
</head>
<body>
    Please wait while loading...
    <script src=\"https://js.stripe.com/v3/\"></script>
    <script>
    var stripe = Stripe('" . $config->getconfigvalue('stripe_pk') . "');
    stripe.redirectToCheckout({
        sessionId: '$session'
    }).then(function (result) {
        alert(result);
    });
    </script>
</body>
</html>
    ";
?>
