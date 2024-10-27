import "./bootstrap";
import Swal from "sweetalert2";

import Alpine from "alpinejs";
window.Alpine = Alpine;
window.Swal = Swal;
Alpine.start();

import QrScanner from "qr-scanner"; // Import the Nimiq QR Scanner
// DOMContentLoaded ensures that the DOM is fully loaded before executing the script
document.addEventListener("DOMContentLoaded", function () {
    const videoElem = document.getElementById("video"); // Get the video element
    const qrScanner = new QrScanner(videoElem, (result) => {
        $.ajax({
            type: "POST",
            url: "transfer/verify-number",
            dataType: "json",
            data: {
                phone_number: result
            },
            success: function (res) {
                // Step 1: Convert the success object to a JSON string
                let successData = JSON.stringify(res.success);
                // Step 2: Base64 encode the JSON string
                let encodedData = btoa(successData);
                // Step 3: Redirect with encoded data as part of the URL
                window.location.href = `/transfer/transfer-to?data=${encodedData}`;
            },
            error: function(xhr, status, error) {
                let errorMessage = xhr.responseJSON?.fail;
                Swal.fire({
                    icon: "error",
                    text: errorMessage,
                    confirmButtonText: "Got it",
                });
            }
        });
        if (result) {
            modal.classList.add("hidden");
            qrScanner.stop(); // Start scanning
        }
    });

    const openModalBtn = document.getElementById("openModalBtn");
    const closeModalBtn = document.getElementById("closeModalBtn");
    const closeModalBtn2 = document.getElementById("closeModalBtn2");
    const modal = document.getElementById("myModal");
    // Open Modal
    openModalBtn.addEventListener("click", () => {
        modal.classList.remove("hidden");
        qrScanner.start(); // Start scanning
    });
    // Close Modal
    closeModalBtn.addEventListener("click", () => {
        modal.classList.add("hidden");
        qrScanner.stop(); // Start scanning
    });
    closeModalBtn2.addEventListener("click", () => {
        modal.classList.add("hidden");
        qrScanner.stop(); // Start scanning
    });
    // Close modal when clicking outside of modal content
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.classList.add("hidden");
            qrScanner.stop();
        }
    };
});
