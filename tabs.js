const tabs = document.querySelectorAll('.tab');
const content = document.getElementById('content');

const tabContent = {
    belumDibayar: `
        <img src="placeholder.png" alt="No Orders">
        <p>Belum ada pesanan yang dibayar. Yuk, segera lunasi pesananmu!</p>
        <a href="#" class="btn">Bayar Sekarang</a>
    `,
    pesananAktif: `
        <img src="placeholder.png" alt="No Orders">
        <p>Kamu belum punya pesanan nih<br>Segera pesan dan selamatkan makanan favoritmu</p>
        <a href="#" class="btn">Pesan Sekarang</a>
    `,
    pesananSelesai: `
        <img src="placeholder.png" alt="Completed Orders">
        <p>Belum ada pesanan yang selesai. Yuk, selesaikan pesananmu!</p>
    `,
    pesananDibatalkan: `
        <img src="placeholder.png" alt="Canceled Orders">
        <p>Belum ada pesanan yang dibatalkan. Jangan lupa cek pesananmu!</p>
    `
};

// Fungsi untuk memilih tab berdasarkan data-tab
function setActiveTab(tabKey) {
    // Menghapus class active dari tab yang sebelumnya
    document.querySelector('.tab.active').classList.remove('active');

    // Menambahkan class active pada tab yang dipilih
    const activeTab = document.querySelector(`.tab[data-tab="${tabKey}"]`);
    if (activeTab) {
        activeTab.classList.add('active');
        content.innerHTML = tabContent[tabKey];
    }
}

// Menambahkan event listener untuk tab
tabs.forEach(tab => {
    tab.addEventListener('click', (e) => {
        e.preventDefault(); // Mencegah perilaku default link
        setActiveTab(tab.getAttribute('data-tab'));

        // Menangani navigasi jika tab memiliki href
        const href = tab.getAttribute('href');
        if (href) {
            window.location.href = href;
        }
    });
});

// Mengatur tab default menjadi "Belum Dibayar" saat halaman dimuat
document.addEventListener('DOMContentLoaded', () => {
    setActiveTab('belumDibayar');
});
