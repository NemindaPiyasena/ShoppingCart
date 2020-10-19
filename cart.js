if(document.getElementById('add-cart-btn')) {
    const cartBtn = document.getElementById('add-cart-btn');
    cartBtn.addEventListener('click', function () {
        $.ajax({
            method: 'post',
            url: 'addCart.php',
            async: false,
            dataType: 'json',
            encode: true,
        }).done(function (data) {
            if(data.status) {
                alert('added');
            } else {
                alert('there was an error');
            }
        });
    });
}