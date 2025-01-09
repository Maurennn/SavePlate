// tabs.js
document.querySelectorAll('.tabs .tab').forEach(tab => {
    tab.addEventListener('click', function(e) {
        e.preventDefault();
        const href = this.getAttribute('href');
        if (href) {
            window.location.href = href;
        }
    });
});
