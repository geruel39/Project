function showPopup(title, content) {
    document.getElementById('helpModalLabel').innerText = title;
    document.getElementById('modalContent').innerText = content;
    $('#helpModal').modal('show');
}