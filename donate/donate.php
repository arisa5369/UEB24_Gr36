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
                        alert(Thank you for donating ${amount}!);
                    });
                }
            }
        }

        // Instantiation of classes
        const modal = new Modal("modal1", ".signup-btn", "closeModal");
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
Përmbledhje e ndryshimeve:
Modal Class: Kjo klasë kontrollon hapjen dhe mbylljen e modalit për regjistrim (signup).

Donation Class: Kjo klasë kontrollon funksionalitetin për dhënien e donacioneve. Përdoruesi mund të zgjedhë një shumë ose të shkruajë një shumë të personalizuar.

Duke përdorur instancimin: Krijojmë instanca të klasave Modal dhe Donation që drejtojnë funksionet në faqe.

Ky është një version më i thjeshtë dhe i organizuar i kodit që përdor OOP për të menaxhuar modalet dhe donacionet. Të gjitha funksionet janë të ndara në klasa të veçanta, që e bëjnë kodin më të qartë dhe të menaxhueshëm.







You said:
o jo ta ndryshoj te gjithen por vetem ndonje ndryshim te thjeshte te atij kodi qe mund ta shtoj oop


ChatGPT said:
E kuptoj! Nëse dëshironi të bëni një ndryshim të thjeshtë dhe të shtoni OOP pa ndryshuar krejt kodin, mund të përdorni OOP për menaxhimin e modaleve dhe funksionalitetin e dhënies së donacioneve në një mënyrë më të thjeshtë.

Ja një shembull ku vetëm disa pjesë të kodit janë ndërruar në OOP, pa prekur pjesën e mbetur të kodit:

html
Copy
Edit
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
        // OOP për menaxhimin e modalit
        class Modal {
            constructor(modalId, openButtonSelector, closeButtonSelector) {
                this.modal = document.getElementById(modalId);
                this.openButton = document.querySelector(openButtonSelector);
                this.closeButton = document.getElementById(closeButtonSelector);

                this.init();
            }

            init() {
                this.openButton?.addEventListener("click", () => {
                    this.modal.style.display = "flex";
                });

                this.closeButton?.addEventListener("click", () => {
                    this.modal.style.display = "none";
                });

                window.addEventListener("click", (event) => {
                    if (event.target === this.modal) {
                        this.modal.style.display = "none";
                    }
                });
            }
        }

        // OOP për menaxhimin e donacioneve
        class Donation {
            constructor(donateButtonSelector, amountInputSelector) {
                this.donateButton = document.querySelector(donateButtonSelector);
                this.amountInput = document.querySelector(amountInputSelector);

                this.init();
            }

            init() {
                this.donateButton?.addEventListener("click", () => {
                    let amount = this.amountInput.value || "Custom Amount";
                    alert(Thank you for donating ${amount}!);
                });
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

        <section class="donate-description">
            <p>
                At Petfinder, your generous support is essential to helping animals in need find loving homes.
                Your contributions empower our mission to connect pets with caring adopters, provide necessary
                medical care, and promote responsible pet ownership. No matter the size of your donation, you're
                making a meaningful impact on the lives of countless animals. Together, we’re creating brighter
                futures for pets everywhere!
            </p>
        </section>

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