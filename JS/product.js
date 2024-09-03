function decreaseQuantity() {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
    }
    updateQuantity();
}

function increaseQuantity() {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);
    quantityInput.value = currentQuantity + 1;
    updateQuantity();
}

function updateQuantity() {
    var quantity = document.getElementById('quantity').value;
    // เก็บค่าจำนวนสินค้าใน localStorage
    localStorage.setItem('product_quantity', quantity);
}
function decreaseQuantity() {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
    }
    updateTotalPrice();
}

function increaseQuantity() {
    var quantityInput = document.getElementById('quantity');
    quantityInput.value = parseInt(quantityInput.value) + 1;
    updateTotalPrice();
}

function updateTotalPrice() {
    var price = parseFloat(document.getElementById('price').innerText);
    var quantity = parseInt(document.getElementById('quantity').value);
    var totalPrice = price * quantity;
}