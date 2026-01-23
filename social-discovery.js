/**
 * Social Strategy Discovery -- Form + Results Config (single source of truth)
 * - Render questions/options from this config
 * - Store only selected option IDs in localStorage
 * - Build results by looking up option.meaning (and optional tags)
 */

export const SOCIAL_DISCOVERY_FORM = {
  version: "1.1.0",
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
          ]
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
          ]
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
          ]
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
          ]
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
          ]
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
          ]
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
          ]
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
          ]
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
          ]
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
          ]
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
          ]
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
          ]
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
          ]
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
          ]
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
          ]
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
          ]
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
          ]
        },
        {
          id: "personality_mid",
          label: "Somewhat important",
          meaning:
            "We will balance professional authority with selective human moments to keep the brand approachable without oversharing.",
          tags: [
            "tone:balanced"
          ]
        },
        {
          id: "personality_high",
          label: "Very important",
          meaning:
            "We will intentionally plan storytelling and human content as a core part of the strategy rather than treating it as filler.",
          tags: [
            "tone:human",
            "content:storytelling"
          ]
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
          ]
        },
        {
          id: "cta_email",
          label: "Email",
          meaning:
            "We will use social content to support longer-term nurturing rather than expecting immediate conversion.",
          tags: [
            "cta:nurture",
            "platform:trust"
          ]
        },
        {
          id: "cta_calls",
          label: "Phone or video calls",
          meaning:
            "We will use content to answer common questions and objections so calls start warmer and more informed.",
          tags: [
            "cta:high_intent",
            "platform:professional"
          ]
        },
        {
          id: "cta_booking",
          label: "Website forms or bookings",
          meaning:
            "We will prioritize clarity, structure, and conversion-focused messaging.",
          tags: [
            "cta:conversion",
            "platform:credibility"
          ]
        },
        {
          id: "cta_in_person",
          label: "In-person interactions",
          meaning:
            "We will treat social as a reinforcement tool that builds familiarity and trust ahead of offline engagement.",
          tags: [
            "cta:offline",
            "platform:local"
          ]
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
          ]
        },
        {
          id: "success_quality_inquiries",
          label: "I'm getting better quality inquiries",
          meaning:
            "We will intentionally clarify fit and expectations, even if that slightly narrows the audience.",
          tags: [
            "kpi:lead_quality",
            "platform:trust"
          ]
        },
        {
          id: "success_trust_faster",
          label: "People trust me faster",
          meaning:
            "We will double down on clarity, proof, and consistency to shorten the trust curve.",
          tags: [
            "kpi:trust",
            "platform:credibility"
          ]
        },
        {
          id: "success_sales_easier",
          label: "Sales conversations are easier",
          meaning:
            "We will pre-educate and pre-qualify through content so conversations start further along.",
          tags: [
            "kpi:sales_efficiency",
            "platform:professional"
          ]
        },
        {
          id: "success_consistency",
          label: "I feel more consistent and confident online",
          meaning:
            "We will prioritize sustainable systems and a defined content structure over volume.",
          tags: [
            "kpi:sustainability",
            "platform:stable"
          ]
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
          ]
        },
        {
          id: "cadence_mid",
          label: "3-4 times per week",
          meaning:
            "We will rotate a defined set of content types and review performance regularly.",
          tags: [
            "cadence:balanced"
          ]
        },
        {
          id: "cadence_high",
          label: "5+ times per week",
          meaning:
            "We will support higher output with structured formats and ongoing optimization.",
          tags: [
            "cadence:high"
          ]
        }
      ]
    }
  ]
};

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

  const platform = buildPlatformRecommendation(results.allTags);
  const platformBlock = document.createElement("div");
  platformBlock.className = "summary-platforms";

  const platformTitle = document.createElement("h3");
  platformTitle.textContent = "Platform Recommendations";

  const platformCopy = document.createElement("p");
  platformCopy.className = "summary-platforms-copy";
  platformCopy.textContent = platform.sentence;

  platformBlock.append(platformTitle, platformCopy);

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

  summary.append(title, list, outline, platformBlock, nav);
  app.appendChild(summary);
}

function normalizeSelection(value, type) {
  if (type === "multi") {
    return Array.isArray(value) ? value : value ? [value] : [];
  }
  if (Array.isArray(value)) {
    return value.length ? [value[0]] : [];
  }
  return value ? [value] : [];
}

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

function buildPlatformRecommendation(tags) {
  const scores = scorePlatforms(tags);
  const ranked = Object.entries(scores)
    .sort((a, b) => b[1] - a[1])
    .filter((entry) => entry[1] > 0);

  const topPlatforms = ranked.slice(0, 2).map(([name]) => titleCasePlatform(name));
  const topTraits = topTagTraits(tags).slice(0, 2);

  if (!topPlatforms.length) {
    return {
      sentence:
        "Your responses don't indicate specific platform traits yet, so we can prioritize the channels you already use most."
    };
  }

  if (!topTraits.length) {
    return {
      sentence: `Your responses align best with ${formatList(topPlatforms)}.`
    };
  }

  return {
    sentence: `Your responses favor platforms that support ${formatList(topTraits)}, which aligns best with ${formatList(
      topPlatforms
    )}.`
  };
}

function scorePlatforms(tags) {
  const scores = {};
  const tagSet = new Set(tags || []);

  Object.keys(PLATFORM_TRAIT_MAP).forEach((platform) => {
    scores[platform] = PLATFORM_TRAIT_MAP[platform].filter((tag) => tagSet.has(tag)).length;
  });

  return scores;
}

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

function titleCasePlatform(platform) {
  if (!platform) {
    return "";
  }
  return platform.charAt(0).toUpperCase() + platform.slice(1);
}

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

render();



