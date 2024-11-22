// Invoice remove handler for index.js
document.querySelectorAll(".remove-invoice-btn").forEach((button) => {
  button.addEventListener("click", async function () {
    if (confirm("Are you sure you want to delete this invoice?")) {
      const invoiceId = Number(this.dataset.id);
      try {
        // Use relative path from current location
        const response = await fetch(
          "/InvoiceProject/php/FormSubmissions/delete_invoice.php",
          {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `id=${invoiceId}`,
          }
        );
        // Debug response
        // console.log("Response status:", response.status);

        if (response.ok) {
          this.closest(".invoice-item").remove();
        } else {
          alert("Error deleting invoice");
        }
      } catch (error) {
        console.error("Error:", error);
        alert("Error deleting invoice");
      }
    }
  });
});

// Search handler
