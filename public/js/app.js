let onSaleCheckboxes = document.querySelectorAll(".onSale");

if(onSaleCheckboxes) {
    onSaleCheckboxes.forEach((checkbox) => {
        console.log(1);
        checkbox.addEventListener("change", function(event) {
            event.preventDefault();
            let status = checkbox.checked ? 1 : 0;
            let url =  '/api/product/'+checkbox.dataset.productId+'/set-status?status='+status;
            fetch(url);
        });
    });
}

let processedCheckboxes = document.querySelectorAll(".processed");

if(processedCheckboxes) {
    processedCheckboxes.forEach((checkbox) => {
        console.log(1);
        checkbox.addEventListener("change", function(event) {
            event.preventDefault();
            let status = checkbox.checked ? 1 : 0;
            let url =  '/api/order/'+checkbox.dataset.orderId+'/set-status?status='+status;
            fetch(url);
        });
    });
}
