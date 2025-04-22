/*const amount_to_fund = prompt("Amount", "Enter Amount to Fund");
const deducted = (3 * amount_to_fund) / 100;
const balance = amount_to_fund - deducted
console.log(balance);
*/

document.getElementById("fundForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission (to avoid page reload)

    let amount_to_fund = parseFloat(document.getElementById("money").value);

    if (isNaN(amount_to_fund) || amount_to_fund <= 0) {
        console.log("Please enter a valid amount.");
        return;
    }

    let deducted = (3 * amount_to_fund) / 100;
    let balance = amount_to_fund - deducted;

    console.log("Final Amount After Deduction: ", balance);
});