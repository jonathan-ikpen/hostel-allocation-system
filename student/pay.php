<form>
    <script src="https://remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>
    <button type="button" onclick="makePayment()"> Pay </button> 
</form>
<script>
 function makePayment() {
    var form = document.querySelector("#payment-form");
    var paymentEngine = RmPaymentEngine.init({
        key:'QzAwMDAyNzEyNTl8MTEwNjE4NjF8OWZjOWYwNmMyZDk3MDRhYWM3YThiOThlNTNjZTE3ZjYxOTY5NDdmZWE1YzU3NDc0ZjE2ZDZjNTg1YWYxNWY3NWM4ZjMzNzZhNjNhZWZlOWQwNmJhNTFkMjIxYTRiMjYzZDkzNGQ3NTUxNDIxYWNlOGY4ZWEyODY3ZjlhNGUwYTY=',
        transactionId: Math.floor(Math.random()*1101233), // Replace with a reference you generated or remove the entire field for us to auto-generate a reference for you. Note that you will be able to check the status of this transaction using this transaction Id
        customerId: '39832',
        firstName: 'John',
        lastName: 'Doe',
        email: 'john.doe@mailinator.com',
        amount: 15000,
        narration: 'Essential Walking Shoes',
        onSuccess: function (response) {
            console.log('callback Successful Response', response);
        },
        onError: function (response) {
            console.log('callback Error Response', response);
        },
        onClose: function () {
            console.log("closed");
        }
    });
    paymentEngine.showPaymentWidget();
}

// Sample Response        
// {
//     "paymentReference": "280799121130",
//     "processorId": "",
//     "transactionId": "231844",
//     "message": "",
//     "amount": 16461.22
// }
</script>


