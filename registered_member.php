<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mall Membership Admin | Professional Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    :root {
      --sidebar-color: #e5dcd6;
      --accent-rose: #e19bb1;
      --success-green: #1b5e20;
      --error-red: #b71c1c;
      --text-main: #333333;
      --border-light: #eeeeee;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #ffffff;
      color: var(--text-main);
      margin: 0;
      display: flex; 
      height: 100vh; 
      overflow: hidden; 
    }

    .sidebar {
      width: 260px;
      min-width: 260px;
      background-color: var(--sidebar-color);
      padding: 40px 25px;
      display: flex;
      flex-direction: column;
      border-right: 1px solid rgba(0,0,0,0.05);
      height: 100vh; 
      box-sizing: border-box;
    }

    .sidebar h2 {
      font-size: 16px;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      margin-bottom: 40px;
      color: var(--text-main);
      border-left: 4px solid var(--accent-rose);
      padding-left: 15px;
    }

    .nav-link {
      margin-bottom: 10px;
      font-weight: 400;
      font-size: 14px;
      cursor: pointer;
      padding: 12px 15px;
      border-radius: 6px;
      transition: all 0.2s ease;
      color: var(--text-main);
    }

    .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.5);
    }

    .nav-link.active {
      background-color: #ffffff;
      font-weight: 600;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .content-wrapper {
      flex: 1;
      display: flex;
      flex-direction: column;
      height: 100vh;
      overflow-y: auto; 
    }

    .top-bar {
      width: 100%;
      height: 70px;
      display: flex;
      justify-content: flex-end;
      align-items: center;
      padding: 0 60px;
      box-sizing: border-box;
      background-color: #ffffff;
    }

    .logout-btn-top {
      background: transparent;
      color: var(--text-main);
      border: 1px solid #ddd;
      padding: 8px 24px;
      border-radius: 25px;
      font-size: 13px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .logout-btn-top:hover {
      border-color: var(--accent-rose);
      color: var(--accent-rose);
      background-color: #fff9fa;
    }

    .main {
      padding: 20px 60px 40px 60px;
    }

    .main h1 {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 30px;
      color: var(--text-main);
    }

    .search-bar {
      margin-bottom: 30px;
    }

    .search-bar input {
      width: 100%;
      max-width: 400px;
      padding: 12px 20px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
      outline: none;
      transition: border-color 0.3s;
    }

    .search-bar input:focus {
      border-color: var(--accent-rose);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 800px;
    }

    th {
      text-align: left;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #999;
      padding: 15px 10px;
      border-bottom: 2px solid var(--border-light);
      cursor: pointer;
    }

    td {
      padding: 18px 10px;
      font-size: 14px;
      border-bottom: 1px solid var(--border-light);
    }

    tr:hover td {
      background-color: #fcfcfc;
    }
    
    .status-badge {
      font-weight: 600;
      font-size: 11px;
      padding: 5px 12px;
      border-radius: 4px;
      display: inline-block;
      min-width: 80px;
      text-align: center;
      text-transform: uppercase;
    }

    .status-paid, .status-active { 
      background-color: #e8f5e9;
      color: var(--success-green);
      border: 1px solid #c8e6c9;
    }
    
    .status-pending, .status-inactive { 
      background-color: #ffebee;
      color: var(--error-red);
      border: 1px solid #ffcdd2;
    }

    .action-buttons button {
      background: none;
      padding: 6px 14px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 12px;
      margin-right: 5px;
      font-weight: 500;
      transition: all 0.2s;
    }

    .edit-btn { border: 1px solid var(--success-green); color: var(--success-green); }
    .edit-btn:hover { background: var(--success-green); color: white; }

    .delete-btn { border: 1px solid var(--error-red); color: var(--error-red); }
    .delete-btn:hover { background: var(--error-red); color: white; }

    .footer {
      color: #aaaaaa;
      text-align: center;
      padding: 30px;
      font-size: 12px;
      margin-top: auto;
    }

    @media (max-width: 1024px) {
      .main { padding: 20px 30px; }
      .top-bar { padding: 0 30px; }
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <h2>Mall Registry</h2>
    <div class="nav-link">Dashboard Overview</div>
    <div class="nav-link active">Member Database</div>
    <div class="nav-link">System Settings</div>
  </div>

  <div class="content-wrapper">
    <div class="top-bar">
      <button class="logout-btn-top">Logout</button>
    </div>

    <div class="main">
      <h1>Registered Members</h1>

      <div class="search-bar">
        <input type="text" placeholder="Search by ID, name or phone...">
      </div>

      <table id="membersTable">
        <thead>
          <tr>
            <th onclick="toggleSort(0)">ID</th>
            <th onclick="toggleSort(1)">Member Name</th>
            <th onclick="toggleSort(2)">Tier</th>
            <th>Phone Num</th>
            <th onclick="toggleSort(4)">Payment</th>
            <th onclick="toggleSort(5)">Status</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>#M-10042</td>
            <td>Gojo Satoru</td>
            <td>Platinum</td>
            <td>01123456789</td>
            <td><span class="status-badge status-paid">Paid</span></td>
            <td><span class="status-badge status-inactive">Inactive</span></td>
            <td class="action-buttons">
              <button class="edit-btn">Edit</button>
              <button class="delete-btn">Delete</button>
            </td>
          </tr>
          <tr>
            <td>#M-10043</td>
            <td>Syafieda Adiela</td>
            <td>Gold</td>
            <td>0112347650</td>
            <td><span class="status-badge status-pending">Pending</span></td>
            <td><span class="status-badge status-active">Active</span></td>
            <td class="action-buttons">
              <button class="edit-btn">Edit</button>
              <button class="delete-btn">Delete</button>
            </td>
          </tr>
          <tr>
            <td>#M-10044</td>
            <td>Aiman Hakimi</td>
            <td>Platinum</td>
            <td>0198765432</td>
            <td><span class="status-badge status-paid">Paid</span></td>
            <td><span class="status-badge status-active">Active</span></td>
            <td class="action-buttons">
              <button class="edit-btn">Edit</button>
              <button class="delete-btn">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="footer">
      &copy; 2025 Orked Mall Management System. Confidential and Internal Use Only.
    </div>
  </div>

<script>
let sortDirection = {};
function toggleSort(colIndex) {
  const table = document.getElementById("membersTable");
  const tbody = table.tBodies[0];
  const rows = Array.from(tbody.rows);
  sortDirection[colIndex] = sortDirection[colIndex] === "asc" ? "desc" : "asc";
  
  rows.sort((a, b) => {
    const A = a.cells[colIndex].innerText.toLowerCase();
    const B = b.cells[colIndex].innerText.toLowerCase();
    
    const aVal = A.startsWith('#') ? parseInt(A.substring(3)) : A;
    const bVal = B.startsWith('#') ? parseInt(B.substring(3)) : B;

    if (sortDirection[colIndex] === "asc") {
      return aVal > bVal ? 1 : -1;
    } else {
      return aVal < bVal ? 1 : -1;
    }
  });
  
  rows.forEach(row => tbody.appendChild(row));
}
</script>

</body>
</html>