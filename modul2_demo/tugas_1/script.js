let result = document.getElementById("result");

function clearScreen() {
    result.value = "";
}

function appendNumber(number) {
    result.value += number;
}

function appendOperator(operator) {
    result.value += operator;
}

function calculate() {
    try {
        let expression = result.value;

        
        expression = expression.replace(/\^/g, "**");

        result.value = eval(expression);
    } catch (error) {
        result.value = "Error";
    }
}
