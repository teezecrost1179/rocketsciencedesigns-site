/**
 * Social Strategy Discovery — Form + Results Config (single source of truth)
 * - Render questions/options from this config
 * - Store only selected option IDs in localStorage
 * - Build results by looking up option.meaning (and optional tags)
 */

export const SOCIAL_DISCOVERY_FORM = {
  version: "1.0.0",
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
            "Your social media should prioritize reach, familiarity, and repetition. We should focus on platforms and content styles that help new people quickly understand what you offer and feel comfortable with your brand before making a decision.",
          tags: ["audience:b2c", "goal:reach", "goal:familiarity", "cta:low_friction"],
        },
        {
          id: "ongoing_1to1",
          label: "People who work with us one-on-one or on an ongoing basis",
          meaning:
            "Your social media needs to build trust, clarity, and confidence in you specifically. Content should reduce uncertainty and help people feel like they already understand how it would be to work with you.",
          tags: ["audience:service", "goal:trust", "goal:clarity", "cta:conversation"],
        },
        {
          id: "b2b_orgs",
          label: "Other businesses or organizations",
          meaning:
            "Your audience makes decisions carefully and values credibility and professionalism. Social media should reinforce legitimacy and expertise rather than entertainment or trends.",
          tags: ["audience:b2b", "goal:credibility", "tone:professional", "content:proof"],
        },
        {
          id: "local_regional",
          label: "A local or regional audience",
          meaning:
            "Familiarity matters more than scale. Social media should help you become recognizable and trusted within a specific community, not just broadly visible.",
          tags: ["audience:local", "goal:familiarity", "platform:local_friendly", "cta:local"],
        },
      ],
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
            "Content must consistently signal competence, reliability, and professionalism.",
          tags: ["driver:trust", "content:authority", "tone:confident"],
        },
        {
          id: "proof_experience",
          label: "Proof of results or experience",
          meaning: "People want reassurance that you’ve done this successfully before.",
          tags: ["driver:proof", "content:testimonials", "content:examples"],
        },
        {
          id: "education_clarity",
          label: "Clear explanations or education",
          meaning: "Your audience feels more confident when things are clearly explained.",
          tags: ["driver:education", "content:how_it_works", "content:process"],
        },
        {
          id: "relatable_connection",
          label: "Personal connection or relatability",
          meaning: "People are choosing you, not just the offer.",
          tags: ["driver:connection", "tone:human", "content:storytelling"],
        },
        {
          id: "convenience_ease",
          label: "Convenience or ease",
          meaning: "Reducing friction is a key driver in decisions.",
          tags: ["driver:convenience", "cta:clear_next_step", "content:friction_reduction"],
        },
        {
          id: "price_value",
          label: "Price or value",
          meaning:
            "People are weighing cost carefully and need to understand what makes you worth it.",
          tags: ["driver:value", "content:differentiation", "content:value_framing"],
        },
      ],
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
            "Social media’s role is primarily validation, not discovery. People check you out after hearing about you elsewhere.",
          tags: ["funnel:validation", "content:credibility", "goal:trust"],
        },
        {
          id: "repeat_relationships",
          label: "Repeat customers or existing relationships",
          meaning:
            "Social media supports retention and long-term trust rather than constant acquisition.",
          tags: ["funnel:retention", "goal:trust", "content:community"],
        },
        {
          id: "search_website",
          label: "Online search or website",
          meaning:
            "Social media should support credibility once people find you through other channels.",
          tags: ["funnel:assist", "goal:credibility", "content:reinforcement"],
        },
        {
          id: "social_already",
          label: "Social media",
          meaning:
            "Social already plays an active role and can be optimized for stronger outcomes.",
          tags: ["funnel:acquisition", "goal:optimize", "content:double_down"],
        },
        {
          id: "outreach_networking",
          label: "Outreach or networking",
          meaning:
            "Social media should help warm people up before conversations happen.",
          tags: ["funnel:warm_up", "goal:authority", "tone:professional"],
        },
        {
          id: "inconsistent",
          label: "Not consistently yet",
          meaning:
            "Social media may help establish visibility and momentum where there isn’t a strong acquisition channel yet.",
          tags: ["funnel:foundation", "goal:awareness", "goal:consistency"],
        },
      ],
    },

    {
      id: "q4",
      step: 4,
      title:
        "How important is emotional connection or personality in your brand’s online presence?",
      instructions: "Select one",
      type: "single",
      options: [
        {
          id: "personality_low",
          label: "Not important",
          meaning:
            "A more informational, straightforward approach will feel most appropriate.",
          tags: ["tone:straightforward", "content:informational"],
        },
        {
          id: "personality_mid",
          label: "Somewhat important",
          meaning:
            "A balance of professionalism and human tone will work best.",
          tags: ["tone:balanced", "content:mixed"],
        },
        {
          id: "personality_high",
          label: "Very important",
          meaning:
            "Personality and storytelling should be intentionally built into the strategy.",
          tags: ["tone:human", "content:storytelling", "goal:connection"],
        },
      ],
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
            "Social media should encourage dialogue and low-pressure outreach.",
          tags: ["cta:dms", "funnel:conversation", "content:prompt_response"],
        },
        {
          id: "cta_email",
          label: "Email",
          meaning:
            "Social should support longer-term nurturing and list-building.",
          tags: ["cta:email", "funnel:nurture", "content:lead_magnet"],
        },
        {
          id: "cta_calls",
          label: "Phone or video calls",
          meaning:
            "Social should pre-qualify leads and build trust before live conversations.",
          tags: ["cta:calls", "funnel:prequalify", "content:trust_building"],
        },
        {
          id: "cta_booking",
          label: "Website forms or bookings",
          meaning:
            "Clear CTAs and conversion-focused content are important.",
          tags: ["cta:booking", "funnel:conversion", "content:clear_steps"],
        },
        {
          id: "cta_in_person",
          label: "In-person interactions",
          meaning:
            "Social reinforces awareness and trust ahead of offline engagement.",
          tags: ["cta:offline", "funnel:assist", "content:community"],
        },
      ],
    },

    {
      id: "q6",
      step: 6,
      title: "What would make you say “this is working” six months from now?",
      instructions: "Select up to 2",
      type: "multi",
      maxSelect: 2,
      options: [
        {
          id: "success_recognition",
          label: "More people recognize my brand",
          meaning: "Awareness and reach are key success metrics.",
          tags: ["kpi:awareness", "goal:reach"],
        },
        {
          id: "success_quality_inquiries",
          label: "I’m getting better quality inquiries",
          meaning:
            "Filtering and pre-educating your audience is a priority.",
          tags: ["kpi:lead_quality", "goal:filtering", "content:education"],
        },
        {
          id: "success_trust_faster",
          label: "People trust me faster",
          meaning:
            "Consistency and clarity are critical success drivers.",
          tags: ["kpi:trust", "goal:clarity", "goal:consistency"],
        },
        {
          id: "success_sales_easier",
          label: "Sales conversations are easier",
          meaning:
            "Social should reduce friction before direct selling begins.",
          tags: ["kpi:sales_friction", "goal:pre_sell", "content:objection_handling"],
        },
        {
          id: "success_consistency",
          label: "I feel more consistent and confident online",
          meaning:
            "A sustainable system matters as much as external results.",
          tags: ["kpi:sustainability", "goal:systems", "goal:consistency"],
        },
      ],
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
          label: "1–2 times per week",
          meaning:
            "The strategy should be focused, minimal, and high-impact.",
          tags: ["cadence:low", "plan:lean", "format:batch"],
        },
        {
          id: "cadence_mid",
          label: "3–4 times per week",
          meaning:
            "A balanced strategy with variety and testing is realistic.",
          tags: ["cadence:mid", "plan:balanced", "format:variety"],
        },
        {
          id: "cadence_high",
          label: "5+ times per week",
          meaning:
            "Higher-volume content and experimentation are feasible if structured well.",
          tags: ["cadence:high", "plan:high_output", "format:experiment"],
        },
      ],
    },
  ],
};

/**
 * Helper: build a lookup map for meanings/tags by questionId/optionId.
 * Useful for fast result rendering.
 */
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
      tags: selected.flatMap((o) => o.tags || []),
    };
  });

  const allTags = sections.flatMap((s) => s.tags);
  return { sections, allTags };
}

const APP_ID = "social-discovery-app";
const STORAGE_KEY = SOCIAL_DISCOVERY_FORM.storageKey;
const TOTAL_STEPS = SOCIAL_DISCOVERY_FORM.questions.length;

const app = document.getElementById(APP_ID);
if (!app) {
  throw new Error("Social Discovery app container not found.");
}

const state = {
  index: 0,
  answers: loadAnswers(),
  required: {},
};

function loadAnswers() {
  try {
    const raw = localStorage.getItem(STORAGE_KEY);
    return raw ? JSON.parse(raw) : {};
  } catch {
    return {};
  }
}

function saveAnswers() {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(state.answers));
}

function setIndex(nextIndex) {
  const maxIndex = TOTAL_STEPS;
  state.index = Math.min(Math.max(nextIndex, 0), maxIndex);
  render();
}

function render() {
  app.innerHTML = "";

  if (state.index < TOTAL_STEPS) {
    renderQuestion(SOCIAL_DISCOVERY_FORM.questions[state.index]);
  } else {
    renderSummary();
  }
}

function renderQuestion(question) {
  const lookup = buildLookup();
  const selected = normalizeSelection(state.answers[question.id], question.type);

  const header = document.createElement("div");
  header.className = "question-header";
  header.innerHTML = `
    <p class="question-step">Question ${question.step} of ${TOTAL_STEPS}</p>
    <h2 class="question-title">${question.title}</h2>
    <p class="question-instructions">${question.instructions}</p>
  `;

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

  const requiredNote = document.createElement("p");
  requiredNote.className = "question-required";
  requiredNote.textContent = "Please select at least one option to continue.";
  requiredNote.hidden = selected.length > 0 || !state.required[question.id];

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

function renderSummary() {
  const results = buildResults(state.answers);
  const summary = document.createElement("div");
  summary.className = "summary";

  const title = document.createElement("h2");
  title.className = "summary-title";
  title.textContent = "Your Social Strategy Snapshot";

  const list = document.createElement("div");
  list.className = "summary-list";

  results.sections.forEach((section) => {
    const item = document.createElement("div");
    item.className = "summary-item";

    const question = document.createElement("h3");
    question.textContent = section.questionTitle;

    const response = document.createElement("p");
    response.className = "summary-response";
    response.textContent = section.selectedLabels.length
      ? section.selectedLabels.join(", ")
      : "No response selected.";

    item.append(question, response);

    section.meanings.forEach((meaning) => {
      const meaningEl = document.createElement("p");
      meaningEl.className = "summary-meaning";
      meaningEl.textContent = meaning;
      item.appendChild(meaningEl);
    });

    list.appendChild(item);
  });

  const outline = document.createElement("div");
  outline.className = "summary-outline";

  const outlineTitle = document.createElement("h3");
  outlineTitle.textContent = "Strategy Outline";

  const outlineList = document.createElement("ul");
  outlineList.className = "summary-outline-list";
  const uniqueMeanings = Array.from(
    new Set(results.sections.flatMap((section) => section.meanings))
  );

  uniqueMeanings.forEach((meaning) => {
    const li = document.createElement("li");
    li.textContent = meaning;
    outlineList.appendChild(li);
  });

  outline.append(outlineTitle, outlineList);

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
    saveAnswers();
    setIndex(0);
  });

  nav.append(backBtn, resetBtn);

  summary.append(title, list, outline, nav);
  app.appendChild(summary);
}

function normalizeSelection(value, type) {
  if (type === "multi") {
    return Array.isArray(value) ? value : value ? [value] : [];
  }
  return value ? [value] : [];
}

function toggleSelection({ current, optionId, type, maxSelect = 1 }) {
  if (type === "single") {
    return [optionId];
  }

  if (current.includes(optionId)) {
    return current.filter((id) => id !== optionId);
  }

  if (current.length >= maxSelect) {
    return current;
  }

  return [...current, optionId];
}

render();

