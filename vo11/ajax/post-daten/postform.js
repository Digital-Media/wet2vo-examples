"use strict";

const request = new XMLHttpRequest();
const form = document.getElementById("registerForm");
form.addEventListener("submit", sendAJAXRequest);

/**
 * Send a new asynchronous request to the specified resource.
 * @param event The event object.
 */
function sendAJAXRequest(event) {
    const formData = new FormData(form);
    request.open("POST", "details.php", true);
    request.addEventListener("load", handleResponse);
    request.send(formData);
    event.preventDefault();
}

/**
 * Handle the response and insert the content into the page.
 */
function handleResponse() {
    const ul = document.getElementById("loginDetails");
    if (request.status === 200) {
        const data = request.responseText.split("\n");
        for (let i = 0; i < data.length; i++) {
            const entry = document.createElement("li");
            entry.textContent = data[i];
            ul.appendChild(entry);
        }
    } else {
        const error = document.createElement("li");
        error.textContent = "An error occurred!";
        ul.appendChild(error);
    }
}