(function () {
  "use strict";

  var _initialized = false;

  var defaultOptions = {
    apiBase: "", // REQUIRED
    position: "br", // t, tr, r, br, b, bl, l, tl
    offsetX: 20,
    offsetY: 20,
    title: "Rocket Agent",
    subtitle: "AI receptionist for Rocket Science Designs",
    greeting:
      "Hi, I'm Rocket, the AI receptionist for Rocket Science Designs. How can I help?",
    theme: "dark" // for future tweaks
  };

  function mergeOptions(userOptions) {
    var opts = {};
    for (var k in defaultOptions) {
      if (Object.prototype.hasOwnProperty.call(defaultOptions, k)) {
        opts[k] = defaultOptions[k];
      }
    }
    if (userOptions) {
      for (var key in userOptions) {
        if (Object.prototype.hasOwnProperty.call(userOptions, key)) {
          opts[key] = userOptions[key];
        }
      }
    }
    return opts;
  }

  function injectStyles() {
    if (document.getElementById("rocket-chat-widget-styles")) return;

    var css = `
    .rcw-root {
      position: fixed;
      z-index: 999999;
      font-family: system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;
      color: #f9fafb;
    }
    .rcw-bubble {
      width: 52px;
      height: 52px;
      border-radius: 999px;
      background: radial-gradient(circle at 30% 30%, #facc15 0, #f97316 40%, #0f172a 85%);
      box-shadow: 0 10px 25px rgba(0,0,0,0.6);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      border: 1px solid rgba(15,23,42,0.7);
    }
    .rcw-bubble-icon {
      font-size: 26px;
      transform: translateY(1px);
    }
    .rcw-panel {
      position: absolute;
      width: 340px;
      max-width: calc(100vw - 40px);
      height: 420px;
      max-height: calc(100vh - 80px);
      border-radius: 16px;
      overflow: hidden;
      background: radial-gradient(circle at top left, #111827 0, #020617 55%);
      box-shadow: 0 20px 40px rgba(0,0,0,0.8);
      border: 1px solid rgba(148,163,184,0.3);
      display: none;
      flex-direction: column;
    }
    .rcw-root.rcw-open .rcw-panel {
      display: flex;
    }

    .rcw-header {
      padding: 10px 12px;
      border-bottom: 1px solid rgba(148,163,184,0.3);
      display: flex;
      align-items: center;
      background: linear-gradient(135deg,#111827,#020617);
    }

    .rcw-header-left {
      display: flex;
      align-items: center;
      gap: 10px;
      flex: 1 1 auto;
      min-width: 0;
    }

    .rcw-header-avatar {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: radial-gradient(circle at 30% 30%, #facc15 0, #f97316 40%, #0f172a 85%);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
    }

    .rcw-header-text {
      display: flex;
      flex-direction: column;
      gap: 2px;
      min-width: 0;
    }

    .rcw-header-title {
      font-size: 13px;
      font-weight: 600;
    }

    .rcw-header-subtitle {
      font-size: 11px;
      color: #9ca3af;
    }

    .rcw-header-close {
      border: none;
      background: transparent;
      color: #9ca3af;
      cursor: pointer;
      font-size: 18px;
      padding: 0 6px;
      line-height: 1;
      margin-left: 8px;
      position: static !important;
      width: auto !important;
      min-width: 0 !important;
      flex: 0 0 auto !important;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }


    .rcw-messages {
      flex: 1;
      padding: 10px 10px 4px;
      overflow-y: auto;
      background: radial-gradient(circle at top,#020617 0,#000 60%);
    }
    .rcw-status {
      font-size: 10px;
      color: #9ca3af;
      padding: 0 10px 6px;
    }
    .rcw-footer {
      padding: 8px;
      border-top: 1px solid rgba(148,163,184,0.3);
      background: #020617;
      display: flex;
      flex-direction: column;
      align-items: stretch;
      gap: 6px;
    }

    .rcw-input {
      width: 100%;
      padding: 8px 10px;
      border-radius: 10px;
      border: 1px solid rgba(148,163,184,0.6);
      background: #020617 !important;
      color: #e5e7eb !important;
      font-size: 13px;
      outline: none;
      min-height: 40px;
      max-height: 90px;
      resize: none;
      line-height: 1.4;
      box-sizing: border-box;
      margin: 0;
      display: block;
    }


    .rcw-input::placeholder {
      color: #6b7280;
    }

    .rcw-send {
      align-self: flex-end;
      border: none;
      border-radius: 999px;
      padding: 6px 12px;
      font-size: 11px;
      font-weight: 500;
      cursor: pointer;
      background: linear-gradient(135deg,#22c55e,#16a34a);
      color: #022c22;
      display: inline-flex;
      align-items: center;
      gap: 4px;
    }

    .rcw-send[disabled] {
      opacity: 0.5;
      cursor: default;
    }
    .rcw-msg-row {
      margin-bottom: 8px;
      display: flex;
    }
    .rcw-msg-row.rcw-user {
      justify-content: flex-end;
    }
    .rcw-msg-row.rcw-agent {
      justify-content: flex-start;
    }
    .rcw-msg-bubble {
      max-width: 80%;
      padding: 7px 10px;
      border-radius: 14px;
      font-size: 13px;
      line-height: 1.4;
      word-wrap: break-word;
      white-space: pre-wrap;
    }
    .rcw-msg-row.rcw-agent .rcw-msg-bubble {
      background: rgba(15,23,42,0.95);
      border: 1px solid rgba(148,163,184,0.6);
    }
    .rcw-msg-row.rcw-user .rcw-msg-bubble {
      background: #4f46e5;
      border: 1px solid rgba(199,210,254,0.7);
    }
    .rcw-typing {
      display: inline-block;
      width: 18px;
      text-align: center;
    }
    .rcw-typing span {
      display: inline-block;
      width: 3px;
      height: 3px;
      margin: 0 1px;
      border-radius: 999px;
      background: #9ca3af;
      animation: rcw-typing 1s infinite ease-in-out;
    }
    .rcw-typing span:nth-child(2) { animation-delay: 0.15s; }
    .rcw-typing span:nth-child(3) { animation-delay: 0.3s; }
    @keyframes rcw-typing {
      0%,60%,100% { transform: translateY(0); opacity: 0.7; }
      30% { transform: translateY(-3px); opacity: 1; }
    }
    @media (max-width: 480px) {
      .rcw-panel {
        width: calc(100vw - 24px);
        height: calc(100vh - 40px);
      }
    }
    `;

    var style = document.createElement("style");
    style.id = "rocket-chat-widget-styles";
    style.type = "text/css";
    style.appendChild(document.createTextNode(css));
    document.head.appendChild(style);
  }

  function applyPosition(rootEl, bubbleEl, panelEl, position, offsetX, offsetY) {
    // reset
    rootEl.style.top = "";
    rootEl.style.right = "";
    rootEl.style.bottom = "";
    rootEl.style.left = "";

    var pos = (position || "br").toLowerCase();

    var isTop = pos.indexOf("t") === 0;
    var isBottom = pos.indexOf("b") === 0 || (!isTop && pos.indexOf("b") !== -1);
    var isLeft = pos.indexOf("l") !== -1;
    var isRight = pos.indexOf("r") !== -1;

    if (isTop) {
      rootEl.style.top = offsetY + "px";
    } else if (isBottom) {
      rootEl.style.bottom = offsetY + "px";
    } else {
      // center vertically
      rootEl.style.top = "50%";
      rootEl.style.transform = "translateY(-50%)";
    }

    if (isLeft) {
      rootEl.style.left = offsetX + "px";
    } else if (isRight) {
      rootEl.style.right = offsetX + "px";
    } else {
      // center horizontally
      rootEl.style.left = "50%";
      rootEl.style.transform = (rootEl.style.transform || "") + " translateX(-50%)";
    }

    // Position panel relative to bubble depending on corner
    // We'll keep panel "above" bubble for bottom positions, and "below" for top.
    panelEl.style.bottom = "";
    panelEl.style.top = "";
    panelEl.style.left = "";
    panelEl.style.right = "";

    if (isBottom) {
      panelEl.style.bottom = "60px";
    } else if (isTop) {
      panelEl.style.top = "60px";
    } else {
      panelEl.style.bottom = "60px";
    }

    if (isLeft) {
      panelEl.style.left = "0";
    } else if (isRight) {
      panelEl.style.right = "0";
    } else {
      panelEl.style.right = "0";
    }
  }

  function createWidget(options) {
    injectStyles();

    var root = document.createElement("div");
    root.className = "rcw-root";

    var bubble = document.createElement("div");
    bubble.className = "rcw-bubble";
    var icon = document.createElement("div");
    icon.className = "rcw-bubble-icon";
    icon.textContent = "🚀";
    bubble.appendChild(icon);

    var panel = document.createElement("div");
    panel.className = "rcw-panel";

    // Header
    var header = document.createElement("div");
    header.className = "rcw-header";

    var avatar = document.createElement("div");
    avatar.className = "rcw-header-avatar";
    avatar.textContent = "🚀";

    var headerText = document.createElement("div");
    headerText.className = "rcw-header-text";

    var titleEl = document.createElement("div");
    titleEl.className = "rcw-header-title";
    titleEl.textContent = options.title || defaultOptions.title;

    var subtitleEl = document.createElement("div");
    subtitleEl.className = "rcw-header-subtitle";
    subtitleEl.textContent = options.subtitle || defaultOptions.subtitle;

    headerText.appendChild(titleEl);
    headerText.appendChild(subtitleEl);

    var closeBtn = document.createElement("button");
    closeBtn.className = "rcw-header-close";
    closeBtn.type = "button";
    closeBtn.innerHTML = "&times;";

    // Wrap avatar + text together
    var headerLeft = document.createElement("div");
    headerLeft.className = "rcw-header-left";
    headerLeft.appendChild(avatar);
    headerLeft.appendChild(headerText);

    // Add to header
    header.appendChild(headerLeft);
    header.appendChild(closeBtn);


    // Body
    var messagesEl = document.createElement("div");
    messagesEl.className = "rcw-messages";

    var statusEl = document.createElement("div");
    statusEl.className = "rcw-status";

    // Footer
    var footer = document.createElement("div");
    footer.className = "rcw-footer";

    var input = document.createElement("textarea");
    input.className = "rcw-input";
    input.autocomplete = "off";
    input.placeholder = "Ask about websites, Shopify, branding...";

    var sendBtn = document.createElement("button");

    sendBtn.className = "rcw-send";
    sendBtn.type = "button";
    sendBtn.textContent = "Send";

    footer.appendChild(input);
    footer.appendChild(sendBtn);

    panel.appendChild(header);
    panel.appendChild(messagesEl);
    panel.appendChild(statusEl);
    panel.appendChild(footer);

    root.appendChild(panel);
    root.appendChild(bubble);
    document.body.appendChild(root);

    applyPosition(root, bubble, panel, options.position, options.offsetX, options.offsetY);

    var chatId = null;
    var sending = false;

    function appendMessage(role, text) {
      var row = document.createElement("div");
      row.className = "rcw-msg-row " + (role === "user" ? "rcw-user" : "rcw-agent");

      var bubbleEl = document.createElement("div");
      bubbleEl.className = "rcw-msg-bubble";
      bubbleEl.textContent = text;

      row.appendChild(bubbleEl);
      messagesEl.appendChild(row);
      messagesEl.scrollTop = messagesEl.scrollHeight;
    }

    function setStatus(text) {
      statusEl.textContent = text || "";
    }

    function createTypingIndicator() {
      var row = document.createElement("div");
      row.className = "rcw-msg-row rcw-agent";
      var bubbleEl = document.createElement("div");
      bubbleEl.className = "rcw-msg-bubble";
      bubbleEl.innerHTML =
        '<span class="rcw-typing"><span></span><span></span><span></span></span>';
      row.appendChild(bubbleEl);
      messagesEl.appendChild(row);
      messagesEl.scrollTop = messagesEl.scrollHeight;
      return row;
    }

    function normalizeApiBase(apiBase) {
      if (!apiBase) return "";
      return apiBase.replace(/\/+$/, "");
    }

    function sendMessage(text) {
      if (!text || !text.trim() || sending) return;
      sending = true;
      sendBtn.disabled = true;
      input.disabled = true;

      appendMessage("user", text);
      input.value = "";
      setStatus("Rocket is thinking...");

      var typingRow = createTypingIndicator();

      var payload = {
        message: text,
        chatId: chatId
      };

      var url = normalizeApiBase(options.apiBase) + "/chat";

      fetch(url, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload)
      })
        .then(function (resp) {
          return resp.json().then(function (data) {
            return { ok: resp.ok, data: data };
          });
        })
        .then(function (result) {
          messagesEl.removeChild(typingRow);

          if (!result.ok || result.data.error) {
            console.error("Rocket chat error:", result.data.error || result);
            appendMessage(
              "agent",
              "Sorry, I ran into an error. Please try again in a moment."
            );
          } else {
            chatId = result.data.chatId || chatId;
            var reply = result.data.reply || "(No response)";
            appendMessage("agent", reply);
          }
        })
        .catch(function (err) {
          try {
            messagesEl.removeChild(typingRow);
          } catch (e) {}
          console.error("Rocket chat network error:", err);
          appendMessage(
            "agent",
            "Sorry, I couldn't reach the chat server. Please try again later."
          );
        })
        .finally(function () {
          sending = false;
          sendBtn.disabled = false;
          input.disabled = false;
          input.focus();
          setStatus("");
        });
    }

    // Events
    bubble.addEventListener("click", function () {
      if (root.classList.contains("rcw-open")) {
        root.classList.remove("rcw-open");
      } else {
        root.classList.add("rcw-open");
        input.focus();
      }
    });

    closeBtn.addEventListener("click", function () {
      root.classList.remove("rcw-open");
    });

    sendBtn.addEventListener("click", function () {
      sendMessage(input.value);
    });

    input.addEventListener("keydown", function (e) {
      if (e.key === "Enter" && !e.shiftKey) {
        e.preventDefault();
        sendMessage(input.value);
      }
    });

    // Initial greeting
    if (options.greeting) {
      appendMessage("agent", options.greeting);
    }

    return {
      root: root,
      open: function () {
        root.classList.add("rcw-open");
        input.focus();
      },
      close: function () {
        root.classList.remove("rcw-open");
      }
    };
  }

  var RocketChatWidget = {
    init: function (userOptions) {
      if (_initialized) {
        console.warn("RocketChatWidget.init called more than once; ignoring.");
        return;
      }
      _initialized = true;

      var options = mergeOptions(userOptions || {});
      if (!options.apiBase) {
        console.error("RocketChatWidget: apiBase is required");
        return;
      }

      if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", function () {
          createWidget(options);
        });
      } else {
        createWidget(options);
      }
    }
  };

  // Expose globally
  if (!window.RocketChatWidget) {
    window.RocketChatWidget = RocketChatWidget;
  } else {
    console.warn("window.RocketChatWidget already exists; not overwriting.");
  }
})();
