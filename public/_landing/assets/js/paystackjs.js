function payWithPaystack(amount,email,name) {
    var table = $('select#table-number').val();
    alert(table);
    var handler = PaystackPop.setup({
        key: 'pk_test_3f1815e799566268d3a5f2f3314e214b8aa68fda',
        email: email,
        amount: amount,
        currency: "NGN",
        ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        metadata: {
            custom_fields: [
                {
                    display_name: name,
                    variable_name: "mobile_number",
                    value: "+2348102780566"
                }
            ]
        },
        callback: function (response) {
            alert('success. transaction ref is ' + response.reference);
        },
        onClose: function () {
            alert('window closed');
        }
    });
    handler.openIframe();
}
