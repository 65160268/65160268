function formatExpiryDate() {
    let input = document.getElementById('e-date');
    let value = input.value.replace(/\D/g, ''); // Remove all non-numeric characters
    
    if (value.length >= 2 && value.length < 4) {
        // Add the first slash after MM
        input.value = value.substring(0, 2) + '/' + value.substring(2);
    } else if (value.length >= 4) {
        // Add the second slash after DD
        input.value = value.substring(0, 2) + '/' + value.substring(2, 4) + '/' + value.substring(4, 8);
    } else {
        // Set the input value to the current numeric characters
        input.value = value;
    }
}