import './bootstrap';

let onSaleChecboxes = document.querySelectorAll(".onSale");

if(onSaleChecboxes) {
    onSaleChecboxes.forEach((checkbox) => {
        console.log(1);
        checkbox.addEventListener("change", function() {

        });
    });
}
