function toggleDrop() {
    document.getElementById('menuList').classList.toggle('show');
}

// Close dropdown if user clicks outside
window.onclick = function(e) {
    if (!e.target.matches('.icon-btn')) {
        const menu = document.getElementById('menuList');
        if (menu && menu.classList.contains('show')) {
            menu.classList.remove('show');
        }
    }
}

// Fetch footer content
fetch("footer.html")
    .then(res => res.text())
    .then(data => {
        const footer = document.getElementById("footer-placeholder");
        if(footer) footer.innerHTML = data;
    })
    .catch(err => console.error("Error loading footer:", err));