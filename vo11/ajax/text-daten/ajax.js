"use strict";

const request = new XMLHttpRequest();

/**
 * Send a new asynchronous request to the specified resource.
 * @param event The event object that is passed on to retrieve the selected element.
 */
function sendAJAXRequest(event) {
    request.open("GET", "states.php?index=" + event.target.selectedIndex, true);
    request.addEventListener("load", handleResponse);
    request.send();
}

/**
 * Handle the response and insert the content into the page.
 * @param event The event object.
 */
function handleResponse(event) {
    if (request.status === 200) {
        document.getElementById("capital").textContent = request.responseText;
    } else {
        document.getElementById("capital").textContent = "A problem occurred with requesting the selected capital.";
    }
}

// Start everything
const select = document.getElementById("state");
select.addEventListener("change", sendAJAXRequest);