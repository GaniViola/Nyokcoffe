<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-3eR_7kGRG_3Gxsje"></script>
</head>
<body>
    <button id="pay-button">Pay Now</button>

    <script>
        const payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            window.snap.pay('<?= $data['snapToken']; ?>', {
                onSuccess: function (result) {
                    console.log(result);
                    alert("Payment success!");
                    window.location.href = "<?= BASEURL; ?>/MidtransController/success?order_id=" + result.order_id;
                },
                onPending: function (result) {
                    console.log(result);
                    alert("Waiting for payment!");
                },
                onError: function (result) {
                    console.log(result);
                    alert("Payment failed!");
                },
                onClose: function () {
                    alert("Payment popup closed without finishing the transaction.");
                },
            });
        });
    </script>
</body>
</html>
