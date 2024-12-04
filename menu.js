document.addEventListener("DOMContentLoaded", function () {
    // Menangani tombol tambah dan kurang jumlah produk
    const buttons = document.querySelectorAll(".product-actions button");
    buttons.forEach((button) => {
        button.addEventListener("click", function () {
            const input = this.parentNode.querySelector("input[type='number']");
            let currentValue = parseInt(input.value);

            if (this.textContent === "+") {
                currentValue++;
            } else if (this.textContent === "-" && currentValue > 1) {
                currentValue--;
            }

            input.value = currentValue;
        });
    });

    // Menangani tombol Tambahkan ke Keranjang
    const addToCartButtons = document.querySelectorAll(".add-to-cart");
    addToCartButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const productName = this.closest(".product-info").querySelector("h3").textContent;
            const quantity = this.closest(".product-actions").querySelector("input").value;

            alert(`${productName} sejumlah ${quantity} telah ditambahkan ke keranjang!`);
            console.log(`Produk: ${productName}, Jumlah: ${quantity}`);
        });
    });
});
