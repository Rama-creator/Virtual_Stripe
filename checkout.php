<?php
include("connection.php");
include "vendor\autoload.php";
?>
<h1>Stripe Integration</h1>
<div class="row">
    <div class="col=lg=12">
        <form action="" method="post">
            <div>
                <label>Card Number</label>
                <input type="text" size="20" name="cardnumber" value="4242424242424242" />
            </div>
            <div>
                <label>Expiration (MM/YYYY)</label>
                <input type="text" size="2" name="expirymonth" value="8" />
                <span> / </span>
                <input type="text" size="4" name="expiryyear" value="2022" />
            </div>
            <di>
                <label>Amount</label>
                <input type="text" size="4" name="amount" />
            </di>
            <button type="submit" name="btnsubmit">Submit Payment</button>
        </form>
    </div>
</div>

<?php
if (isset($_POST["btnsubmit"])) :
    $stripe = new api();
    $data = [
        "number" => $_POST["cardnumber"],
        "exp_month" => $_POST["expirymonth"],
        "exp_year" => $_POST["expiryyear"],
        "amount" => $_POST["amount"]
    ];

    echo $stripe->checkout($data);
endif
?>