
function closeDisclaimer() {
    var disclaimerBar = document.getElementById('disclaimerBar');
    disclaimerBar.style.display = 'none';
}

function closeDisclaimerModal() {
    var disclaimerBar = document.getElementById('arky_cookies_Modal');
    disclaimerBar.style.display = 'none';
}


function openDisclaimerModal() {
    var disclaimerBar = document.getElementById('arky_cookies_Modal');
    disclaimerBar.style.display = 'block';
}

function generateUUID() {
    return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
        (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
    );
}


function setCookieViaAjax() {
    var uuid = generateUUID();  // Generate a random token
    var d = new Date();
    d.setTime(d.getTime() + (30*24*60*60*1000)); // 30 days in milliseconds
    var expires = "expires="+ d.toUTCString();
    document.cookie = "disclaimer=" + uuid + ";" + expires + ";path=/";

    // Close the modal, if applicable
    closeDisclaimer();
    closeDisclaimerModal();

    // AJAX request to server
    fetch(simpleCookieData.ajaxurl, {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=record_cookie_acceptance'
    }).then(response => response.json())
    .then(data => {
        if (data.success) {
            // Optionally update the UI or handle the response
            handleSuccessResponse(); // Implement this function as needed
        } else {
            // Handle an error or unsuccessful response
            handleError(); // Implement this function as needed
        }
    })
    .catch(error => {
        // Handle any errors that occurred during fetch
        handleError(); // Implement this function as needed
    });
}

function handleSuccessResponse() {
    // This function can update the UI to indicate success or close modal, etc.
}

function handleError() {
    // This function can display an error message to the user, log to a server, etc.
}

//Accordian Code
document.addEventListener('DOMContentLoaded', function() {
    const accordion = document.getElementById('cookies_accordion');
    const detailsElements = accordion.querySelectorAll('details');

    accordion.addEventListener('click', function(event) {
        // Find the closest details element to the click event.
        const currentDetails = event.target.closest('details');

        if (currentDetails) {
            // Check if the current details element is actually being opened, not closed.
            requestAnimationFrame(() => {
                if (currentDetails.hasAttribute('open')) {
                    // Close all other details elements.
                    detailsElements.forEach(details => {
                        if (details !== currentDetails) {
                            details.removeAttribute('open');
                        }
                    });
                }
            });
        }
    });
});

