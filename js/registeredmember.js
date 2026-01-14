function sortTable(n, el) {
    const table = document.getElementById("membersTable");
    let rows, switching = true, dir = "asc", switchcount = 0;

    document.querySelectorAll("th").forEach(th =>
        th.classList.remove("sort-asc", "sort-desc")
    );

    while (switching) {
        switching = false;
        rows = table.rows;

        for (let i = 1; i < rows.length - 1; i++) {
            let x = rows[i].cells[n];
            let y = rows[i + 1].cells[n];
            if (!x || !y) continue;

            let xv = x.textContent.toLowerCase().trim();
            let yv = y.textContent.toLowerCase().trim();

            if ((dir === "asc" && xv > yv) || (dir === "desc" && xv < yv)) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
                break;
            }
        }

        if (!switching && switchcount === 0 && dir === "asc") {
            dir = "desc";
            switching = true;
        }
    }

    el.classList.add(dir === "asc" ? "sort-asc" : "sort-desc");
}

function openModal(type, id) {
    const modal = document.getElementById("memberModal");
    const title = document.getElementById("modalTitle");
    const footer = document.getElementById("modalFooter");
    
    // Identify our new input field
    const fullNameField = document.getElementById("editFullName");
    const editPhone = document.getElementById("editPhone");

    const inputs = document.querySelectorAll("#modalForm input");
    inputs.forEach(i => {
        i.disabled = false;
        i.value = "";
    });

    modal.style.display = "block";
    title.textContent = type === "view"
        ? "View Member Profile"
        : `Edit Member #OM-M${id}`;

    footer.style.display = type === "view" ? "none" : "block";
    if (type === "view") inputs.forEach(i => i.disabled = true);

    fetch(`get_member.php?id=${id}`)
        .then(r => r.json())
        .then(d => {
            if (d.error) return alert(d.error);
            
            fullNameField.value = d.fullName; 
            editPhone.value = d.phoneNum || "";
        })
        .catch(() => alert("Failed to load member data"));
}

function closeModal() {
    document.getElementById("memberModal").style.display = "none";
}

window.onclick = e => {
    if (e.target === document.getElementById("memberModal")) closeModal();
};