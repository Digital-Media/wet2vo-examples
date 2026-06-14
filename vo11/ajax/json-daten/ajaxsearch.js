"use strict";

/**
 * Sends the current search term to search.php and forwards the parsed
 * result to handleResponse().
 *
 * Triggered by the "keyup" event of the search field. The search term is
 * URL-encoded and passed as a GET parameter. The server responds with a
 * JSON object read directly via response.json().
 *
 * @param {KeyboardEvent} event The keyup event fired by the search field.
 * @returns {Promise<void>}
 */
async function sendRequest(event) {
    const str = encodeURIComponent(event.target.value);

    try {
        const response = await fetch("search.php?search=" + str, {
            headers: {"Accept": "application/json"}
        });

        if (response.ok) {
            // The response is JSON, so it is parsed directly into an object.
            const data = await response.json();
            handleResponse(data);
        }
    } catch (error) {
        // Network error: the server could not be reached at all.
        console.error("Request failed:", error);
    }
}

/**
 * Renders the search suggestions returned by the server.
 *
 * Clears the suggestion container and, for every word in the result,
 * creates a <div> with hover and click handlers. Clicking a suggestion
 * copies its text into the search field and clears the list.
 *
 * @param {{count: number, words: string[]}} data The parsed server
 *     response: the number of matches and the matching words.
 * @returns {void}
 */
function handleResponse(data) {
    const suggestDiv = document.getElementById("suggestions");
    suggestDiv.innerHTML = "";

    if (data.count > 0) {
        for (let i = 0; i < data.count; i++) {
            const entry = document.createElement("div");

            entry.addEventListener("mouseover", function () {
                this.classList.add("suggestLinkOver");
            });
            entry.addEventListener("mouseout", function () {
                this.classList.remove("suggestLinkOver");
            });
            entry.addEventListener("click", function () {
                search.value = this.textContent;
                suggestDiv.innerHTML = "";
            });

            entry.classList.add("suggestLink");
            entry.textContent = data.words[i];
            suggestDiv.appendChild(entry);
        }
    }
}

// Look up the search field and react to keyboard input. Because the script
// is included with "defer", the DOM is already available at this point.
const search = document.getElementById("search");
search.addEventListener("keyup", sendRequest);