document.getElementById('addMemberForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const name = document.getElementById('memberName').value;
    const email = document.getElementById('memberEmail').value;
    
    const table = document.querySelector('table tbody');
    const newRow = table.insertRow();
    newRow.innerHTML = `<td>${name}</td><td>${email}</td>`;
    
    this.reset();
});