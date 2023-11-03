document.addEventListener("DOMContentLoaded", function () {
    var portfolioPostsBtn = document.getElementById("portfolio-posts-btn");
    var portfolioPostsContainer = document.getElementById("portfolio-posts-container");

    if (portfolioPostsBtn) {
        portfolioPostsBtn.addEventListener("click", function () {
            var selectedLocation = document.getElementById("location").value;
            var checkin = document.getElementById("checkin").value;
            var checkout = document.getElementById("checkout").value;
            var url = `https://aptourismhotels.in/details.php?hotel_id=${selectedLocation}&check_in=${checkin}&check_out=${checkout}`;

            var ourRequest = new XMLHttpRequest();
            ourRequest.open("GET", url);
            ourRequest.onload = function () {
                if (ourRequest.status >= 200 && ourRequest.status < 400) {
                    var data = JSON.parse(ourRequest.responseText);
                    createHTML(data, checkin, checkout, selectedLocation);
                } else {
                    console.log("We connected to the server, but it returned an error. Status: " + ourRequest.status);
                }
            };

            ourRequest.onerror = function () {
                console.log("Connection error");
            };

            ourRequest.send();
        });
    }

    function createHTML(data, checkin, checkout, location) {
        var ourHTMLString = '<table style="color: orange; border: 1px solid orange;">';
        ourHTMLString +=
            '<tr><th style="color: orange;">Hotel Name</th><th style="color: orange;">Room Type Name</th><th style="color: orange;">Gross Amount</th><th style="color: orange;">Tax GST</th><th style="color: orange;">Total Price</th><th style="color: orange;">Add to Cart</th><th style="color: orange;">Book Now</th></tr>';

        for (var i = 0; i < data.length; i++) {
            var grossAmount = parseFloat(data[i].gross_amount);
            var tax = parseFloat(data[i].tax);
            var totalPrice = grossAmount + tax;

            ourHTMLString += '<tr>';
            ourHTMLString += '<td style="color: orange;">' + data[i].hotel_name + '</td>';
            ourHTMLString += '<td style="color: orange;">' + data[i].room_type_name + '</td>';
            ourHTMLString += '<td style="color: orange;">' + grossAmount + '</td>';
            ourHTMLString += '<td style="color: orange;">' + tax + '</td>';
            ourHTMLString += '<td style="color: orange;">' + totalPrice + '</td>';
            ourHTMLString +=
                '<td><button class="add-to-cart-btn" data-room_type_id="' +
                data[i].room_type_id +
                '" data-checkin_date="' +
                checkin +
                '" data-checkout_date="' +
                checkout +
                '" data-hotel_name="' +
                data[i].hotel_name +
                '">Add to Cart</button></td>';
            ourHTMLString +=
                '<td><button class="book-now-btn" data-room_type_id="' +
                data[i].room_type_id +
                '" data-checkin_date="' +
                checkin +
                '" data-checkout_date="' +
                checkout +
                '" data-hotel_name="' +
                data[i].hotel_name +
                '">Book Now</button></td>';
            ourHTMLString += '</tr>';
        }

        ourHTMLString += '</table>';
        portfolioPostsContainer.innerHTML = ourHTMLString;

        var addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
        addToCartButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var roomTypeId = button.getAttribute('data-room_type_id');
                var checkinDate = button.getAttribute('data-checkin_date');
                var checkoutDate = button.getAttribute('data-checkout_date');
                var hotelName = button.getAttribute('data-hotel_name');
                addToCart(roomTypeId, checkinDate, checkoutDate, hotelName);
            });
        });

        var bookNowButtons = document.querySelectorAll('.book-now-btn');
        bookNowButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var roomTypeId = button.getAttribute('data-room_type_id');
                var checkinDate = button.getAttribute('data-checkin_date');
                var checkoutDate = button.getAttribute('data-checkout_date');
                var hotelName = button.getAttribute('data-hotel_name');
                sendEmail(roomTypeId, checkinDate, checkoutDate, hotelName, location, checkin, checkout);
            });
        });
    }

    function sendEmail(roomTypeId, checkinDate, checkoutDate, hotelName, location, selectedCheckin, selectedCheckout) {
        var emailData = {
            roomTypeId: roomTypeId,
            checkinDate: checkinDate,
            checkoutDate: checkoutDate,
            hotelName: hotelName,
            location: location,
            selectedCheckin: selectedCheckin,
            selectedCheckout: selectedCheckout,
        };

        fetch("send_email.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(emailData),
        })
            .then((response) => {
                if (!response.ok) {
                    console.error("Error sending email:", response);
                }
                // Handle success or error as needed
            })
            .catch((error) => {
                console.error("Error sending email:", error);
            });
    }

    function addToCart(roomTypeId, checkinDate, checkoutDate, hotelName) {
        // Implement your add to cart logic here
        // You can use WooCommerce API or functions to add items to the cart
        // Example:
        var data = {
            action: "add_to_cart",
            product_id: roomTypeId,
            quantity: 1,
            variation_id: 0,
        };

        jQuery.post(wc_add_to_cart_params.ajax_url, data, function (response) {
            if (response) {
                alert("Item added to cart: " + hotelName);
            }
        });
    }
});
