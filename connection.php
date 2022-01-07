<?php


class api
{
    public $conn;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "plus62coffee";

        \Stripe\Stripe::setApiKey("sk_test_51KDgmfBYa1Nre4oSVIzEByQHgH8iSvTjNt3tLWfFLCr8PV1Duq8CmML6mJInv5wZZkzqJf2NJenWMCOWwthm2lFb008FypA1e6");
        try {
            $this->conn = new PDO(
                "mysql:host=$servername;dbname=$database",
                $username,
                $password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Failed : " . $e->getMessage();
        }
    }

    public function checkout($data)
    {
        $message = "";
        try {
            $mycard = array(
                'number' => $data['number'],
                'exp_month' => $data['exp_month'],
                'exp_year' => $data['exp_year']
            );

            $charge = \Stripe\Charge::create(array('card' => $mycard, 'amount' => ($data['amount'] * 100), 'currency' => 'usd'));

            $message = $charge->status;
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
        return $message;
    }
}
