document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Get form field values
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var address = document.getElementById('address').value;

    // Check if any of the fields are empty
    if (name === '' || email === '' || address === '') {
        // Show alert if fields are empty
        window.alert('Semua data harus diisi.');
    } else {
        // Optionally, you can process the form data here
        window.alert('Pendaftaran berhasil!');
        // Reset the form after submission
        document.getElementById('registrationForm').reset();
    }
});
