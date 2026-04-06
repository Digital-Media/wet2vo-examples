"use strict";

const request = new XMLHttpRequest();

/**
 * Send a new asynchronous request to the specified resource.
 */
function sendAJAXRequest() {
    const str = encodeURIComponent(search.value);
    request.open("GET", "search.php?search=" + str, true);
    request.responseType = "json";
    request.setRequestHeader("Accept", "application/json");
    request.addEventListener("load", handleResponse);
    request.send();
}

function handleResponse() {
    if (request.status === 200) {
        const suggestDiv = document.getElementById("suggestions");
        suggestDiv.innerHTML = "";
        const data = request.response;

        // Only do something if data sets actually came back
        if (data.count > 0) {
            for (let i = 0; i < data.count; i++) {
                // Generate the element-DIVs.
                const entry = document.createElement("div");
                // Change class onmouseover
                entry.addEventListener("mouseover", function () {
                    this.classList.add("suggestLinkOver");
                });
                // Change back class onmouseout
                entry.addEventListener("mouseout", function () {
                    this.classList.remove("suggestLinkOver");
                });
                // Set the search value on click
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
}

// Set the AJAX function as a callback in the keyup-handler
const search = document.getElementById("search");
search.addEventListener("keyup", sendAJAXRequest);