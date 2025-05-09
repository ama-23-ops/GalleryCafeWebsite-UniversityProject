const reservationForm = document.getElementById("reservationForm");
const formMessage = document.getElementById("formMessage");
const availableTablesCount = document.getElementById("availableTablesCount");
const availableParkingCount = document.getElementById("availableParkingCount");

// Function to update availability counts 
function updateAvailability() {
    console.log("Updating availability..."); 
    fetch('../php/get_availability.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not OK');
            }
            return response.json();
        })
        .then(data => {
            console.log("availableTablesCount element:", availableTablesCount);
            console.log("availableParkingCount element:", availableParkingCount);
            console.log("Data from server:", data); 

            // Use setTimeout to introduce a delay
            setTimeout(() => { 
                availableTablesCount.textContent = data.availableTables;
                availableParkingCount.textContent = data.availableParking;
            }, 10); // Delay of 10 milliseconds
        })
        .catch(error => {
            console.error("Error updating availability:", error);
        });
}

// Call updateAvailability on page load
updateAvailability();


document.getElementById("submitReservation").addEventListener("click", function(event) {
    event.preventDefault();

    clearAllErrors();

    if (validateForm()) { 
        const formData = new FormData(reservationForm);

        fetch('../php/submit_reservation.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not OK');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    formMessage.innerHTML = `<p class="success-message">${data.message}</p>`;
                    reservationForm.reset(); 
                    updateAvailability();
                } else {
                    formMessage.innerHTML = `<p class="error-message">${data.message}</p>`;

                    if (data.errors) {
                        for (const field in data.errors) {
                            showError(document.getElementById(field), data.errors[field]);
                        }
                    }
                }
            })
            .catch(error => {
                console.error("Error:", error);
                formMessage.innerHTML = '<p class="error-message">An error occurred. Please try again later.</p>';
            });
    } 
});

// Function to show the error message
function showError(input, message) {
    const errorElement = document.getElementById(input.id + 'Error');
    errorElement.textContent = message;
    input.setAttribute('aria-invalid', 'true'); 
    input.setAttribute('aria-describedby', input.id + 'Error');
}

// Function to clear the error message
function clearError(input) {
    const errorElement = document.getElementById(input.id + 'Error');
    if (errorElement) { // Check if the error element exists
        errorElement.textContent = '';
        input.removeAttribute('aria-invalid');
        input.removeAttribute('aria-describedby');
    }
}

// Function to clear all error messages
function clearAllErrors() {
    const inputs = document.querySelectorAll("#reservationForm input, #reservationForm select");
    inputs.forEach(input => clearError(input));
}

// Function to validate the form
function validateForm() {
    let isValid = true;

    const name = document.getElementById("name");
    const phone = document.getElementById("phone");
    const email = document.getElementById("email");
    const date = document.getElementById("date");
    const time = document.getElementById("time");
    const guests = document.getElementById("guests");

    // Validate Name
    if (name.value.trim() === "" || name.value.trim().length < 2 || !/^[a-zA-Z\s]+$/.test(name.value.trim())) {
        showError(name, "Please enter a valid name (at least 2 letters).");
        isValid = false;
    } else {
        clearError(name);
    }

    // Validate Phone
    if (phone.value.trim() === "" || !/^\d{10}$/.test(phone.value.trim())) {
        showError(phone, "Please enter a valid 10-digit phone number.");
        isValid = false;
    } else {
        clearError(phone);
    }

    // Validate Email 
    if (email.value.trim() !== "" && !validateEmail(email.value.trim())) {
        showError(email, "Please enter a valid email address.");
        isValid = false;
    } else {
        clearError(email);
    }

    // Validate Date (today or future date)
const today = new Date();
today.setHours(0, 0, 0, 0); 
const selectedDate = new Date(date.value);
if (date.value.trim() === "" || selectedDate < today) { // Change <= to <
    showError(date, "Please select today or a future date."); 
    isValid = false;
} else {
    clearError(date);
}

    // Validate Time 
    if (time.value.trim() === "") {
        showError(time, "Please select a reservation time.");
        isValid = false;
    } else {
        clearError(time);
    }

    // Validate Guests
    if (guests.value.trim() === "" || isNaN(guests.value) || parseInt(guests.value) <= 0) {
        showError(guests, "Please enter a valid number of guests.");
        isValid = false;
    } else {
        clearError(guests);
    }

    return isValid;
}

// Helper function to validate email format
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}