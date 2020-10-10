let delivery = parseInt(document.getElementById('working').value);
let price = parseInt(document.getElementById('standard').value);

function setDelivery(id) {
    delivery = parseInt(document.getElementById(id).value);
    total = delivery + price;
    document.getElementById('total').value = "Total " + total + " € (delivery included)";
}


function setTotal(id) {
    price = parseInt(document.getElementById(id).value);
    current = document.getElementById('currentItem');
    total = delivery + price;
    document.getElementById('total').value = "Total " + total + " € (delivery included)";
    current.value = price;
    current.style.width = current.value.length * 8 + 'px';
}

function setRemaining() {
    textbox = document.getElementById('remain');
    textarea = document.getElementById('message');
    remain = 600 - textarea.value.length;
    if(remain < 0) {
        return;
    }
    textbox.value = remain;
    textbox.style.width = textbox.value.length * 7 + 'px';
}

