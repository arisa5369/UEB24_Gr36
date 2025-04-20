<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate - Tenth Life Cat Rescue</title>
    <link rel="stylesheet" href="donate.css">
</head>
<body>

    <div id="header-placeholder"></div>

    <script>
        class Modal {
            constructor(modalId, openButtonSelector, closeButtonSelector) {
                this.modal = document.getElementById(modalId);
                this.openButton = document.querySelector(openButtonSelector);
                this.closeButton = document.getElementById(closeButtonSelector);

                this.init();
            }

            init() {
                if (this.openButton) {
                    this.openButton.addEventListener("click", () => {
                        this.modal.style.display = "flex";
                    });
                }

                if (this.closeButton) {
                    this.closeButton.addEventListener("click", () => {
                        this.modal.style.display = "none";
                    });
                }

                window.addEventListener("click", (event) => {
                    if (event.target === this.modal) {
                        this.modal.style.display = "none";
                    }
                });
            }
        }

        class Donation {
            constructor(buttonSelector, amountInputSelector) {
                this.donateButton = document.querySelector(buttonSelector);
                this.amountInput = document.querySelector(amountInputSelector);

                this.init();
            }

            init() {
                if (this.donateButton) {
                    this.donateButton.addEventListener("click", () => {
                        let amount = this.amountInput.value || "Custom Amount";
                        alert(`Thank you for donating ${amount}!`);
                    });
                }
            }
        }

        // Instancimi i objekteve për modalet dhe donacionet
        const modal1 = new Modal("modal1", ".signup-btn", "closeModal");
        const donation = new Donation(".donate-button", ".custom-amount");

        fetch('/UEB24_Gr36/faqja_kryesore/header.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('header-placeholder').innerHTML = data;
            })
            .catch(error => console.error('Error loading header:', error));
    </script>

    <main class="donate-page">
        <!-- Video Banner Section -->
        <section class="donate-banner">
            <video class="background-video" autoplay muted loop>
                <source src="imagedonate/mixkit-dog-walking-with-its-owner-in-a-park-1476-hd-ready.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="overlay-content">
                <h1>Make a Difference</h1>
                <p>Your support helps save lives.</p>
            </div>
        </section>

        <!-- Donation Section -->
        <section class="donation-options">
            <div class="donation-box">
                <h2>One Time Donation</h2>
                <div class="amount-options">
                    <button>$25</button>
                    <button>$50</button>
                    <button>$100</button>
                    <button>$250</button>
                </div>
                <input type="text" placeholder="Custom Amount ($)" class="custom-amount">
                <button class="donate-button">DONATE♡</button>
            </div>
        </section>
    </main>

    <div id="modal1" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close-button">&times;</span>
            <p>Sign up for more updates!</p>
        </div>
    </div>

    <script src="donate.js"></script>
</body>
</html>
