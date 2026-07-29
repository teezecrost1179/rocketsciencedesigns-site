<?php
require __DIR__ . '/config.php';
if (!pp_check_auth()) { pp_deny(false); }
header('X-Robots-Tag: noindex, nofollow');
$token = MAGIC_TOKEN;
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title><?= htmlspecialchars(PAGE_TITLE, ENT_QUOTES) ?></title>
<style>
  :root{
    --ink:#1f2337; --ink-soft:#5b6178; --line:#e3e6ef; --bg:#f4f6fb; --card:#fff;
    --blue:#579bfc; --grey:#c3c8d4; --yellow:#fdab3d; --orange:#ff7a45; --green:#00c875;
    --shadow:0 1px 2px rgba(31,35,55,.06), 0 6px 18px rgba(31,35,55,.07);
    --radius:14px;
  }
  *{box-sizing:border-box}
  html,body{margin:0;padding:0}
  body{
    font:15px/1.55 -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
    color:var(--ink); background:var(--bg); -webkit-text-size-adjust:100%;
  }
  .wrap{max-width:1060px;margin:0 auto;padding:20px 16px 96px}

  /* ---------- top bar ---------- */
  .topbar{display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:16px}
  .brand{display:flex;align-items:center;gap:9px;font-weight:800;letter-spacing:-.2px}
  .brand .paw{font-size:20px}
  .spacer{flex:1}
  .btn{
    border:1px solid var(--line); background:#fff; color:var(--ink); font:inherit; font-weight:600;
    padding:7px 13px; border-radius:9px; cursor:pointer; white-space:nowrap;
  }
  .btn:hover{background:#f7f9fd; border-color:#cfd5e4}
  .btn.primary{background:var(--blue);border-color:var(--blue);color:#fff}
  .btn.primary:hover{background:#3f8bf7}
  .savepill{
    font-size:12.5px;font-weight:700;padding:5px 11px;border-radius:99px;
    background:#eef1f7;color:var(--ink-soft);white-space:nowrap
  }
  .savepill[data-state="saving"]{background:#fff4e0;color:#a5620a}
  .savepill[data-state="saved"]{background:#e3f9ee;color:#0b7a4b}
  .savepill[data-state="error"]{background:#ffe8ea;color:#b3202f}

  /* ---------- event title card (accordion) ---------- */
  .hero{
    background:linear-gradient(135deg,#1f2337 0%,#2f3a5c 52%,#3d5a86 100%);
    color:#fff;border-radius:18px;box-shadow:var(--shadow);overflow:hidden;margin-bottom:18px
  }
  .hero-head{
    display:flex;align-items:flex-start;gap:14px;padding:20px 22px;cursor:pointer;user-select:none
  }
  .hero-head:hover{background:rgba(255,255,255,.04)}
  .hero-title{font-size:23px;font-weight:800;letter-spacing:-.4px;margin:0 0 4px}
  .hero-tag{margin:0;font-style:italic;color:#bcd0ee;font-size:14px}
  .hero-sub{margin:9px 0 0;font-size:12.5px;text-transform:uppercase;letter-spacing:.9px;color:#8fa8cf;font-weight:700}
  .chev{
    flex:0 0 auto;width:30px;height:30px;border-radius:9px;background:rgba(255,255,255,.14);
    display:grid;place-items:center;transition:transform .22s ease;font-size:13px;margin-top:3px
  }
  .hero[data-open="1"] .chev{transform:rotate(180deg)}
  .hero-body{display:none;padding:0 22px 22px;border-top:1px solid rgba(255,255,255,.12)}
  .hero[data-open="1"] .hero-body{display:block}
  .facts{display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:10px;margin:18px 0 4px}
  .fact{background:rgba(255,255,255,.07);border-radius:11px;padding:11px 13px}
  .fact b{display:block;font-size:11px;text-transform:uppercase;letter-spacing:.7px;color:#9fb6d8;margin-bottom:3px}
  .fact span{font-size:13.5px;color:#eaf1fb}
  .esec{margin-top:20px}
  .esec h4{
    margin:0 0 8px;font-size:12px;text-transform:uppercase;letter-spacing:1px;color:#9fb6d8;
    display:flex;align-items:center;gap:8px
  }
  .esec h4::after{content:"";flex:1;height:1px;background:rgba(255,255,255,.13)}
  .esec ul{margin:0;padding-left:18px;color:#e2eaf7;font-size:13.8px}
  .esec li{margin-bottom:5px}

  /* ---------- legend + toolbar ---------- */
  .toolbar{display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:14px}
  .legend{display:flex;gap:6px;flex-wrap:wrap}
  .lg{
    display:inline-flex;align-items:center;gap:6px;background:#fff;border:1px solid var(--line);
    border-radius:99px;padding:4px 11px 4px 8px;font-size:12.5px;font-weight:700;color:var(--ink-soft);
    cursor:pointer
  }
  .lg[aria-pressed="true"]{border-color:var(--ink);color:var(--ink);box-shadow:0 0 0 1px var(--ink)}
  .dot{width:11px;height:11px;border-radius:50%;flex:0 0 auto}
  .dot.grey{background:var(--grey)} .dot.yellow{background:var(--yellow)}
  .dot.orange{background:var(--orange)} .dot.green{background:var(--green)}
  .progress{
    display:flex;height:9px;border-radius:99px;overflow:hidden;background:#e7eaf2;
    margin-bottom:16px;box-shadow:inset 0 0 0 1px rgba(31,35,55,.04)
  }
  .progress i{display:block;height:100%}

  /* ---------- task cards ---------- */
  .cards{display:flex;flex-direction:column;gap:10px}
  .card{
    background:var(--card);border-radius:var(--radius);box-shadow:var(--shadow);
    border-left:6px solid var(--grey);overflow:hidden;transition:box-shadow .15s,opacity .15s
  }
  .card.state-grey  {border-left-color:var(--grey);   background:linear-gradient(90deg,#f7f8fb,#fff 26%)}
  .card.state-yellow{border-left-color:var(--yellow); background:linear-gradient(90deg,#fff6e6,#fff 26%)}
  .card.state-orange{border-left-color:var(--orange); background:linear-gradient(90deg,#fff0e9,#fff 26%)}
  .card.state-green {border-left-color:var(--green);  background:linear-gradient(90deg,#e8faf1,#fff 26%)}
  .card.dragging{opacity:.4}
  .card.dropzone{box-shadow:0 0 0 2px var(--blue), var(--shadow)}

  .row{display:flex;align-items:center;gap:10px;padding:12px 14px}
  .handle{
    flex:0 0 auto;width:24px;height:28px;display:grid;place-items:center;cursor:grab;
    color:#aeb5c7;border-radius:6px;touch-action:none
  }
  .handle:hover{background:#f0f2f8;color:var(--ink-soft)}
  .handle svg{pointer-events:none}
  .nudge{display:flex;flex-direction:column;gap:2px;flex:0 0 auto}
  .nudge button{
    width:22px;height:15px;line-height:1;border:1px solid var(--line);background:#fff;border-radius:5px;
    color:#8b93a8;cursor:pointer;font-size:9px;padding:0
  }
  .nudge button:hover{background:#f2f5fb;color:var(--ink)}
  .tcheck{
    flex:0 0 auto;width:22px;height:22px;border-radius:50%;border:2px solid #ccd2e0;background:#fff;
    cursor:pointer;display:grid;place-items:center;color:#fff;font-size:12px;font-weight:900;padding:0
  }
  .card.state-green .tcheck{background:var(--green);border-color:var(--green)}
  .title{
    flex:1;min-width:120px;font-weight:700;font-size:15.5px;border:0;background:transparent;
    font-family:inherit;color:var(--ink);padding:3px 5px;border-radius:6px;letter-spacing:-.1px
  }
  .title:focus{outline:2px solid var(--blue);background:#fff}
  .card.state-green .title{color:#4a5266}
  .gchip{
    flex:0 0 auto;font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.6px;
    padding:4px 9px;border-radius:99px;color:#fff;white-space:nowrap
  }
  .pills{display:flex;gap:6px;flex-wrap:wrap;align-items:center}
  .pill{
    position:relative;display:inline-flex;align-items:center;border-radius:8px;overflow:hidden;
    font-size:11.5px;font-weight:800;letter-spacing:.3px
  }
  .pill label{padding:5px 7px;background:#eef0f6;color:#6a7189;text-transform:uppercase}
  .pill select{
    -webkit-appearance:none;appearance:none;border:0;font:inherit;font-weight:800;color:#fff;
    padding:5px 20px 5px 9px;cursor:pointer;background-image:none
  }
  .pill::after{content:"▾";position:absolute;right:6px;color:rgba(255,255,255,.85);font-size:10px;pointer-events:none}
  .pill select:focus{outline:2px solid var(--ink);outline-offset:-2px}
  .pill.st-na     select{background:#b6bcca}
  .pill.st-na::after{color:rgba(255,255,255,.9)}
  .pill.st-todo   select{background:#8f97ab}
  .pill.st-wip    select{background:var(--yellow)}
  .pill.st-done   select{background:var(--green)}
  .expand{
    flex:0 0 auto;border:1px solid var(--line);background:#fff;border-radius:8px;width:28px;height:28px;
    cursor:pointer;color:#8b93a8;font-size:11px;display:grid;place-items:center
  }
  .expand:hover{background:#f2f5fb;color:var(--ink)}
  .card[data-open="1"] .expand{transform:rotate(180deg)}
  .meta{display:flex;gap:8px;align-items:center;flex-wrap:wrap;padding:0 14px 12px 62px;margin-top:-6px}
  .tiny{font-size:11.5px;color:#8b93a8;font-weight:700}

  .body{display:none;padding:2px 14px 16px 62px;border-top:1px dashed var(--line);margin:0 14px 0 62px}
  .card[data-open="1"] .body{display:block}
  .panels{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:14px}
  @media (max-width:760px){
    .panels{grid-template-columns:1fr}
    .body,.meta{padding-left:14px;margin-left:0}
    .row{flex-wrap:wrap}
    .title{order:-1;flex-basis:100%}
  }
  .panel{background:#fbfcfe;border:1px solid var(--line);border-radius:11px;padding:11px 12px}
  .panel h5{
    margin:0 0 8px;font-size:11px;text-transform:uppercase;letter-spacing:.9px;color:#7d859a;
    display:flex;align-items:center;gap:7px
  }
  .panel h5 .ic{font-size:13px}
  .items{list-style:none;margin:0;padding:0}
  .items li{display:flex;align-items:flex-start;gap:8px;padding:4px 0}
  .items input[type=checkbox]{margin:3px 0 0;width:16px;height:16px;accent-color:var(--green);flex:0 0 auto}
  .items .txt{
    flex:1;border:0;background:transparent;font:inherit;font-size:13.5px;color:var(--ink);
    padding:2px 4px;border-radius:5px;resize:none;overflow:hidden;line-height:1.4;font-family:inherit
  }
  .items .txt:focus{outline:1px solid var(--blue);background:#fff}
  .items li.done .txt{text-decoration:line-through;color:#9aa1b3}
  .del{
    border:0;background:transparent;color:#c8cdda;cursor:pointer;font-size:14px;line-height:1;padding:2px 4px;
    border-radius:5px;flex:0 0 auto
  }
  .del:hover{color:#e2445c;background:#fdeaec}
  .additem{
    margin-top:6px;border:1px dashed #cfd5e4;background:#fff;color:#6a7189;border-radius:8px;
    padding:5px 10px;font:inherit;font-size:12.5px;font-weight:700;cursor:pointer;width:100%
  }
  .additem:hover{border-color:var(--blue);color:var(--blue)}
  .empty{font-size:12.5px;color:#a2a9ba;font-style:italic;padding:2px 0}
  .notes{margin-top:14px}
  .notes h5{
    margin:0 0 7px;font-size:11px;text-transform:uppercase;letter-spacing:.9px;color:#7d859a;
    display:flex;align-items:center;gap:7px
  }
  .notes textarea{
    width:100%;min-height:78px;border:1px solid var(--line);border-radius:11px;padding:10px 12px;
    font:inherit;font-size:13.8px;line-height:1.55;color:var(--ink);background:#fffdf5;resize:vertical
  }
  .notes textarea:focus{outline:2px solid var(--blue);background:#fff}
  .cardfoot{display:flex;justify-content:flex-end;margin-top:12px}
  .rm{
    border:1px solid #f3d4d8;background:#fff;color:#c0303f;border-radius:8px;padding:5px 11px;
    font:inherit;font-size:12px;font-weight:700;cursor:pointer
  }
  .rm:hover{background:#fdeaec}

  .addcard{
    margin-top:14px;width:100%;border:2px dashed #cfd5e4;background:#fff;border-radius:var(--radius);
    padding:14px;font:inherit;font-weight:800;color:#6a7189;cursor:pointer
  }
  .addcard:hover{border-color:var(--blue);color:var(--blue)}
  .foot{margin-top:26px;font-size:12px;color:#98a0b3;text-align:center;line-height:1.7}
  .toast{
    position:fixed;left:50%;bottom:22px;transform:translateX(-50%) translateY(140%);
    background:var(--ink);color:#fff;padding:10px 18px;border-radius:99px;font-size:13.5px;font-weight:700;
    box-shadow:0 8px 26px rgba(0,0,0,.25);transition:transform .25s ease;z-index:50
  }
  .toast.show{transform:translateX(-50%) translateY(0)}
</style>
</head>
<body>
<div class="wrap">

  <div class="topbar">
    <div class="brand"><span class="paw">🐾</span><span>Paw Prints&nbsp;·&nbsp;Calm K9 Corner</span></div>
    <div class="spacer"></div>
    <span class="savepill" id="savepill" data-state="idle">Loading…</span>
    <button class="btn" id="copylink" type="button">Copy share link</button>
    <button class="btn" id="toggleall" type="button">Expand all</button>
  </div>

  <section class="hero" id="hero" data-open="0">
    <div class="hero-head" id="heroHead" role="button" tabindex="0" aria-expanded="false">
      <div style="flex:1">
        <h1 class="hero-title" id="evTitle">Paw Prints Calm K9 Corner</h1>
        <p class="hero-tag" id="evTag"></p>
        <p class="hero-sub" id="evSub"></p>
      </div>
      <div class="chev">▾</div>
    </div>
    <div class="hero-body">
      <div class="facts" id="evFacts"></div>
      <div id="evSections"></div>
    </div>
  </section>

  <div class="progress" id="progress"></div>

  <div class="toolbar">
    <div class="legend" id="legend"></div>
    <div class="spacer"></div>
    <div class="legend" id="groupFilter"></div>
  </div>

  <div class="cards" id="cards"></div>
  <button class="addcard" id="addcard" type="button">＋ Add a task</button>

  <p class="foot">
    Private checklist · edits save automatically · anyone with the link can edit<br>
    Built for Paw Prints Mobile Veterinary Ultrasound by Rocket Science Designs
  </p>
</div>

<div class="toast" id="toast"></div>

<script>
(function(){
  "use strict";
  const TOKEN = <?= json_encode($token) ?>;
  const API = 'api.php';

  const STATUS = [
    ['na',  'N/A'],
    ['todo','Not started'],
    ['wip', 'In progress'],
    ['done','Done']
  ];
  const STATE_LABEL = {
    grey:  'Not touched yet',
    yellow:'Underway',
    orange:'Partly done',
    green: 'Ready to go'
  };

  let DATA = null;
  let openCards = new Set();
  let filterState = null;   // grey|yellow|orange|green
  let filterGroup = null;   // group id
  let saveTimer = null;
  let dragId = null;

  /* ---------- tiny DOM helper ---------- */
  function h(tag, attrs, kids){
    const el = document.createElement(tag);
    if (attrs) for (const k in attrs){
      const v = attrs[k];
      if (v === null || v === false || v === undefined) continue;
      if (k === 'class') el.className = v;
      else if (k === 'text') el.textContent = v;
      else if (k === 'html') el.innerHTML = v;
      else if (k.slice(0,2) === 'on') el.addEventListener(k.slice(2), v);
      else el.setAttribute(k, v);
    }
    if (kids) [].concat(kids).forEach(function(c){
      if (c === null || c === undefined || c === false) return;
      el.appendChild(typeof c === 'string' ? document.createTextNode(c) : c);
    });
    return el;
  }
  const $ = function(id){ return document.getElementById(id); };

  /* ---------- status maths ---------- */
  function tracks(t){
    return ['taskStatus','orderStatus','artStatus']
      .map(function(k){ return t[k] || 'na'; })
      .filter(function(v){ return v !== 'na'; });
  }
  function cardState(t){
    const tr = tracks(t);
    if (!tr.length) return 'grey';
    if (tr.every(function(v){ return v === 'done'; })) return 'green';
    if (tr.some(function(v){ return v === 'wip'; }))  return 'yellow';
    if (tr.some(function(v){ return v === 'done'; })) return 'orange';
    return 'grey';
  }
  function groupOf(id){
    return (DATA.groups || []).find(function(g){ return g.id === id; })
        || { id:'', name:'General', color:'#8f97ab' };
  }
  function itemProgress(list){
    if (!list || !list.length) return '';
    const d = list.filter(function(i){ return i.done; }).length;
    return d + '/' + list.length;
  }

  /* ---------- save ---------- */
  function setPill(state, txt){
    const p = $('savepill');
    p.dataset.state = state;
    p.textContent = txt;
  }
  function queueSave(){
    setPill('saving','Saving…');
    clearTimeout(saveTimer);
    saveTimer = setTimeout(save, 700);
  }
  function save(){
    fetch(API, {
      method:'POST',
      headers:{ 'Content-Type':'application/json', 'X-PP-Token': TOKEN },
      body: JSON.stringify(DATA)
    })
    .then(function(r){ return r.json(); })
    .then(function(j){
      if (j && j.ok) {
        const d = new Date();
        setPill('saved','Saved ' + d.toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'}));
      } else {
        setPill('error','Not saved');
        toast((j && j.error) ? j.error : 'Save failed');
      }
    })
    .catch(function(){
      setPill('error','Offline — not saved');
      toast('Could not reach the server. Your changes are still on screen.');
    });
  }
  let toastTimer = null;
  function toast(msg){
    const t = $('toast');
    t.textContent = msg;
    t.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(function(){ t.classList.remove('show'); }, 3600);
  }

  /* ---------- event hero ---------- */
  function renderEvent(){
    const ev = DATA.event || {};
    $('evTitle').textContent = ev.title || 'Checklist';
    $('evTag').textContent   = ev.tagline || '';
    $('evSub').textContent   = ev.subtitle || '';

    const f = $('evFacts');
    f.textContent = '';
    (ev.facts || []).forEach(function(x){
      f.appendChild(h('div',{class:'fact'},[
        h('b',{text:x.label}), h('span',{text:x.value})
      ]));
    });

    const s = $('evSections');
    s.textContent = '';
    (ev.sections || []).forEach(function(sec){
      s.appendChild(h('div',{class:'esec'},[
        h('h4',{text:sec.heading}),
        h('ul',{}, (sec.items||[]).map(function(i){ return h('li',{text:i}); }))
      ]));
    });
  }

  /* ---------- legend / filters / progress ---------- */
  function renderLegend(){
    const counts = {grey:0,yellow:0,orange:0,green:0};
    DATA.tasks.forEach(function(t){ counts[cardState(t)]++; });

    const l = $('legend');
    l.textContent = '';
    ['grey','yellow','orange','green'].forEach(function(k){
      l.appendChild(h('button',{
        class:'lg', type:'button', 'aria-pressed': filterState === k ? 'true' : 'false',
        onclick:function(){ filterState = (filterState === k ? null : k); renderAll(); }
      },[
        h('span',{class:'dot ' + k}),
        h('span',{text: STATE_LABEL[k] + ' · ' + counts[k]})
      ]));
    });

    const gf = $('groupFilter');
    gf.textContent = '';
    (DATA.groups||[]).forEach(function(g){
      gf.appendChild(h('button',{
        class:'lg', type:'button', 'aria-pressed': filterGroup === g.id ? 'true' : 'false',
        onclick:function(){ filterGroup = (filterGroup === g.id ? null : g.id); renderAll(); }
      },[
        h('span',{class:'dot', style:'background:' + g.color}),
        h('span',{text:g.name})
      ]));
    });

    const total = DATA.tasks.length || 1;
    const bar = $('progress');
    bar.textContent = '';
    [['green','var(--green)'],['orange','var(--orange)'],['yellow','var(--yellow)'],['grey','var(--grey)']]
      .forEach(function(pair){
        if (!counts[pair[0]]) return;
        bar.appendChild(h('i',{
          style:'width:' + (counts[pair[0]]/total*100) + '%;background:' + pair[1],
          title: STATE_LABEL[pair[0]] + ': ' + counts[pair[0]]
        }));
      });
  }

  /* ---------- items (order / art) ---------- */
  function autogrow(el){
    el.style.height = 'auto';
    el.style.height = (el.scrollHeight) + 'px';
  }
  function renderItems(task, key, icon, label){
    const list = task[key] || (task[key] = []);
    const ul = h('ul',{class:'items'});
    if (!list.length) ul.appendChild(h('li',{},[h('span',{class:'empty',text:'Nothing listed yet.'})]));

    list.forEach(function(item, idx){
      const ta = h('textarea',{
        class:'txt', rows:'1', value:item.t,
        oninput:function(){ item.t = ta.value; autogrow(ta); queueSave(); }
      });
      ta.value = item.t;
      const li = h('li',{class:item.done ? 'done' : ''},[
        h('input',{type:'checkbox', checked:item.done ? 'checked' : null, onchange:function(e){
          item.done = e.target.checked;
          li.classList.toggle('done', item.done);
          queueSave();
        }}),
        ta,
        h('button',{class:'del', type:'button', title:'Remove', onclick:function(){
          list.splice(idx,1); queueSave(); renderAll();
        }, text:'✕'})
      ]);
      ul.appendChild(li);
      requestAnimationFrame(function(){ autogrow(ta); });
    });

    return h('div',{class:'panel'},[
      h('h5',{},[h('span',{class:'ic',text:icon}), label, h('span',{class:'tiny', style:'margin-left:auto', text:itemProgress(list)})]),
      ul,
      h('button',{class:'additem', type:'button', text:'＋ Add ' + (key === 'order' ? 'something to order' : 'artwork'),
        onclick:function(){ list.push({t:'', done:false}); queueSave(); renderAll(); focusLast(task.id, key); }})
    ]);
  }
  function focusLast(taskId, key){
    requestAnimationFrame(function(){
      const card = document.querySelector('[data-card="' + taskId + '"]');
      if (!card) return;
      const boxes = card.querySelectorAll('[data-panel="' + key + '"] .txt');
      if (boxes.length) boxes[boxes.length - 1].focus();
    });
  }

  /* ---------- status pill ---------- */
  function pill(task, key, label){
    const cur = task[key] || 'na';
    const sel = h('select',{ onchange:function(){
      task[key] = sel.value;
      queueSave();
      renderAll();
    }}, STATUS.map(function(s){
      return h('option',{value:s[0], selected: s[0] === cur ? 'selected' : null, text:s[1]});
    }));
    sel.value = cur;
    return h('span',{class:'pill st-' + cur, title: label + ': ' + (STATUS.find(function(s){return s[0]===cur;})[1])},[
      h('label',{text:label}), sel
    ]);
  }

  /* ---------- card ---------- */
  function renderCard(task, index){
    const st = cardState(task);
    const g = groupOf(task.group);
    const card = h('div',{class:'card state-' + st, 'data-card':task.id, 'data-open': openCards.has(task.id) ? '1' : '0'});

    /* drag */
    const handle = h('div',{class:'handle', title:'Drag to reorder', html:
      '<svg width="12" height="18" viewBox="0 0 12 18" fill="currentColor" aria-hidden="true">'
      + '<circle cx="3" cy="3" r="1.6"/><circle cx="9" cy="3" r="1.6"/>'
      + '<circle cx="3" cy="9" r="1.6"/><circle cx="9" cy="9" r="1.6"/>'
      + '<circle cx="3" cy="15" r="1.6"/><circle cx="9" cy="15" r="1.6"/></svg>'});
    handle.addEventListener('mousedown', function(){ card.draggable = true; });
    handle.addEventListener('touchstart', function(){ card.draggable = true; }, {passive:true});
    card.addEventListener('dragstart', function(e){
      dragId = task.id;
      card.classList.add('dragging');
      try { e.dataTransfer.setData('text/plain', task.id); } catch(err){}
      e.dataTransfer.effectAllowed = 'move';
    });
    card.addEventListener('dragend', function(){
      card.classList.remove('dragging');
      card.draggable = false;
      dragId = null;
      document.querySelectorAll('.dropzone').forEach(function(n){ n.classList.remove('dropzone'); });
    });
    card.addEventListener('dragover', function(e){
      if (!dragId || dragId === task.id) return;
      e.preventDefault();
      card.classList.add('dropzone');
    });
    card.addEventListener('dragleave', function(){ card.classList.remove('dropzone'); });
    card.addEventListener('drop', function(e){
      e.preventDefault();
      card.classList.remove('dropzone');
      if (!dragId || dragId === task.id) return;
      moveTask(dragId, task.id);
    });

    const nudge = h('div',{class:'nudge'},[
      h('button',{type:'button', title:'Move up',   text:'▲', onclick:function(){ shift(task.id,-1); }}),
      h('button',{type:'button', title:'Move down', text:'▼', onclick:function(){ shift(task.id, 1); }})
    ]);

    const tcheck = h('button',{class:'tcheck', type:'button', text: st === 'green' ? '✓' : '',
      title: st === 'green' ? 'Reopen this task' : 'Mark everything on this card done',
      onclick:function(){
        const to = (st === 'green') ? 'todo' : 'done';
        ['taskStatus','orderStatus','artStatus'].forEach(function(k){
          if ((task[k] || 'na') !== 'na') task[k] = to;
        });
        queueSave(); renderAll();
      }});

    const title = h('input',{class:'title', type:'text', value:task.title,
      oninput:function(e){ task.title = e.target.value; queueSave(); }});

    const gsel = h('span',{class:'gchip', style:'background:' + g.color, text:g.name,
      title:'Click to change section', role:'button', tabindex:'0'});
    gsel.addEventListener('click', function(){
      const gs = DATA.groups || [];
      const i = gs.findIndex(function(x){ return x.id === task.group; });
      task.group = gs[(i + 1) % gs.length].id;
      queueSave(); renderAll();
    });

    const expand = h('button',{class:'expand', type:'button', text:'▾', title:'Show details',
      onclick:function(){
        if (openCards.has(task.id)) openCards.delete(task.id); else openCards.add(task.id);
        card.dataset.open = openCards.has(task.id) ? '1' : '0';
        card.querySelectorAll('.txt, .notes textarea').forEach(autogrow);
      }});

    card.appendChild(h('div',{class:'row'},[
      handle, nudge, tcheck, title, gsel,
      h('span',{class:'pills'},[
        pill(task,'taskStatus','Task'),
        pill(task,'orderStatus','Order'),
        pill(task,'artStatus','Art')
      ]),
      expand
    ]));

    /* collapsed summary line */
    const bits = [];
    const op = itemProgress(task.order), ap = itemProgress(task.art);
    if (op) bits.push('📦 ' + op + ' ordered');
    if (ap) bits.push('🎨 ' + ap + ' art');
    if (task.notes && task.notes.trim()) bits.push('📝 note');
    if (bits.length) card.appendChild(h('div',{class:'meta'},[h('span',{class:'tiny', text:bits.join('  ·  ')})]));

    /* expanded body */
    const orderPanel = renderItems(task,'order','📦','To order / source');
    orderPanel.setAttribute('data-panel','order');
    const artPanel = renderItems(task,'art','🎨','Art / design to do');
    artPanel.setAttribute('data-panel','art');

    const notes = h('textarea',{placeholder:'Notes, decisions, prices, links… saved automatically.'});
    notes.value = task.notes || '';
    notes.addEventListener('input', function(){ task.notes = notes.value; queueSave(); });

    card.appendChild(h('div',{class:'body'},[
      h('div',{class:'panels'},[orderPanel, artPanel]),
      h('div',{class:'notes'},[
        h('h5',{},[h('span',{class:'ic',text:'📝'}),'Notes']),
        notes
      ]),
      h('div',{class:'cardfoot'},[
        h('button',{class:'rm', type:'button', text:'Delete this task', onclick:function(){
          if (!confirm('Delete “' + task.title + '”?')) return;
          DATA.tasks = DATA.tasks.filter(function(x){ return x.id !== task.id; });
          openCards.delete(task.id);
          queueSave(); renderAll();
        }})
      ])
    ]));

    return card;
  }

  /* ---------- reordering ---------- */
  function moveTask(fromId, toId){
    const from = DATA.tasks.findIndex(function(t){ return t.id === fromId; });
    const to   = DATA.tasks.findIndex(function(t){ return t.id === toId; });
    if (from < 0 || to < 0) return;
    const moved = DATA.tasks.splice(from,1)[0];
    DATA.tasks.splice(to,0,moved);
    queueSave(); renderAll();
  }
  function shift(id, dir){
    const i = DATA.tasks.findIndex(function(t){ return t.id === id; });
    const j = i + dir;
    if (i < 0 || j < 0 || j >= DATA.tasks.length) return;
    const tmp = DATA.tasks[i];
    DATA.tasks[i] = DATA.tasks[j];
    DATA.tasks[j] = tmp;
    queueSave(); renderAll();
  }

  /* ---------- render everything ---------- */
  function renderAll(){
    renderLegend();
    const box = $('cards');
    box.textContent = '';
    let shown = 0;
    DATA.tasks.forEach(function(t, i){
      if (filterState && cardState(t) !== filterState) return;
      if (filterGroup && t.group !== filterGroup) return;
      shown++;
      box.appendChild(renderCard(t, i));
    });
    if (!shown){
      box.appendChild(h('div',{class:'card', style:'padding:22px;text-align:center;color:#8b93a8'},
        [h('span',{text:'Nothing matches those filters.'})]));
    }
    document.querySelectorAll('.card[data-open="1"]').forEach(function(c){
      c.querySelectorAll('.txt, .notes textarea').forEach(autogrow);
    });
  }

  /* ---------- boot ---------- */
  function newId(){
    let n = 1;
    const used = new Set(DATA.tasks.map(function(t){ return t.id; }));
    while (used.has('t' + String(n).padStart(2,'0'))) n++;
    return 't' + String(n).padStart(2,'0');
  }

  $('addcard').addEventListener('click', function(){
    const id = newId();
    DATA.tasks.push({
      id:id, title:'New task', group:(DATA.groups[0]||{}).id || '',
      taskStatus:'todo', orderStatus:'na', artStatus:'na',
      order:[], art:[], notes:''
    });
    openCards.add(id);
    queueSave(); renderAll();
    requestAnimationFrame(function(){
      const c = document.querySelector('[data-card="' + id + '"] .title');
      if (c){
        c.focus(); c.select();
        if (typeof c.scrollIntoView === 'function') c.scrollIntoView({block:'center', behavior:'smooth'});
      }
    });
  });

  $('heroHead').addEventListener('click', function(){
    const hero = $('hero');
    const open = hero.dataset.open === '1' ? '0' : '1';
    hero.dataset.open = open;
    $('heroHead').setAttribute('aria-expanded', open === '1' ? 'true' : 'false');
  });
  $('heroHead').addEventListener('keydown', function(e){
    if (e.key === 'Enter' || e.key === ' '){ e.preventDefault(); $('heroHead').click(); }
  });

  $('toggleall').addEventListener('click', function(){
    const anyOpen = DATA.tasks.some(function(t){ return openCards.has(t.id); });
    if (anyOpen){ openCards.clear(); this.textContent = 'Expand all'; }
    else { DATA.tasks.forEach(function(t){ openCards.add(t.id); }); this.textContent = 'Collapse all'; }
    renderAll();
  });

  $('copylink').addEventListener('click', function(){
    const url = location.origin + location.pathname + '?k=' + encodeURIComponent(TOKEN);
    const done = function(){ toast('Share link copied — anyone with it can edit.'); };
    if (navigator.clipboard && navigator.clipboard.writeText){
      navigator.clipboard.writeText(url).then(done, function(){ prompt('Copy this link:', url); });
    } else {
      prompt('Copy this link:', url);
    }
  });

  window.addEventListener('beforeunload', function(e){
    if ($('savepill').dataset.state === 'saving'){
      e.preventDefault(); e.returnValue = '';
    }
  });

  fetch(API, { headers:{ 'X-PP-Token': TOKEN } })
    .then(function(r){ return r.json(); })
    .then(function(j){
      if (!j || !j.data) throw new Error((j && j.error) || 'Could not load data');
      DATA = j.data;
      DATA.tasks = DATA.tasks || [];
      DATA.groups = DATA.groups || [];
      renderEvent();
      renderAll();
      setPill('idle','All changes saved');
    })
    .catch(function(err){
      setPill('error','Could not load');
      toast(err.message || 'Could not load the checklist.');
    });
})();
</script>
</body>
</html>
