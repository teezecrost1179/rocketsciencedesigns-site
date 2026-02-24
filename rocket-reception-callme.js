const callMeForm = document.getElementById("rr-callme-form");

if (callMeForm) {
  const apiBase = callMeForm.dataset.apiBase || "https://rocketagent.onrender.com";
  const subscriber = callMeForm.dataset.subscriber || "rocketsciencedesigns";
  const transferPreselect = callMeForm.dataset.transferPreselect || "";
  const status = callMeForm.querySelector(".rr-form-status");

  callMeForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    e.stopPropagation();

    const phoneInput = callMeForm.querySelector('input[name="phone"]');
    const phone = phoneInput ? phoneInput.value.trim() : "";

    if (!phone) {
      if (status) status.textContent = "Please enter a phone number.";
      return;
    }

    if (status) status.textContent = "Calling you now...";

    try {
      const resp = await fetch(apiBase + "/call", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          phone,
          subscriber,
          ...(transferPreselect ? { transferPreselect } : {}),
        }),
      });

      const data = await resp.json().catch(() => ({}));
      if (!resp.ok) {
        if (status) status.textContent = data.error || "Could not start the call.";
        return;
      }

      if (status) status.textContent = "Call started. Please answer your phone.";
    } catch (err) {
      if (status) status.textContent = "Could not start the call.";
    }
  });
}
