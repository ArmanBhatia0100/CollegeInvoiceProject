// script.js
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    // Gather form data
    const formData = {
      invoiceId: document.getElementById("invoice-id").value,
      dueDate: document.getElementById("due-date").value,
      clientName: document.getElementById("client-name").value,
      amount: document.getElementById("amount").value,
      status: document.getElementById("status").value,
    };

    // Validate form data
    if (!validateForm(formData)) {
      return;
    }

    // Send data to PHP using fetch
    fetch("./../php/FormSubmissions/save_invoice.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert("Invoice saved successfully!");
          invoiceId: document.getElementById("invoice-id").value = "";
          dueDate: document.getElementById("due-date").value = "";
          clientName: document.getElementById("client-name").value = "";
          amount: document.getElementById("amount").value = "";
          status: document.getElementById("status").value = "";

          // Optionally redirect or clear form
          // window.location.href = 'invoices.php';
        } else {
          alert("Error saving invoice: " + data.message);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("An error occurred while saving the invoice");
      });
  });

  function validateForm(data) {
    if (!data.invoiceId.trim()) {
      alert("Please enter an Invoice ID");
      return false;
    }
    if (!data.dueDate) {
      alert("Please select a Due Date");
      return false;
    }
    if (!data.clientName.trim()) {
      alert("Please enter a Client Name");
      return false;
    }
    if (!data.amount || data.amount <= 0) {
      alert("Please enter a valid Amount");
      return false;
    }
    return true;
  }
});
