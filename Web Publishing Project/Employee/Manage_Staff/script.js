document.getElementById('addStaffForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const name = document.getElementById('staffName').value;
    const email = document.getElementById('staffEmail').value;
    
    const table = document.querySelector('table tbody');
    const newRow = table.insertRow();
    newRow.innerHTML = `<td>${name}</td><td>${email}</td><td>❌</td><td>⚙️</td>`;
    
    this.reset();
});


