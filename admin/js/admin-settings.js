document.addEventListener('DOMContentLoaded', function() {
    const addButton = document.getElementById('addMoreCookies');
    const container = document.getElementById('cookieFieldsContainer');

    addButton.addEventListener('click', function() {
        const index = container.querySelectorAll('.cookieField').length;
        const fieldHTML = `
            <div class="cookieField">
                <input type="text" name="simple_cookie_gdpr_settings[cookies][${index}][name]" placeholder="Cookie Name" />
                <textarea name="simple_cookie_gdpr_settings[cookies][${index}][description]" placeholder="Cookie Description"></textarea>
                <button type="button" class="removeCookieField" onclick="removeField(this)">Remove</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', fieldHTML);
    });
});

// Define removeField function globally to ensure it's accessible from inline HTML
window.removeField = function(button) {
    const fieldToRemove = button.closest('.cookieField');
    fieldToRemove.remove();
}
