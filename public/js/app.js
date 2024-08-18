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

function deletePhoto(productId) {
    fetch(`/api/products/${productId}/deletePhoto`, {
        method: 'delete',
        body: JSON.stringify({ id: productId }),
        headers: { 'Content-Type': 'application/json' }
    })
        .then(response => {
            if (response.ok) {
                document.getElementById('product-photo-hide').style.display = 'none';
                document.getElementById('product-photo-show').style.display = '';
            } else {
                // handle error
            }
        })
        .catch(error => {
            // handle error
        });
}

function deleteImages(photoId) {
    fetch(`/api/photos/${photoId}/deleteImages`, {
        method: 'delete',
        body: JSON.stringify({ id: photoId }),
        headers: { 'Content-Type': 'application/json' }
    })
        .then(response => {
            if (response.ok) {
                document.getElementById('product-photo-'+photoId+'-delete').style.display = 'none';
                document.getElementById('product-photo-'+photoId+'-add').style.display = '';
            } else {
                // handle error
            }
        })
        .catch(error => {
            // handle error
        });
}
