<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Rocket Agent Test Call</title>
  <style>
    body {
      font-family: system-ui, Arial, sans-serif;
      max-width: 480px;
      margin: 40px auto;
      padding: 20px;
    }
    label, input, button {
      width: 100%;
      display: block;
      margin-bottom: 12px;
    }
    input, button {
      padding: 10px;
      font-size: 16px;
    }
    button {
      cursor: pointer;
    }
    #status {
      margin-top: 10px;
      font-size: 14px;
    }
  </style>
</head>
<body>

  <h1>Test the Rocket Agent</h1>
  <p>Enter your phone number and our AI receptionist will call you.</p>

  <form id="ai-call-form">
    <label>Phone number:</label>
    <input type="tel" id="phone" placeholder="2045551234 or +12045551234" required>
    <button type="submit">Call me</button>
  </form>

  <div id="status"></div>

  <script>
    document.getElementById("ai-call-form").addEventListener("submit", async function(e) {
      e.preventDefault();
      const phone = document.getElementById("phone").value.trim();
      const status = document.getElementById("status");

      if (!phone) {
        status.textContent = "Please enter a phone number.";
        return;
      }

      status.textContent = "Requesting call…";

      try {
        const res = await fetch("https://rocketagent.onrender.com/call", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ phone })
        });

        if (res.ok) {
          status.textContent = "Your call is being placed!";
        } else {
          status.textContent = "Something went wrong making the call.";
        }
      } catch (err) {
        console.error(err);
        status.textContent = "Network error. Try again.";
      }
    });
  </script>

  <script src="rocket-chat-widget.js"></script>
  <script>
    RocketChatWidget.init({
      apiBase: "https://rocketagent.onrender.com",
      position: "br",
      offsetX: 24,
      offsetY: 24,
      title: "Rocket Agent",
      subtitle: "AI receptionist",
      greeting: "Hi, I'm Rocket, the AI receptionist for Rocket Science Designs. How can I help? If you’d prefer a phone call, just type “call me”."
    });
  </script>


</body>
</html>
