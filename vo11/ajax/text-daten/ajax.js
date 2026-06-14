"use strict";

/**
 * Fetches the capital city for the selected state asynchronously from
 * states.php and displays it without reloading the page.
 *
 * Triggered by the "change" event of the state selection list. The
 * selected index is passed to the server as a GET parameter; the server
 * returns the matching capital as plain text.
 *
 * @param {Event} event The change event fired by the selection list.
 * @returns {Promise<void>}
 */
async function sendRequest(event) {
    const index = event.target.selectedIndex;
    const capital = document.getElementById("capital");

    try {
        const response = await fetch("states.php?index=" + index, {
            headers: {"Accept": "text/plain"}
        });

        if (response.ok) {
            // The response is plain text, so it is read via .text().
            capital.textContent = await response.text();
        } else {
            // HTTP error (e.g., 400 or 404): the request reached the server, but the server reported a problem.
            capital.textContent = "A problem occurred with requesting the selected capital.";
        }
    } catch (error) {
        // Network error: the server could not be reached at all.
        capital.textContent = "The server could not be reached.";
    }
}

// Look up the selection list and react to changes. Because the script is
// included with "defer", the DOM is already available at this point.
const select = document.getElementById("state");
select.addEventListener("change", sendRequest);