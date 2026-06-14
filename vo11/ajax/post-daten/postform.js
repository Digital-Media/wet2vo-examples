"use strict";

/**
 * Sends the registration form to details.php via an asynchronous POST
 * request and displays the returned data without reloading the page.
 *
 * Triggered by the form's "submit" event. The default submission (and
 * thus a page reload) is prevented. The form is taken from the event
 * itself, wrapped in a FormData object and sent as the request body; the
 * server echoes the received values back as plain text, one "key: value"
 * pair per line.
 *
 * @param {SubmitEvent} event The submit event fired by the form.
 * @returns {Promise<void>}
 */
async function sendRequest(event) {
    // Prevent the classic form submission (and the page reload).
    event.preventDefault();

    // event.target is the form that triggered the submit event.
    const formData = new FormData(event.target);
    const list = document.getElementById("loginDetails");

    // Clear the list so results do not accumulate on repeated submits.
    list.innerHTML = "";

    try {
        // The browser sets the Content-Type header automatically when a FormData object is passed as the body.
        const response = await fetch("details.php", {
            method: "POST",
            headers: {"Accept": "text/plain"},
            body: formData
        });

        if (response.ok) {
            // The response is plain text with one entry per line.
            const text = await response.text();
            const entries = text.split("\n");

            for (let i = 0; i < entries.length; i++) {
                const item = document.createElement("li");
                item.textContent = entries[i];
                list.appendChild(item);
            }
        } else {
            // HTTP error (e.g., 400): the request reached the server, but the server reported a problem.
            const item = document.createElement("li");
            item.textContent = "A problem occurred with the request!";
            list.appendChild(item);
        }
    } catch (error) {
        // Network error: the server could not be reached at all.
        const item = document.createElement("li");
        item.textContent = "The server could not be reached.";
        list.appendChild(item);
    }
}

// React to the form's submission. Because the script is included with
// "defer", the DOM is already available at this point.
document.getElementById("registerForm").addEventListener("submit", sendRequest);