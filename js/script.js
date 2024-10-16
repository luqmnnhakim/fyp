// Function to display current date and time
function updateDateTime() {
    const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const now = new Date(); // Get current date and time

    const day = days[now.getDay()]; // Get the current day
    const date = now.toLocaleDateString(); // Get the current date in localized format
    const time = now.toLocaleTimeString(); // Get the current time in localized format

    // Update HTML elements with the current day, date, and time
    document.getElementById('current-day').textContent = day;
    document.getElementById('current-date').textContent = date;
    document.getElementById('current-time').textContent = time;
}

// Call the function to set the initial date and time
updateDateTime();

// Update the time every second
setInterval(updateDateTime, 1000);
