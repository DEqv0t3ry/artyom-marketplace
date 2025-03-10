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

function deleteLogo(shopId) {
    fetch(`/api/shops/${shopId}/deleteLogo`, {
        method: 'delete',
        body: JSON.stringify({ id: shopId }),
        headers: { 'Content-Type': 'application/json' }
    })
        .then(response => {
            if (response.ok) {
                document.getElementById('logo-'+shopId+'-delete').style.display = 'none';
                document.getElementById('logo-'+shopId+'-add').style.display = '';
            } else {
                // handle error
            }
        })
        .catch(error => {
            // handle error
        });
}

function checkInn(shopInn) {
    fetch(`/api/shops/checkInn`, {
        method: 'post',
        body: JSON.stringify({ inn: shopInn }),
        headers: { 'Content-Type': 'application/json' }
    })
        .then(function (responce) {
            return responce.json();
        })
        .then(function (json) {
            document.getElementById('address').value = json.address;
        })
        .catch(error => {
            // handle error
        });
}
