/**
 * Social Strategy Discovery -- Form + Results Config (single source of truth)
 * - Render questions/options from this config
 * - Store only selected option IDs in localStorage
 * - Build results by looking up option.meaning (and optional tags)
 */

// Questionnaire config: questions, options, meanings, tags, and categories.
export const SOCIAL_DISCOVERY_FORM = {
  version: "1.2.0",
  storageKey: "social_discovery_answers_v1",

  questions: [
    {
      id: "q1",
      step: 1,
      title: "Who is most important for your business to reach right now?",
      instructions: "Select up to 2",
      type: "multi",
      maxSelect: 2,
      options: [
        {
          id: "direct_buyers",
          label: "People who buy a product or service from us directly",
          meaning:
            "We will prioritize repeatable, easy-to-understand content over one-off or experimental posts, ensuring new audiences can quickly understand what you offer and feel comfortable engaging before making a decision.",
          tags: [
            "audience:b2c",
            "priority:reach",
            "priority:familiarity",
            "content:repeatable",
            "platform:discovery"
          ],
          category: "where_we_show_up"
        },
        {
          id: "ongoing_1to1",
          label: "People who work with us one-on-one or on an ongoing basis",
          meaning:
            "We will focus on trust-building content that explains how you think, work, and make decisions, reducing uncertainty and pre-selling the relationship before someone reaches out.",
          tags: [
            "audience:service",
            "priority:trust",
            "content:perspective",
            "content:process",
            "platform:conversation"
          ],
          category: "what_we_focus_on"
        },
        {
          id: "b2b_orgs",
          label: "Other businesses or organizations",
          meaning:
            "We will emphasize credibility, clarity, and proof over trends or entertainment, ensuring your social presence supports careful, professional decision-making.",
          tags: [
            "audience:b2b",
            "priority:credibility",
            "content:proof",
            "tone:professional",
            "platform:professional"
          ],
          category: "how_this_should_feel"
        },
        {
          id: "local_regional",
          label: "A local or regional audience",
          meaning:
            "We will prioritize familiarity and local recognition over scale, using consistent visual and contextual cues that make your brand recognizable within a specific community.",
          tags: [
            "audience:local",
            "priority:familiarity",
            "content:community",
            "platform:local"
          ],
          category: "where_we_show_up"
        }
      ]
    },

    {
      id: "q2",
      step: 2,
      title:
        "When someone is deciding whether to work with you or buy from you, what matters most to them?",
      instructions: "Select up to 3",
      type: "multi",
      maxSelect: 3,
      options: [
        {
          id: "trust_credibility",
          label: "Trust and credibility",
          meaning:
            "We will avoid overly casual or trend-driven content and instead lead with clear, polished messaging that consistently reinforces professionalism and competence.",
          tags: [
            "driver:trust",
            "tone:professional",
            "content:authority"
          ],
          category: "how_this_should_feel"
        },
        {
          id: "proof_experience",
          label: "Proof of results or experience",
          meaning:
            "We will make proof-based content a recurring pillar, regularly showing examples, outcomes, testimonials, and experience signals rather than treating them as occasional posts.",
          tags: [
            "driver:proof",
            "content:testimonials",
            "content:examples"
          ],
          category: "what_we_focus_on"
        },
        {
          id: "education_clarity",
          label: "Clear explanations or education",
          meaning:
            "We will consistently create educational content that explains how things work and answers common questions, so people feel informed before engaging.",
          tags: [
            "driver:education",
            "content:how_it_works",
            "content:process"
          ],
          category: "what_we_focus_on"
        },
        {
          id: "relatable_connection",
          label: "Personal connection or relatability",
          meaning:
            "We will intentionally include perspective and human content so people can understand who you are, how you think, and what it feels like to work with you.",
          tags: [
            "driver:connection",
            "tone:human",
            "content:storytelling"
          ],
          category: "how_this_should_feel"
        },
        {
          id: "convenience_ease",
          label: "Convenience or ease",
          meaning:
            "We will prioritize clarity and simplicity in both content and calls to action, removing friction wherever possible.",
          tags: [
            "driver:convenience",
            "content:clarity",
            "cta:low_friction"
          ],
          category: "what_social_is_meant_to_do"
        },
        {
          id: "price_value",
          label: "Price or value",
          meaning:
            "We will consistently frame your offering around outcomes and differentiation, reinforcing why the value justifies the cost.",
          tags: [
            "driver:value",
            "content:value_framing",
            "content:differentiation"
          ],
          category: "what_we_focus_on"
        }
      ]
    },

    {
      id: "q3",
      step: 3,
      title: "How do most new opportunities currently come to you?",
      instructions: "Select one",
      type: "single",
      options: [
        {
          id: "referrals",
          label: "Referrals or word of mouth",
          meaning:
            "We will treat social media as a validation layer, ensuring your presence reinforces trust and credibility when people look you up after hearing about you elsewhere.",
          tags: [
            "funnel:validation",
            "priority:trust",
            "platform:credibility"
          ],
          category: "what_social_is_meant_to_do"
        },
        {
          id: "repeat_relationships",
          label: "Repeat customers or existing relationships",
          meaning:
            "We will focus on consistency and long-term brand reinforcement rather than constant acquisition.",
          tags: [
            "funnel:retention",
            "priority:consistency",
            "platform:community"
          ],
          category: "what_social_is_meant_to_do"
        },
        {
          id: "search_website",
          label: "Online search or website",
          meaning:
            "We will align social content closely with your website messaging to reinforce credibility once people find you through search.",
          tags: [
            "funnel:assist",
            "priority:credibility",
            "platform:professional"
          ],
          category: "where_we_show_up"
        },
        {
          id: "social_already",
          label: "Social media",
          meaning:
            "We will optimize existing platforms and content before expanding into new ones, tightening messaging and calls to action.",
          tags: [
            "funnel:acquisition",
            "priority:optimization",
            "platform:active"
          ],
          category: "where_we_show_up"
        },
        {
          id: "outreach_networking",
          label: "Outreach or networking",
          meaning:
            "We will use social media to pre-sell trust and authority before conversations happen.",
          tags: [
            "funnel:warmup",
            "priority:authority",
            "platform:professional"
          ],
          category: "how_this_should_feel"
        },
        {
          id: "inconsistent",
          label: "Not consistently yet",
          meaning:
            "We will focus first on building a clear, credible baseline presence before attempting aggressive growth or experimentation.",
          tags: [
            "funnel:foundation",
            "priority:awareness",
            "platform:discovery"
          ],
          category: "where_we_show_up"
        }
      ]
    },

    {
      id: "q4",
      step: 4,
      title:
        "How important is emotional connection or personality in your brand's online presence?",
      instructions: "Select one",
      type: "single",
      options: [
        {
          id: "personality_low",
          label: "Not important",
          meaning:
            "We will keep content primarily informational and professional, avoiding personal storytelling unless it directly supports clarity or trust.",
          tags: [
            "tone:reserved"
          ],
          category: "how_this_should_feel"
        },
        {
          id: "personality_mid",
          label: "Somewhat important",
          meaning:
            "We will balance professional authority with selective human moments to keep the brand approachable without oversharing.",
          tags: [
            "tone:balanced"
          ],
          category: "how_this_should_feel"
        },
        {
          id: "personality_high",
          label: "Very important",
          meaning:
            "We will intentionally plan storytelling and human content as a core part of the strategy rather than treating it as filler.",
          tags: [
            "tone:human",
            "content:storytelling"
          ],
          category: "how_this_should_feel"
        }
      ]
    },

    {
      id: "q5",
      step: 5,
      title: "Where do you want social media to lead people most often?",
      instructions: "Select up to 2",
      type: "multi",
      maxSelect: 2,
      options: [
        {
          id: "cta_dms",
          label: "Direct messages or conversations",
          meaning:
            "We will design content that explicitly invites conversation and makes outreach feel low-pressure and natural.",
          tags: [
            "cta:conversation",
            "platform:conversation"
          ],
          category: "what_social_is_meant_to_do"
        },
        {
          id: "cta_email",
          label: "Email",
          meaning:
            "We will use social content to support longer-term nurturing rather than expecting immediate conversion.",
          tags: [
            "cta:nurture",
            "platform:trust"
          ],
          category: "what_social_is_meant_to_do"
        },
        {
          id: "cta_calls",
          label: "Phone or video calls",
          meaning:
            "We will use content to answer common questions and objections so calls start warmer and more informed.",
          tags: [
            "cta:high_intent",
            "platform:professional"
          ],
          category: "what_social_is_meant_to_do"
        },
        {
          id: "cta_booking",
          label: "Website forms or bookings",
          meaning:
            "We will prioritize clarity, structure, and conversion-focused messaging.",
          tags: [
            "cta:conversion",
            "platform:credibility"
          ],
          category: "what_social_is_meant_to_do"
        },
        {
          id: "cta_in_person",
          label: "In-person interactions",
          meaning:
            "We will treat social as a reinforcement tool that builds familiarity and trust ahead of offline engagement.",
          tags: [
            "cta:offline",
            "platform:local"
          ],
          category: "what_social_is_meant_to_do"
        }
      ]
    },

    {
      id: "q6",
      step: 6,
      title: "What would make you say \"this is working\" six months from now?",
      instructions: "Select up to 2",
      type: "multi",
      maxSelect: 2,
      options: [
        {
          id: "success_recognition",
          label: "More people recognize my brand",
          meaning:
            "We will prioritize reach, repetition, and recognizability over niche experimentation.",
          tags: [
            "kpi:awareness",
            "platform:discovery"
          ],
          category: "where_we_show_up"
        },
        {
          id: "success_quality_inquiries",
          label: "I'm getting better quality inquiries",
          meaning:
            "We will intentionally clarify fit and expectations, even if that slightly narrows the audience.",
          tags: [
            "kpi:lead_quality",
            "platform:trust"
          ],
          category: "what_social_is_meant_to_do"
        },
        {
          id: "success_trust_faster",
          label: "People trust me faster",
          meaning:
            "We will double down on clarity, proof, and consistency to shorten the trust curve.",
          tags: [
            "kpi:trust",
            "platform:credibility"
          ],
          category: "how_this_should_feel"
        },
        {
          id: "success_sales_easier",
          label: "Sales conversations are easier",
          meaning:
            "We will pre-educate and pre-qualify through content so conversations start further along.",
          tags: [
            "kpi:sales_efficiency",
            "platform:professional"
          ],
          category: "what_social_is_meant_to_do"
        },
        {
          id: "success_consistency",
          label: "I feel more consistent and confident online",
          meaning:
            "We will prioritize sustainable systems and a defined content structure over volume.",
          tags: [
            "kpi:sustainability",
            "platform:stable"
          ],
          category: "what_social_is_meant_to_do"
        }
      ]
    },

    {
      id: "q7",
      step: 7,
      title: "How often could you realistically show up on social media?",
      instructions: "Select one",
      type: "single",
      options: [
        {
          id: "cadence_low",
          label: "1-2 times per week",
          meaning:
            "We will focus on fewer, higher-impact posts with clear purpose rather than frequent updates.",
          tags: [
            "cadence:low"
          ],
          category: "what_social_is_meant_to_do"
        },
        {
          id: "cadence_mid",
          label: "3-4 times per week",
          meaning:
            "We will rotate a defined set of content types and review performance regularly.",
          tags: [
            "cadence:balanced"
          ],
          category: "what_social_is_meant_to_do"
        },
        {
          id: "cadence_high",
          label: "5+ times per week",
          meaning:
            "We will support higher output with structured formats and ongoing optimization.",
          tags: [
            "cadence:high"
          ],
          category: "what_social_is_meant_to_do"
        }
      ]
    }
  ]
};

// Platform -> tags used to score best-fit social channels.
export const PLATFORM_TRAIT_MAP = {
  instagram: [
    "platform:visual",
    "platform:conversation",
    "platform:local",
    "platform:discovery",
    "platform:community"
  ],

  linkedin: [
    "platform:professional",
    "platform:credibility",
    "platform:conversation"
  ],

  tiktok: [
    "platform:discovery"
  ],

  youtube_shorts: [
    "platform:discovery"
  ],

  youtube: [
    "platform:education",
    "platform:authority",
    "platform:trust"
  ],

  facebook: [
    "platform:local",
    "platform:community"
  ]
};

/**
 * Helper: build a lookup map for meanings/tags by questionId/optionId.
 * Useful for fast result rendering.
 */
// Build a question/option lookup table for fast access in rendering.
export function buildLookup(form = SOCIAL_DISCOVERY_FORM) {
  const byQuestion = {};
  for (const q of form.questions) {
    byQuestion[q.id] = {
      title: q.title,
      options: Object.fromEntries(q.options.map((o) => [o.id, o])),
      type: q.type,
      maxSelect: q.maxSelect ?? 1,
      instructions: q.instructions,
    };
  }
  return byQuestion;
}

/**
 * Helper: given `answers` (ids only), produce a results object.
 * answers example:
 * { q1: ["b2b_orgs","local_regional"], q3: "referrals", q4: "personality_mid", ... }
 */
// Convert stored answers into labels, meanings, categories, and tags.
export function buildResults(answers, form = SOCIAL_DISCOVERY_FORM) {
  const lookup = buildLookup(form);

  const sections = form.questions.map((q) => {
    const raw = answers?.[q.id];
    const selectedIds = Array.isArray(raw) ? raw : raw ? [raw] : [];
    const selected = selectedIds
      .map((id) => lookup[q.id]?.options?.[id])
      .filter(Boolean);

    return {
      questionId: q.id,
      questionTitle: q.title,
      selectedOptionIds: selectedIds,
      selectedLabels: selected.map((o) => o.label),
      meanings: selected.map((o) => o.meaning),
      selectedOptions: selected.map((o) => ({
        label: o.label,
        meaning: o.meaning,
        category: o.category,
      })),
      tags: selected.flatMap((o) => o.tags || []),
    };
  });

  const allTags = sections.flatMap((s) => s.tags);
  return { sections, allTags };
}

// DOM mount point id for the questionnaire app.
const APP_ID = "social-discovery-app";
// localStorage key for persisted answers.
const STORAGE_KEY = SOCIAL_DISCOVERY_FORM.storageKey;
// Total number of questions for progress and pagination.
const TOTAL_STEPS = SOCIAL_DISCOVERY_FORM.questions.length;
// Minimum time before sending results (anti-bot).
const MIN_ELAPSED_MS = 8000;
// Timestamp when the session started (anti-bot).
const STARTED_AT = Date.now();

// Root element where the questionnaire UI is rendered.
const app = document.getElementById(APP_ID);
if (!app) {
  throw new Error("Social Discovery app container not found.");
}

// UI state: current step, answers, and send status.
const state = {
  index: 0,
  answers: loadAnswers(),
  required: {},
  lastSentKey: null,
  lastSentSuccess: false,
};

// Load saved answers from localStorage.
function loadAnswers() {
  try {
    const raw = localStorage.getItem(STORAGE_KEY);
    return raw ? JSON.parse(raw) : {};
  } catch {
    return {};
  }
}

// Persist answers to localStorage.
function saveAnswers() {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(state.answers));
}

// Move to a new step, clamped to valid range.
function setIndex(nextIndex) {
  const maxIndex = TOTAL_STEPS;
  state.index = Math.min(Math.max(nextIndex, 0), maxIndex);
  render();
}

// Render the current step or the summary view.
function render() {
  app.innerHTML = "";

  if (state.index < TOTAL_STEPS) {
    renderQuestion(SOCIAL_DISCOVERY_FORM.questions[state.index]);
  } else {
    renderSummary();
  }
}

// Render a single question step with options and navigation.
function renderQuestion(question) {
  const lookup = buildLookup();
  const selected = normalizeSelection(state.answers[question.id], question.type);

  // Step header: question number, title, and instructions.
  const header = document.createElement("div");
  header.className = "question-header";
  header.innerHTML = `
    <p class="question-step">Question ${question.step} of ${TOTAL_STEPS}</p>
    <h2 class="question-title">${question.title}</h2>
    <p class="question-instructions">${question.instructions}</p>
  `;

  // Options list: each choice toggles selection state.
  const optionsWrap = document.createElement("div");
  optionsWrap.className = "question-options";

  question.options.forEach((option) => {
    const isActive = selected.includes(option.id);
    const button = document.createElement("button");
    button.type = "button";
    button.className = `option-btn${isActive ? " is-active" : ""}`;
    button.dataset.optionId = option.id;
    button.textContent = option.label;
    button.addEventListener("click", () => {
      const nextSelection = toggleSelection({
        current: selected,
        optionId: option.id,
        type: question.type,
        maxSelect: question.maxSelect,
      });
      state.answers[question.id] = nextSelection;
      saveAnswers();
      render();
    });
    optionsWrap.appendChild(button);
  });

  // Inline validation hint shown after clicking Next with no selection.
  const requiredNote = document.createElement("p");
  requiredNote.className = "question-required";
  requiredNote.textContent = "Please select at least one option to continue.";
  requiredNote.hidden = selected.length > 0 || !state.required[question.id];

  // Navigation controls (Back / Next).
  const nav = document.createElement("div");
  nav.className = "question-nav";

  const backBtn = document.createElement("button");
  backBtn.type = "button";
  backBtn.className = "nav-btn ghost";
  backBtn.textContent = "Back";
  backBtn.disabled = state.index === 0;
  backBtn.addEventListener("click", () => setIndex(state.index - 1));

  const nextBtn = document.createElement("button");
  nextBtn.type = "button";
  nextBtn.className = "nav-btn";
  nextBtn.textContent = state.index === TOTAL_STEPS - 1 ? "View Summary" : "Next";
  if (!selected.length) {
    nextBtn.classList.add("is-disabled");
  }
  nextBtn.addEventListener("click", () => {
    if (!selected.length) {
      state.required[question.id] = true;
      render();
      return;
    }
    setIndex(state.index + 1);
  });

  nav.append(backBtn, nextBtn);

  // Progress indicator based on the question step.
  const progress = document.createElement("div");
  progress.className = "question-progress";
  progress.innerHTML = `
    <div class="progress-track">
      <span class="progress-fill" style="width: ${((question.step - 1) / TOTAL_STEPS) * 100}%"></span>
    </div>
    <p class="progress-text">${question.step} / ${TOTAL_STEPS}</p>
  `;

  app.append(header, optionsWrap, requiredNote, nav, progress);
}

// Render the results summary with categories and send controls.
function renderSummary() {
  const results = buildResults(state.answers);
  const summary = document.createElement("div");
  summary.className = "summary";

  const title = document.createElement("h2");
  title.className = "summary-title";
  title.textContent = "Your Social Strategy Snapshot";

  // Email send instructions and form wrapper.
  const sendIntro = document.createElement("div");
  sendIntro.className = "summary-send-intro";

  // Intro copy explaining the email send.
  const sendIntroText = document.createElement("p");
  sendIntroText.textContent =
    "If you provide your email address, we'll send these results to you and Rocket Science Designs for review.";

  // Layout container for email input + send button.
  const sendForm = document.createElement("div");
  sendForm.className = "summary-send-form";

  // Email input for user to receive results.
  const emailInput = document.createElement("input");
  emailInput.type = "email";
  emailInput.name = "userEmail";
  emailInput.placeholder = "you@example.com";
  emailInput.className = "summary-email-input";
  emailInput.autocomplete = "email";
  emailInput.required = true;

  // Manual send trigger button.
  const sendButton = document.createElement("button");
  sendButton.type = "button";
  sendButton.className = "nav-btn";
  sendButton.textContent = "Send It";

  sendForm.append(emailInput, sendButton);
  sendIntro.append(sendIntroText, sendForm);

  // Platform recommendation sentence derived from platform tags.
  const platform = buildPlatformRecommendation(results.allTags);
  // UI block for platform recommendations.
  const platformBlock = document.createElement("div");
  platformBlock.className = "summary-platforms";

  const platformTitle = document.createElement("h3");
  platformTitle.textContent = "Platform Recommendations";

  const platformCopy = document.createElement("p");
  platformCopy.className = "summary-platforms-copy";
  platformCopy.innerHTML = platform.sentenceHtml;

  platformBlock.append(platformTitle, platformCopy);

  // Live status text for send success/failure.
  const sendStatus = document.createElement("p");
  sendStatus.className = "summary-send-status";
  sendStatus.setAttribute("aria-live", "polite");
  sendIntro.appendChild(sendStatus);

  // Category labels and descriptions for grouped meanings.
  const categoryMeta = [
    {
      id: "where_we_show_up",
      title: "Where we show up",
      description: "Platforms, reach, discovery vs validation",
    },
    {
      id: "what_we_focus_on",
      title: "What we focus on",
      description: "Content pillars, themes, proof, education",
    },
    {
      id: "how_this_should_feel",
      title: "How this should feel",
      description: "Tone, trust, positioning, personality",
    },
    {
      id: "what_social_is_meant_to_do",
      title: "What social is meant to do",
      description: "Conversion path, role in funnel, cadence, success definition",
    },
  ];

  // Bucket meanings by category key.
  const categoryBuckets = categoryMeta.reduce((acc, category) => {
    acc[category.id] = [];
    return acc;
  }, {});

  results.sections.forEach((section) => {
    section.selectedOptions.forEach((option) => {
      if (option.category && categoryBuckets[option.category]) {
        categoryBuckets[option.category].push(option.meaning);
      }
    });
  });

  // Wrapper for category summary blocks.
  const categories = document.createElement("div");
  categories.className = "summary-categories";

  categoryMeta.forEach((category) => {
    const block = document.createElement("div");
    block.className = "summary-category";

    const heading = document.createElement("h3");
    heading.textContent = category.title;

    const description = document.createElement("p");
    description.className = "summary-category-desc";
    description.textContent = category.description;

    const list = document.createElement("ul");
    list.className = "summary-category-list";

    const meanings = categoryBuckets[category.id] || [];
    if (!meanings.length) {
      const li = document.createElement("li");
      li.textContent = "No responses selected.";
      list.appendChild(li);
    } else {
      meanings.forEach((meaning) => {
        const li = document.createElement("li");
        li.textContent = meaning;
        list.appendChild(li);
      });
    }

    block.append(heading, description, list);
    categories.appendChild(block);
  });

  // Heading for per-question accordion details.
  const detailHeading = document.createElement("h3");
  detailHeading.className = "summary-detail-title";
  detailHeading.textContent = "What your answers told us";

  // Accordion list showing "You said" and "This tells us".
  const detailList = document.createElement("div");
  detailList.className = "summary-detail-list";

  results.sections.forEach((section) => {
    const item = document.createElement("details");
    item.className = "summary-accordion-item";
    item.open = false;

    const summaryRow = document.createElement("summary");
    summaryRow.textContent = section.questionTitle;

    const response = document.createElement("p");
    response.className = "summary-response";
    response.textContent = section.selectedLabels.length
      ? `You said: ${section.selectedLabels.join(", ")}`
      : "You said: No response selected.";

    item.append(summaryRow, response);

    section.meanings.forEach((meaning) => {
      const meaningEl = document.createElement("p");
      meaningEl.className = "summary-meaning";
      meaningEl.textContent = `This tells us: ${meaning}`;
      item.appendChild(meaningEl);
    });

    detailList.appendChild(item);
  });

  // Navigation buttons at the end of summary.
  const nav = document.createElement("div");
  nav.className = "question-nav";

  const backBtn = document.createElement("button");
  backBtn.type = "button";
  backBtn.className = "nav-btn ghost";
  backBtn.textContent = "Back";
  backBtn.addEventListener("click", () => setIndex(TOTAL_STEPS - 1));

  const resetBtn = document.createElement("button");
  resetBtn.type = "button";
  resetBtn.className = "nav-btn";
  resetBtn.textContent = "Start Over";
  resetBtn.addEventListener("click", () => {
    state.answers = {};
    state.required = {};
    saveAnswers();
    setIndex(0);
  });

  nav.append(backBtn, resetBtn);

  // Hidden honeypot field to catch simple bots.
  const honeypot = document.createElement("input");
  honeypot.type = "text";
  honeypot.name = "company";
  honeypot.className = "honeypot-field";
  honeypot.autocomplete = "off";
  honeypot.tabIndex = -1;
  honeypot.setAttribute("aria-hidden", "true");

  // Enable/disable send button based on email validity.
  function updateSendButtonState() {
    sendButton.disabled = !isValidEmail(emailInput.value);
  }

  emailInput.addEventListener("input", updateSendButtonState);
  updateSendButtonState();

  sendButton.addEventListener("click", () => {
    if (!isValidEmail(emailInput.value)) {
      sendStatus.textContent = "Please enter a valid email address.";
      return;
    }
    sendButton.disabled = true;
    sendStatus.textContent = "Sending...";
    sendResults({
      results,
      honeypotValue: honeypot.value,
      statusEl: sendStatus,
      userEmail: emailInput.value.trim(),
      onDone: () => {
        sendButton.disabled = false;
        updateSendButtonState();
      },
    });
  });

  summary.append(
    title,
    sendIntro,
    platformBlock,
    categories,
    detailHeading,
    detailList,
    honeypot,
    nav
  );
  app.appendChild(summary);
}

// Normalize stored answer into array form for UI selection.
function normalizeSelection(value, type) {
  if (type === "multi") {
    return Array.isArray(value) ? value : value ? [value] : [];
  }
  if (Array.isArray(value)) {
    return value.length ? [value[0]] : [];
  }
  return value ? [value] : [];
}

// Apply selection rules for single/multi choice questions.
function toggleSelection({ current, optionId, type, maxSelect = 1 }) {
  if (type === "single") {
    return optionId;
  }

  if (current.includes(optionId)) {
    return current.filter((id) => id !== optionId);
  }

  if (current.length >= maxSelect) {
    return current;
  }

  return [...current, optionId];
}

// Build a platform recommendation sentence from selected tags.
function buildPlatformRecommendation(tags) {
  const scores = scorePlatforms(tags);
  const ranked = Object.entries(scores)
    .sort((a, b) => b[1] - a[1])
    .filter((entry) => entry[1] > 0);

  const topPlatforms = ranked.slice(0, 2).map(([name]) => titleCasePlatform(name));
  const topTraits = topTagTraits(tags).slice(0, 2);

  if (!topPlatforms.length) {
    return {
      sentenceHtml:
        "Your responses don't indicate specific platform traits yet, so we can prioritize the channels you already use most.",
      sentenceText:
        "Your responses don't indicate specific platform traits yet, so we can prioritize the channels you already use most.",
    };
  }

  if (!topTraits.length) {
    return {
      sentenceHtml: `Your responses align best with ${formatPlatformList(topPlatforms)}.`,
      sentenceText: `Your responses align best with ${formatList(topPlatforms)}.`
    };
  }

  return {
    sentenceHtml: `Your responses favor platforms that support ${formatList(
      topTraits
    )}, which aligns best with ${formatPlatformList(topPlatforms)}.`,
    sentenceText: `Your responses favor platforms that support ${formatList(
      topTraits
    )}, which aligns best with ${formatList(topPlatforms)}.`
  };
}

// Count tag matches per platform.
function scorePlatforms(tags) {
  const scores = {};
  const tagSet = new Set(tags || []);

  Object.keys(PLATFORM_TRAIT_MAP).forEach((platform) => {
    scores[platform] = PLATFORM_TRAIT_MAP[platform].filter((tag) => tagSet.has(tag)).length;
  });

  return scores;
}

// Extract top platform-related traits from tags.
function topTagTraits(tags) {
  const traitCounts = {};
  const traitSet = new Set(
    Object.values(PLATFORM_TRAIT_MAP).flat()
  );

  (tags || []).forEach((tag) => {
    if (!traitSet.has(tag)) {
      return;
    }
    traitCounts[tag] = (traitCounts[tag] || 0) + 1;
  });

  return Object.entries(traitCounts)
    .sort((a, b) => b[1] - a[1])
    .map(([tag]) => tag.replace("platform:", "").replace(/_/g, " "));
}

// Format platform id into a display label.
function titleCasePlatform(platform) {
  if (!platform) {
    return "";
  }
  return platform.charAt(0).toUpperCase() + platform.slice(1);
}

// Format a list into a readable sentence fragment.
function formatList(items) {
  if (!items.length) {
    return "";
  }
  if (items.length === 1) {
    return items[0];
  }
  if (items.length === 2) {
    return `${items[0]} and ${items[1]}`;
  }
  return `${items.slice(0, -1).join(", ")}, and ${items[items.length - 1]}`;
}

// Format platform names with bold emphasis.
function formatPlatformList(items) {
  const bolded = items.map((item) => `<strong>${item}</strong>`);
  return formatList(bolded);
}

// Post results to the server and update status text.
function sendResults({ results, honeypotValue, statusEl, userEmail, onDone }) {
  const payloadKey = JSON.stringify({ answers: state.answers, userEmail });
  if (state.lastSentKey === payloadKey) {
    if (state.lastSentSuccess && statusEl) {
      statusEl.textContent =
        "Your social planning assessment has been sent to you and Rocket Science Designs.";
    }
    return;
  }
  state.lastSentKey = payloadKey;
  state.lastSentSuccess = false;

  const platform = buildPlatformRecommendation(results.allTags);
  const payload = {
    startedAt: STARTED_AT,
    minElapsedMs: MIN_ELAPSED_MS,
    honeypot: honeypotValue || "",
    version: SOCIAL_DISCOVERY_FORM.version,
    answers: state.answers,
    results,
    platformSentence: platform.sentenceText,
    userEmail: userEmail || "",
  };

  fetch("social-discovery-send.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(payload),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`Send failed with status ${response.status}`);
      }
      state.lastSentSuccess = true;
      if (statusEl) {
        statusEl.textContent =
          "Your social planning assessment has been sent to you and Rocket Science Designs.";
      }
    })
    .catch((error) => {
      console.warn("Social discovery send failed:", error);
      if (statusEl) {
        statusEl.textContent =
          "We couldn't send the email right now. Please try again.";
      }
    })
    .finally(() => {
      if (onDone) {
        onDone();
      }
    });
}

// Simple email format check for client-side validation.
function isValidEmail(value) {
  const trimmed = (value || "").trim();
  if (!trimmed) {
    return false;
  }
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(trimmed);
}

render();




