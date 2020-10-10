let delivery = parseInt(document.getElementById('working').value);
let price = parseInt(document.getElementById('standard').value);
function setDelivery(id) {
    delivery = parseInt(document.getElementById(id).value);
    total = delivery + price;
    document.getElementById('total').value = "Total " + total + " € (delivery included)";
}


function setTotal(id) {
    price = parseInt(document.getElementById(id).value);
    total = delivery + price;
    document.getElementById('total').value = "Total " + total + " € (delivery included)";
}

