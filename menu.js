// Fungsi untuk menambah jumlah produk
function increaseQuantity(input) {
    let quantity = parseInt(input.value);
    input.value = quantity + 1;
}

// Fungsi untuk mengurangi jumlah produk
function decreaseQuantity(input) {
    let quantity = parseInt(input.value);
    if (quantity > 1) {
        input.value = quantity - 1;
    }
}

// Fungsi untuk menambahkan produk ke keranjang
function addToCart(productName, price, quantityInput) {
    const quantity = parseInt(quantityInput.value);
    alert(`Anda telah menambahkan ${quantity} x ${productName} ke keranjang dengan total harga Rp. ${(price * quantity).toLocaleString()}`);
}

// Event listener untuk tombol plus, minus, dan tambah ke keranjang
document.addEventListener("DOMContentLoaded", () => {
    const minusButtons = document.querySelectorAll(".minus-btn");
    const plusButtons = document.querySelectorAll(".plus-btn");
    const addToCartButtons = document.querySelectorAll(".add-to-cart-btn");

    minusButtons.forEach(button => {
        button.addEventListener("click", (e) => {
            const input = e.target.nextElementSibling;
            decreaseQuantity(input);
        });
    });

    plusButtons.forEach(button => {
        button.addEventListener("click", (e) => {
            const input = e.target.previousElementSibling;
            increaseQuantity(input);
        });
    });

    addToCartButtons.forEach(button => {
        button.addEventListener("click", (e) => {
            const product = e.target.closest(".product");
            const productName = product.querySelector("h2").textContent;
            const price = parseInt(product.querySelector(".price").textContent.replace("Rp. ", "").replace(",", ""));
            const quantityInput = product.querySelector("input[type='number']");
            addToCart(productName, price, quantityInput);
        });
    });
});