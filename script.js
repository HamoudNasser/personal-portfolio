
const lightbox = document.getElementById("certificate-lightbox");
const lightboxImage = document.getElementById("lightbox-image");
const lightboxTitle = document.getElementById("lightbox-title");
const closeButton = document.querySelector(".lightbox-close");

let lastFocusedElement = null;

document.querySelectorAll(".certificate-image").forEach(link => {

    link.addEventListener("click", function(event) {
        event.preventDefault();

        lastFocusedElement = document.activeElement;

        lightboxImage.src = this.href;
        lightboxImage.alt = this.dataset.certificateTitle;
        lightboxTitle.textContent = this.dataset.certificateTitle;

        lightbox.hidden = false;
        document.body.style.overflow = "hidden";
        closeButton.focus();
    });

});

function closeLightbox() {
    lightbox.hidden = true;
    lightboxImage.removeAttribute("src");
    document.body.style.overflow = "";

    if (lastFocusedElement) {
        lastFocusedElement.focus();
    }
}

closeButton.addEventListener("click", closeLightbox);

lightbox.addEventListener("click", function(event) {
    if (event.target === lightbox) {
        closeLightbox();
    }
});

document.addEventListener("keydown", function(event) {
    if (lightbox.hidden) return;

    if (event.key === "Escape") {
        closeLightbox();
    }

    if (event.key === "Tab") {
        event.preventDefault();
        closeButton.focus();
    }
});











const menuToggle = document.querySelector(".menu-toggle");
const navLinks = document.querySelector(".nav-links");

if (menuToggle && navLinks) {

    function closeMenu() {
        navLinks.classList.remove("active");
        menuToggle.setAttribute("aria-expanded", "false");
        menuToggle.setAttribute(
            "aria-label",
            "Open navigation menu"
        );
    }

    menuToggle.addEventListener("click", function () {

        const isOpen = navLinks.classList.toggle("active");

        menuToggle.setAttribute(
            "aria-expanded",
            String(isOpen)
        );

        menuToggle.setAttribute(
            "aria-label",
            isOpen ? "Close navigation menu" : "Open navigation menu"
        );
    });

    navLinks.querySelectorAll("a").forEach(link => {
        link.addEventListener("click", closeMenu);
    });

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            closeMenu();
        }
    });
}








const countdownBox = document.getElementById("countdown-box");
const countdownText = document.getElementById("countdown");
const sendButton = document.querySelector(".send-btn");

if (countdownBox && countdownText && sendButton) {

    const initialRemaining = Number(
        countdownBox.dataset.remaining
    );

    if (initialRemaining > 0) {

        const endTime = Date.now() + initialRemaining * 1000;

        function updateCountdown() {

            const remaining = Math.max(
                0,
                Math.ceil((endTime - Date.now()) / 1000)
            );

            countdownText.textContent = remaining;

            if (remaining > 0) {

                countdownBox.hidden = false;
                sendButton.disabled = true;
                sendButton.textContent =
                    `Send Message (${remaining}s)`;

            } else {

                countdownBox.hidden = true;
                sendButton.disabled = false;
                sendButton.textContent = "Send Message";

                clearInterval(timer);
            }
        }

        const timer = setInterval(updateCountdown, 250);

        updateCountdown();
    }
}
