// assets/js/admin-theme-settings.js

document.addEventListener("DOMContentLoaded", () => {
    const uploadBtn = document.getElementById("sanaportfolio_upload_logo_btn");
    const logoInput = document.getElementById("sanaportfolio_logo");
    const preview = document.getElementById("sanaportfolio_logo_preview");

    if (!uploadBtn || !logoInput) return;

    // Show existing preview on load
    if (logoInput.value) {
        preview.innerHTML = `<img src="${logoInput.value}" alt="Logo Preview" style="max-width:150px; height:auto; margin-top:10px; border:1px solid #ccc; padding:5px; border-radius:4px;">`;
    }

    uploadBtn.addEventListener("click", (e) => {
        e.preventDefault();

        // Use WordPress media uploader
        const frame = wp.media({
            title: "Select or Upload Logo",
            button: { text: "Use this logo" },
            multiple: false
        });

        frame.on("select", () => {
            const attachment = frame.state().get("selection").first().toJSON();
            logoInput.value = attachment.url;
            preview.innerHTML = `<img src="${attachment.url}" alt="Logo Preview" style="max-width:150px; height:auto; margin-top:10px; border:1px solid #ccc; padding:5px; border-radius:4px;">`;
        });

        frame.open();
    });
});
