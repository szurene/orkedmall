/**
 * Table Sorting Logic
 */
function sortTable(n, el) {
    let table = document.getElementById("membersTable");
    let rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    switching = true;
    dir = "asc"; 
    
    let headers = table.getElementsByTagName("TH");
    for (let h of headers) h.classList.remove("sort-asc", "sort-desc");

    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];

            let xVal = x.textContent.toLowerCase().trim();
            let yVal = y.textContent.toLowerCase().trim();

            if (dir == "asc") {
                if (xVal > yVal) { shouldSwitch = true; break; }
            } else if (dir == "desc") {
                if (xVal < yVal) { shouldSwitch = true; break; }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount ++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
    el.classList.add(dir === "asc" ? "sort-asc" : "sort-desc");
}

/**
 * Modal Logic with AJAX Fetch
 */
function openModal(type, id) {
    const modal = document.getElementById("memberModal");
    const title = document.getElementById("modalTitle");
    const footer = document.getElementById("modalFooter");
    
    // Get form inputs
    const firstNameInput = document.getElementById("editFirstName");
    const lastNameInput = document.getElementById("editLastName");
    const phoneInput = document.getElementById("editPhone");

    // Clear previous data and show loading state
    firstNameInput.value = "Loading...";
    lastNameInput.value = "";
    phoneInput.value = "";
    
    modal.style.display = "block";

    // AJAX Fetch - Ensure the filename here matches get_member.php
    fetch(`get_member.php?id=${id}`)
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                firstNameInput.value = data.firstName;
                lastNameInput.value = data.lastName;
                phoneInput.value = data.phoneNum || "N/A";
            }
        })
        .catch(error => {
            console.error('AJAX Error:', error);
            firstNameInput.value = "Error loading data";
        });

    // Toggle View/Edit mode
    if (type === 'view') {
        title.innerText = "View Member Profile";
        footer.style.display = "none";
        document.querySelectorAll('#modalForm input').forEach(input => input.disabled = true);
    } else {
        title.innerText = "Edit Member #OM-M" + id;
        footer.style.display = "block";
        document.querySelectorAll('#modalForm input').forEach(input => input.disabled = false);
    }
}

function closeModal() {
    document.getElementById("memberModal").style.display = "none";
}

window.onclick = function(event) {
    if (event.target == document.getElementById("memberModal")) closeModal();
}