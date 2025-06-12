document
  .getElementById("orderForm")
  .addEventListener("submit", function (event) {
    const form = event.target;

    const showError = (msg, element) => {
      alert(msg);
      element.focus();
      event.preventDefault();
      return false;
    };

    const firstName = form.firstName;
    const lastName = form.lastName;
    const username = form.username;
    const email = form.email;
    const address = form.address;
    const country = form.country;
    const state = form.state;
    const zip = form.zip;

    const paymentMethod = form.paymentMethod.value;
    const cardName = form.cardName;
    const cardNumber = form.cardNumber;
    const cardExpiration = form.cardExpiration;
    const cardCVV = form.cardCVV;

    if (!firstName.value.trim())
      return showError("Please enter first name.", firstName);
    if (!lastName.value.trim())
      return showError("Please enter last name.", lastName);
    if (!username.value.trim())
      return showError("Please enter username.", username);
    if (!address.value.trim())
      return showError("Please enter address.", address);
    if (!country.value) return showError("Please select a country.", country);
    if (!state.value) return showError("Please select a state.", state);
    if (!zip.value.trim()) return showError("Please enter zip code.", zip);

    if (paymentMethod !== "PayPal") {
      if (!cardName.value.trim())
        return showError("Please enter name on card.", cardName);

      const cardNumberVal = cardNumber.value.trim();
      if (!/^\d{13,19}$/.test(cardNumberVal)) {
        return showError(
          "Please enter a valid credit card number (13-19 digits).",
          cardNumber
        );
      }

      const expiryVal = cardExpiration.value.trim();
      if (!/^(0[1-9]|1[0-2])\/?([0-9]{2}|[0-9]{4})$/.test(expiryVal)) {
        return showError(
          "Please enter a valid expiration date in MM/YY format.",
          cardExpiration
        );
      }

      const cvvVal = cardCVV.value.trim();
      if (!/^\d{3,4}$/.test(cvvVal)) {
        return showError("Please enter a valid 3 or 4-digit CVV.", cardCVV);
      }
    }

    return true;
  });
