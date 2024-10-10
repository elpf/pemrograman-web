function calculate() {
    // Get the values from the input fields and convert them to numbers
    var num1 = parseFloat(document.getElementById('number1').value);
    var num2 = parseFloat(document.getElementById('number2').value);
    
    // Perform the addition
    var result = num1 + num2;
    
    // Display the result in the result paragraph
    document.getElementById('result').innerText = 'Hasil: ' + result;
}

function reset() {
    // Reset the input fields and the result display
    document.getElementById('number1').value = '';
    document.getElementById('number2').value = '';
    document.getElementById('result').innerText = 'Hasil: 0';
}
