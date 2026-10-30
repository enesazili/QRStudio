<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR Studio — QR kod üretimi</title>
    <style>
:root {
    --bg: #fbf7ed;
    --surface: #f2ead8;
    --surface-raised: #f6efe0;
    --ink: #282828;
    --ink-soft: #46433d;
    --muted: #6b665c;
    --line: #ded5c3;
    --line-strong: #c8bca6;
    --accent: #a4481f;
    --accent-soft: #f0dccb;
    --olive: #5b6a3d;
    --focus: #8d3a16;
    --selection: #e9d3bf;
    --font-sans: "Segoe UI", system-ui, -apple-system, "Helvetica Neue", Arial, sans-serif;
    --font-serif: "Iowan Old Style", "Palatino Linotype", Palatino, "Book Antiqua", Georgia, serif;
    --font-mono: "Cascadia Mono", ui-monospace, SFMono-Regular, Consolas, "Liberation Mono", monospace;
    --container: 1160px;
    --gutter: clamp(1.25rem, 4vw, 2.5rem);
    --radius: 2px;
    --ease: cubic-bezier(.2, .6, .2, 1);
    --speed: 180ms;
    color-scheme: light;
}

@media (prefers-color-scheme: dark) {
    :root {
        --bg: #0d1117;
        --surface: #161b22;
        --surface-raised: #1b222c;
        --ink: #e6edf3;
        --ink-soft: #c9d1d9;
        --muted: #9aa4af;
        --line: #30363d;
        --line-strong: #3d444d;
        --accent: #79b8ff;
        --accent-soft: #16283c;
        --olive: #8fbf7f;
        --focus: #a5d6ff;
        --selection: #1f3a56;
        color-scheme: dark;
    }
}

*, *::before, *::after { box-sizing: border-box; }
html { -webkit-text-size-adjust: 100%; }
body {
    margin: 0;
    background: var(--bg);
    color: var(--ink);
    font-family: var(--font-sans);
    font-size: 1rem;
    line-height: 1.65;
    -webkit-font-smoothing: antialiased;
}
main { display: block; }
h1, h2, h3 { color: var(--ink); text-wrap: balance; }
p { margin-top: 0; }
a { color: var(--accent); text-decoration-thickness: 1px; text-underline-offset: .18em; }
[hidden] { display: none !important; }
::selection { background: var(--selection); color: var(--ink); }

.container {
    width: 100%;
    max-width: var(--container);
    margin-inline: auto;
    padding-inline: var(--gutter);
}

.section { padding-block: clamp(2.25rem, 5vw, 3.75rem); }

.row { display: flex; flex-wrap: wrap; margin-inline: -.75rem; }
.row > * { width: 100%; padding-inline: .75rem; }

@media (min-width: 992px) {
    .col-lg-4 { width: 33.3333%; }
    .col-lg-5 { width: 41.6667%; }
    .col-lg-7 { width: 58.3333%; }
    .col-lg-8 { width: 66.6667%; }
    .offset-lg-1 { margin-left: 8.3333%; }
}

.section__label {
    margin-bottom: 1.15rem;
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .67rem;
    letter-spacing: .14em;
    line-height: 1.5;
    text-transform: uppercase;
}

.section__num { margin-right: .45rem; color: var(--accent); }

.section__title {
    margin: 0 0 1.25rem;
    font-family: var(--font-serif);
    font-size: clamp(2rem, 3.8vw, 3rem);
    font-weight: 400;
    line-height: 1.06;
    letter-spacing: -.03em;
}

.section__intro {
    max-width: 36rem;
    margin-bottom: 1.5rem;
    color: var(--ink-soft);
    font-size: .98rem;
    line-height: 1.7;
}

.visually-hidden {
    position: absolute !important;
    width: 1px !important;
    height: 1px !important;
    padding: 0 !important;
    margin: -1px !important;
    overflow: hidden !important;
    clip: rect(0, 0, 0, 0) !important;
    white-space: nowrap !important;
    border: 0 !important;
}

:where(a, button, [tabindex]):focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 3px;
}

@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: .01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: .01ms !important;
    }
}
/* ==========================================================================
   Tarayıcı araçları — Image Toolkit, Dev Toolbox, Text Diff, CSV, QR Studio
   Renkler site.css tokenlarından gelir; iki tema da desteklenir.
   ========================================================================== */

:root {
    --tool-add-bg: #e6efdb;
    --tool-add-ink: #2f4a1f;
    --tool-del-bg: #f7e2d8;
    --tool-del-ink: #7a2c10;
    --tool-change-bg: #f4e8c8;
    --tool-change-ink: #6b4a0f;
    --tool-warn-bg: #f6ecd2;
    --tool-warn-line: #a56a14;
}

[data-theme="dark"] {
    --tool-add-bg: #14261a;
    --tool-add-ink: #b8e6b0;
    --tool-del-bg: #2b1512;
    --tool-del-ink: #ffc2ad;
    --tool-change-bg: #2a2311;
    --tool-change-ink: #f0d491;
    --tool-warn-bg: #2a2311;
    --tool-warn-line: #d4a24a;
}

.site-nav--tool .site-nav__list {
    gap: 1.5rem;
}

.site-nav__label {
    display: inline-flex;
    align-items: center;
    min-height: 2.75rem;
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .72rem;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.tool .section__intro {
    max-width: 34rem;
}

.tool [hidden] {
    display: none !important;
}

/* Bilgi blokları --------------------------------------------------------- */

.tool-notice {
    margin-top: 2rem;
    padding: 1.35rem 1.4rem;
    border: 1px solid var(--line);
    border-left: 2px solid var(--accent);
    background: var(--surface-raised);
}

.tool-notice__title {
    margin: 0 0 .75rem;
    font-family: var(--font-mono);
    font-size: .74rem;
    font-weight: 600;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--muted);
}

.tool-notice__list {
    margin: 0;
    padding-left: 1.1rem;
    color: var(--ink-soft);
    font-size: .88rem;
    line-height: 1.6;
}

.tool-notice__list li + li {
    margin-top: .3rem;
}

.tool-meta {
    margin-top: 2rem;
}

.tool-meta__title {
    margin: 0 0 .6rem;
    font-family: var(--font-mono);
    font-size: .72rem;
    font-weight: 600;
    letter-spacing: .09em;
    text-transform: uppercase;
    color: var(--muted);
}

.tool-meta__line {
    margin: 0 0 .35rem;
    color: var(--ink-soft);
    font-size: .86rem;
    line-height: 1.55;
}

.tool-meta__key {
    display: inline-block;
    min-width: 7.5rem;
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .72rem;
    letter-spacing: .05em;
    text-transform: uppercase;
}

.tool-notes {
    margin: 0;
    padding-left: 1.1rem;
    color: var(--muted);
    font-size: .82rem;
    line-height: 1.6;
}

.tool-notes li + li {
    margin-top: .25rem;
}

.tool-links {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem 1.75rem;
    margin-top: 1.6rem;
}

.tool-noscript {
    margin-top: 1rem;
    color: var(--muted);
    font-size: .82rem;
    line-height: 1.5;
}

/* Paneller, alanlar ve düğmeler ----------------------------------------- */

.tool-panel {
    padding: clamp(1.15rem, 3vw, 1.9rem);
    border: 1px solid var(--line);
    background: var(--surface-raised);
}

.tool-panel + .tool-panel {
    margin-top: 1.25rem;
}

.tool-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem 1.25rem;
}

.tool-grid--three {
    grid-template-columns: repeat(3, minmax(0, 1fr));
}

.tool-field {
    min-width: 0;
    margin-bottom: 1.1rem;
}

.tool-grid .tool-field {
    margin-bottom: 0;
}

.tool-label,
.tool-legend {
    display: block;
    margin-bottom: .4rem;
    font-family: var(--font-mono);
    font-size: .72rem;
    font-weight: 600;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: var(--muted);
}

.tool-field__hint,
.tool-hint {
    margin: .45rem 0 0;
    color: var(--muted);
    font-size: .8rem;
    line-height: 1.5;
}

.tool-input,
.tool-select,
.tool-textarea {
    width: 100%;
    min-height: 2.75rem;
    padding: .55rem .7rem;
    border: 1px solid var(--line-strong);
    border-radius: var(--radius);
    background: var(--bg);
    color: var(--ink);
    font: inherit;
    font-size: .92rem;
}

.tool-textarea {
    min-height: 10rem;
    resize: vertical;
    font-family: var(--font-mono);
    font-size: .84rem;
    line-height: 1.55;
}

.tool-textarea--short {
    min-height: 6rem;
}

.tool-input:focus-visible,
.tool-select:focus-visible,
.tool-textarea:focus-visible,
.column-toggle input:focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

.tool-input:disabled,
.tool-select:disabled,
.tool-textarea:disabled {
    opacity: .6;
}

.tool-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: .6rem 1rem;
}

.tool-check {
    display: inline-flex;
    align-items: center;
    gap: .55rem;
    min-height: 2.75rem;
    color: var(--ink-soft);
    font-size: .86rem;
}

.tool-check input {
    width: 1.1rem;
    height: 1.1rem;
    accent-color: var(--accent);
}

.tool-actions {
    display: flex;
    flex-wrap: wrap;
    gap: .75rem;
    margin-top: 1.3rem;
}

.button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 2.75rem;
    padding: .55rem 1.15rem;
    border: 1px solid var(--line-strong);
    border-radius: var(--radius);
    background: transparent;
    color: var(--ink);
    font: inherit;
    font-size: .86rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: background var(--speed) var(--ease), border-color var(--speed) var(--ease), color var(--speed) var(--ease);
}

.button--primary {
    border-color: var(--accent);
    background: var(--accent);
    color: var(--bg);
}

.button--quiet {
    color: var(--ink-soft);
}

.button:disabled {
    cursor: not-allowed;
    opacity: .55;
}

@media (hover: hover) {
    .button:not(:disabled):hover {
        border-color: var(--accent);
        background: var(--surface);
        color: var(--accent);
    }

    .button--primary:not(:disabled):hover {
        background: var(--ink);
        border-color: var(--ink);
        color: var(--bg);
    }
}

.button:focus-visible,
.dev-tab:focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

.tool-status {
    min-height: 1.4rem;
    margin: 1rem 0 0;
    color: var(--ink-soft);
    font-size: .86rem;
    line-height: 1.5;
}

.tool-status.is-error {
    color: var(--accent);
}

.tool-empty {
    margin: 1rem 0 0;
    padding: 1.25rem;
    border: 1px dashed var(--line-strong);
    color: var(--muted);
    font-size: .88rem;
    line-height: 1.55;
    text-align: center;
}

.tool-warning {
    margin: 1rem 0 0;
    padding: .8rem 1rem;
    border-left: 2px solid var(--tool-warn-line);
    background: var(--tool-warn-bg);
    color: var(--ink-soft);
    font-size: .84rem;
    line-height: 1.55;
}

.tool-output {
    min-height: 7rem;
    max-height: 24rem;
    margin: 0;
    padding: .9rem 1rem;
    overflow: auto;
    border: 1px solid var(--line);
    background: var(--bg);
    color: var(--ink);
    font-family: var(--font-mono);
    font-size: .82rem;
    line-height: 1.55;
    white-space: pre-wrap;
    overflow-wrap: anywhere;
}

.tool-output:empty::before {
    content: "Sonuç burada görünecek.";
    color: var(--muted);
}

/* Dosya bırakma ---------------------------------------------------------- */

.dropzone {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: .35rem;
    min-height: 10rem;
    padding: 1.6rem 1.25rem;
    border: 1px dashed var(--line-strong);
    border-radius: var(--radius);
    background: var(--bg);
    text-align: center;
    cursor: pointer;
    transition: border-color var(--speed) var(--ease), background var(--speed) var(--ease);
}

.dropzone:hover,
.dropzone:focus-within {
    border-color: var(--accent);
    background: var(--surface);
}

.dropzone.is-dragover {
    border-style: solid;
    border-color: var(--accent);
    background: var(--accent-soft);
}

.dropzone__icon {
    font-family: var(--font-mono);
    font-size: 1.4rem;
    color: var(--accent);
}

.dropzone__title {
    font-size: .98rem;
    font-weight: 600;
    color: var(--ink);
}

.dropzone__hint {
    max-width: 26rem;
    color: var(--muted);
    font-size: .82rem;
    line-height: 1.5;
}

.dropzone:focus-within {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

/* Image Toolkit ---------------------------------------------------------- */

.image-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr);
    gap: 1.25rem;
}

.image-preview-wrap {
    padding: 1rem;
    border: 1px solid var(--line);
    background: var(--bg);
}

.image-preview {
    display: block;
    width: 100%;
    max-width: 34rem;
    height: auto;
    min-height: 9rem;
    margin: 0 auto;
    border: 1px solid var(--line);
    background: var(--surface);
}

.image-preview-note {
    margin: .7rem 0 0;
    color: var(--muted);
    font-size: .8rem;
    line-height: 1.45;
    text-align: center;
}

.image-list {
    margin: 1rem 0 0;
    padding: 0;
    list-style: none;
    border-top: 1px solid var(--line);
}

.image-list:empty {
    border-top: 0;
}

.image-item {
    padding: .9rem .1rem;
    border-bottom: 1px solid var(--line);
}

.image-item__main {
    display: flex;
    align-items: flex-start;
    gap: .9rem;
}

.image-item__text {
    flex: 1 1 auto;
    min-width: 0;
}

.image-thumb {
    flex: 0 0 auto;
    max-width: 104px;
    max-height: 104px;
    border: 1px solid var(--line);
    background: var(--surface);
}

.image-item__name {
    margin: 0;
    overflow-wrap: anywhere;
    font-size: .92rem;
    font-weight: 600;
}

.image-item__meta {
    margin: .25rem 0 0;
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .72rem;
    line-height: 1.45;
}

.image-item__state {
    margin: .4rem 0 0;
    color: var(--ink-soft);
    font-size: .82rem;
    line-height: 1.45;
}

.image-item__state.is-error {
    color: var(--accent);
}

.image-item__actions {
    display: flex;
    flex-wrap: wrap;
    gap: .35rem;
    margin-top: .5rem;
}

.image-item__remove {
    min-height: 2.75rem;
    padding: .3rem .65rem;
    border: 1px solid transparent;
    border-radius: var(--radius);
    background: transparent;
    color: var(--muted);
    font: inherit;
    font-size: .78rem;
    cursor: pointer;
}

.image-item__remove:hover,
.image-item__remove:focus-visible {
    border-color: var(--line-strong);
    color: var(--ink);
}

.image-item__remove:focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

.image-item__result {
    margin: .55rem 0 0;
}

.image-download {
    display: inline-flex;
    align-items: center;
    min-height: 2.75rem;
    color: var(--ink);
    font-size: .86rem;
    font-weight: 600;
    text-decoration: underline;
    text-decoration-color: var(--line-strong);
    text-underline-offset: .25em;
}

.image-download:focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

/* Dev Toolbox ------------------------------------------------------------ */

.dev-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: .35rem;
    margin: 0 0 1.1rem;
    padding: 0;
    list-style: none;
    border-bottom: 1px solid var(--line);
}

.dev-tab {
    min-height: 2.75rem;
    padding: .5rem .85rem;
    border: 0;
    border-bottom: 2px solid transparent;
    background: transparent;
    color: var(--muted);
    font: inherit;
    font-size: .82rem;
    font-weight: 600;
    cursor: pointer;
}

.dev-tab[aria-selected="true"] {
    border-bottom-color: var(--accent);
    color: var(--ink);
}

.dev-panel {
    min-width: 0;
}

.dev-panel__title {
    margin: 0 0 .5rem;
    font-family: var(--font-serif);
    font-size: 1.3rem;
}

.dev-panel__intro {
    margin: 0 0 1rem;
    color: var(--ink-soft);
    font-size: .86rem;
    line-height: 1.55;
}

.dev-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem;
}

.dev-output-label {
    display: block;
    margin: 1rem 0 .4rem;
    font-family: var(--font-mono);
    font-size: .7rem;
    font-weight: 600;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: var(--muted);
}

.dev-jwt-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

/* Text Diff -------------------------------------------------------------- */

.diff-layout {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem;
}

.diff-summary {
    margin: 1rem 0 0;
    padding: .75rem 1rem;
    border-left: 2px solid var(--accent);
    background: var(--surface);
    color: var(--ink-soft);
    font-size: .86rem;
    line-height: 1.5;
}

.diff-summary.is-error {
    color: var(--accent);
}

.diff-scroll {
    max-height: 34rem;
    margin-top: 1rem;
    overflow: auto;
    border: 1px solid var(--line);
    background: var(--bg);
}

.diff-table {
    width: 100%;
    border-collapse: collapse;
    font-family: var(--font-mono);
    font-size: .78rem;
    line-height: 1.5;
}

.diff-table caption {
    padding: .55rem .7rem;
    border-bottom: 1px solid var(--line);
    color: var(--muted);
    font-family: var(--font-sans);
    font-size: .78rem;
    text-align: left;
}

.diff-table th {
    position: sticky;
    top: 0;
    z-index: 1;
    padding: .45rem .55rem;
    border-bottom: 1px solid var(--line-strong);
    background: var(--surface);
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .68rem;
    font-weight: 600;
    letter-spacing: .05em;
    text-align: left;
    text-transform: uppercase;
    white-space: nowrap;
}

.diff-table td {
    padding: .38rem .55rem;
    border-bottom: 1px solid var(--line);
    vertical-align: top;
}

.diff-table__number {
    width: 4.2rem;
    color: var(--muted);
    text-align: right;
    white-space: nowrap;
}

.diff-table__status {
    width: 3.2rem;
    font-weight: 700;
    text-align: center;
}

.diff-table__text {
    overflow-wrap: anywhere;
    white-space: pre-wrap;
}

.diff-row--insert {
    background: var(--tool-add-bg);
    color: var(--tool-add-ink);
}

.diff-row--delete {
    background: var(--tool-del-bg);
    color: var(--tool-del-ink);
}

.diff-row--change {
    background: var(--tool-change-bg);
    color: var(--tool-change-ink);
}

.diff-row--equal {
    color: var(--ink-soft);
}

.diff-line {
    display: block;
}

.diff-line--removed::before {
    content: "− ";
    font-weight: 700;
}

.diff-line--added::before {
    content: "+ ";
    font-weight: 700;
}

.diff-line--removed {
    text-decoration: line-through;
    text-decoration-thickness: 1px;
}

.diff-empty {
    padding: 1.25rem !important;
    color: var(--muted);
    text-align: center;
}

/* CSV Toolkit ------------------------------------------------------------ */

.csv-controls {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 1rem;
    margin-top: 1.1rem;
}

.csv-columns {
    display: flex;
    flex-wrap: wrap;
    gap: .2rem .9rem;
    max-height: 10rem;
    margin: .2rem 0 0;
    padding: .5rem .65rem;
    overflow: auto;
    border: 1px solid var(--line);
    background: var(--bg);
}

.column-toggle {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    min-height: 2.75rem;
    color: var(--ink-soft);
    font-size: .8rem;
    overflow-wrap: anywhere;
}

.column-toggle input {
    flex: 0 0 auto;
    width: 1rem;
    height: 1rem;
    accent-color: var(--accent);
}

.csv-scroll {
    max-height: 32rem;
    margin-top: 1rem;
    overflow: auto;
    border: 1px solid var(--line);
    background: var(--bg);
}

.csv-table {
    width: 100%;
    border-collapse: collapse;
    font-family: var(--font-mono);
    font-size: .76rem;
    line-height: 1.45;
}

.csv-table caption {
    padding: .55rem .7rem;
    border-bottom: 1px solid var(--line);
    color: var(--muted);
    font-family: var(--font-sans);
    font-size: .78rem;
    text-align: left;
}

.csv-table th {
    position: sticky;
    top: 0;
    z-index: 1;
    padding: .5rem .55rem;
    border-bottom: 1px solid var(--line-strong);
    background: var(--surface);
    color: var(--ink-soft);
    font-family: var(--font-mono);
    font-size: .7rem;
    font-weight: 600;
    text-align: left;
    white-space: nowrap;
}

.csv-table td {
    max-width: 24rem;
    padding: .42rem .55rem;
    border-bottom: 1px solid var(--line);
    overflow-wrap: anywhere;
    vertical-align: top;
    white-space: pre-wrap;
}

.csv-table__line {
    width: 7rem;
    color: var(--muted);
    white-space: nowrap;
}

.csv-row.is-duplicate {
    background: var(--tool-change-bg);
    color: var(--tool-change-ink);
}

.csv-duplicate-badge {
    display: inline-block;
    padding: .05rem .3rem;
    border: 1px solid currentColor;
    border-radius: var(--radius);
    font-size: .62rem;
    font-weight: 700;
    letter-spacing: .03em;
    text-transform: uppercase;
}

.csv-empty {
    padding: 1.25rem !important;
    color: var(--muted);
    text-align: center;
}

.csv-note {
    margin: .7rem 0 0;
    color: var(--muted);
    font-size: .78rem;
    line-height: 1.5;
}

/* QR Studio -------------------------------------------------------------- */

.qr-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(15rem, .85fr);
    gap: 1.25rem;
    align-items: start;
}

.qr-preview-wrap {
    padding: 1rem;
    border: 1px solid var(--line);
    background: var(--bg);
    text-align: center;
}

.qr-preview {
    display: block;
    width: 100%;
    max-width: 26rem;
    aspect-ratio: 1 / 1;
    height: auto;
    margin: 0 auto;
    image-rendering: pixelated;
    border: 1px solid var(--line);
    background: var(--surface);
}

.qr-divider {
    margin: 1.2rem 0;
    border: 0;
    border-top: 1px solid var(--line);
}

.qr-size-note {
    margin: .7rem 0 0;
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .7rem;
    line-height: 1.45;
}

.qr-color-row {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem;
}

.qr-color {
    width: 100%;
    min-height: 2.75rem;
    padding: .2rem;
    border: 1px solid var(--line-strong);
    border-radius: var(--radius);
    background: var(--bg);
    cursor: pointer;
}

.qr-color:focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

/* Duyarlı ---------------------------------------------------------------- */

@media (max-width: 991.98px) {
    .qr-layout {
        grid-template-columns: minmax(0, 1fr);
    }

    .csv-controls {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 767.98px) {
    .tool-grid,
    .tool-grid--three,
    .dev-grid,
    .dev-jwt-grid,
    .diff-layout {
        grid-template-columns: minmax(0, 1fr);
    }

    .csv-controls {
        grid-template-columns: minmax(0, 1fr);
    }

    .tool-meta__key {
        display: block;
        min-width: 0;
    }

    .image-item__main {
        align-items: stretch;
    }

    .image-thumb {
        max-width: 72px;
        max-height: 72px;
    }
}

@media (max-width: 575.98px) {
    .tool-panel {
        padding: 1rem;
    }

    .tool-actions .button {
        flex: 1 1 auto;
    }

    .diff-table {
        font-size: .72rem;
    }

    .diff-table__number {
        width: 2.6rem;
    }

    .diff-table__status {
        width: 2.2rem;
    }
}

@media (prefers-reduced-motion: reduce) {
    .dropzone,
    .button {
        transition: none;
    }
}

    </style>
</head>
<body>
<main>
<section class="section tool" aria-labelledby="tool-title">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <p class="section__label"><span class="section__num">Araç</span> QR Studio</p>
                <h1 class="section__title" id="tool-title">QR kodunu yerelde üret.</h1>
                <p class="section__intro">
                    Metin, URL veya Wi-Fi bilgisi için QR kodu oluşturun. Rengi, boyutu, kenar
                    boşluğunu ve hata düzeltme seviyesini ayarlayın; PNG veya SVG indirin.
                </p>

                <div class="tool-notice">
                    <h2 class="tool-notice__title">Üretim ve çıktı</h2>
                    <ul class="tool-notice__list">
                        <li>QR matrisi qrcode-generator 1.4.4 (MIT lisansı) ile tarayıcıda üretilir.</li>
                        <li>SVG çıktısı yalnızca QR modüllerini ve doğrulanmış renkleri içerir; kullanıcı metni SVG kaynağına yazılmaz.</li>
                        <li>PNG ve SVG indirme bağlantıları Blob adresleriyle oluşturulur.</li>
                        <li>Çok uzun metinler QR kapasitesini aşarsa üretim reddedilir.</li>
                    </ul>
                </div>

                <div class="tool-meta">
                    <h2 class="tool-meta__title">Okunabilirlik</h2>
                    <ul class="tool-notes">
                        <li>Koyu ön plan ve açık arka plan kullanın; düşük kontrastta uyarı gösterilir.</li>
                        <li>Yüksek hata düzeltme seviyesi hasarlı kodlara dayanıklılık sağlar ancak kodu büyütür.</li>
                        <li>Wi-Fi QR’ı WPA, WEP ve parolasız ağları destekler; SSID ve parola QR standardına göre kaçırılır.</li>
                        <li>Çok uzun metinler QR kapasitesini aşarsa üretim reddedilir; sahte çıktı gösterilmez.</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-7 offset-lg-1" data-qr-tool>
                <div class="tool-panel">
                    <div class="tool-field">
                        <label class="tool-label" for="qr-type">QR türü</label>
                        <select class="tool-select" id="qr-type">
                            <option value="text">Metin</option>
                            <option value="url">URL</option>
                            <option value="wifi">Wi-Fi bağlantısı</option>
                        </select>
                    </div>

                    <div data-qr-fields="text">
                        <label class="tool-label" for="qr-text">Metin</label>
                        <textarea class="tool-textarea tool-textarea--short" id="qr-text" spellcheck="false" aria-describedby="qr-text-hint"></textarea>
                        <p class="tool-field__hint" id="qr-text-hint">QR kodu bu metni UTF-8 olarak taşır.</p>
                    </div>

                    <div data-qr-fields="url" hidden>
                        <label class="tool-label" for="qr-url">URL</label>
                        <input class="tool-input" id="qr-url" type="url" inputmode="url" placeholder="https://example.com" aria-describedby="qr-url-hint">
                        <p class="tool-field__hint" id="qr-url-hint">Yalnızca http:// ve https:// adresleri kabul edilir.</p>
                    </div>

                    <div data-qr-fields="wifi" hidden>
                        <div class="tool-grid">
                            <div class="tool-field">
                                <label class="tool-label" for="qr-ssid">Ağ adı (SSID)</label>
                                <input class="tool-input" id="qr-ssid" type="text" autocomplete="off" aria-describedby="qr-ssid-hint">
                                <p class="tool-field__hint" id="qr-ssid-hint">Ağın görünen adı.</p>
                            </div>
                            <div class="tool-field">
                                <label class="tool-label" for="qr-security">Güvenlik</label>
                                <select class="tool-select" id="qr-security">
                                    <option value="WPA" selected>WPA / WPA2 / WPA3</option>
                                    <option value="WEP">WEP</option>
                                    <option value="nopass">Parolasız</option>
                                </select>
                            </div>
                        </div>
                        <div class="tool-field">
                            <label class="tool-label" for="qr-password">Parola</label>
                            <input class="tool-input" id="qr-password" type="password" autocomplete="new-password" aria-describedby="qr-password-hint">
                            <p class="tool-field__hint" id="qr-password-hint">Parola yalnızca QR kodu üretmek için kullanılır.</p>
                        </div>
                        <label class="tool-check">
                            <input id="qr-hidden" type="checkbox">
                            Ağ gizli
                        </label>
                    </div>

                    <hr class="qr-divider">

                    <div class="tool-grid">
                        <div class="tool-field">
                            <label class="tool-label" for="qr-size">Boyut (px)</label>
                            <input class="tool-input" id="qr-size" type="number" min="128" max="1024" step="8" value="256" inputmode="numeric">
                        </div>
                        <div class="tool-field">
                            <label class="tool-label" for="qr-margin">Kenar boşluğu (modül)</label>
                            <input class="tool-input" id="qr-margin" type="number" min="0" max="16" step="1" value="4" inputmode="numeric">
                        </div>
                        <div class="tool-field">
                            <label class="tool-label" for="qr-ecc">Hata düzeltme</label>
                            <select class="tool-select" id="qr-ecc">
                                <option value="L">L — düşük (%7)</option>
                                <option value="M" selected>M — orta (%15)</option>
                                <option value="Q">Q — dörtte bir (%25)</option>
                                <option value="H">H — yüksek (%30)</option>
                            </select>
                        </div>
                        <div class="tool-field">
                            <span class="tool-label">Renkler</span>
                            <div class="qr-color-row">
                                <label class="tool-check" for="qr-foreground">
                                    <input class="qr-color" id="qr-foreground" type="color" value="#282828">
                                    Ön plan
                                </label>
                                <label class="tool-check" for="qr-background">
                                    <input class="qr-color" id="qr-background" type="color" value="#fbf7ed">
                                    Arka plan
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="tool-actions">
                        <button class="button button--primary" type="button" data-qr-png disabled>PNG indir</button>
                        <button class="button" type="button" data-qr-svg disabled>SVG indir</button>
                        <button class="button button--quiet" type="button" data-qr-clear>Girdileri temizle</button>
                    </div>

                    <p class="tool-warning" data-qr-warning hidden></p>
                    <p class="tool-status" role="status" aria-live="polite" data-qr-status></p>

                    <noscript>
                        <p class="tool-noscript">QR üretimi JavaScript ile yapılır. JavaScript kapalıyken bu araç çalışmaz.</p>
                    </noscript>
                </div>

                <div class="tool-panel">
                    <div class="qr-layout">
                        <div class="qr-preview-wrap">
                            <canvas class="qr-preview" id="qr-preview" width="1" height="1" role="img" aria-label="Üretilen QR kodunun önizlemesi"></canvas>
                            <p class="qr-size-note" data-qr-size-note></p>
                        </div>
                        <div>
                            <h2 class="tool-meta__title">Önizleme</h2>
                            <p class="tool-meta__line">
                                Girdi veya ayarlar değiştiğinde QR kodu yeniden üretilir. Boş veya geçersiz
                                girdide indirme düğmeleri kapalı kalır.
                            </p>
                            <p class="tool-meta__line">
                                Gerçek çıktı boyutu, modül sayısına göre tam piksel hizalaması için
                                istenen boyuta en yakın küçük değere yuvarlanabilir.
                            </p>
                        </div>
                    </div>
                </div>
</div>
        </div>
    </div>
</section>
</main>
<script>
//---------------------------------------------------------------------
//
// QR Code Generator for JavaScript
//
// Copyright (c) 2009 Kazuhiko Arase
//
// URL: http://www.d-project.com/
//
// Licensed under the MIT license:
//  http://www.opensource.org/licenses/mit-license.php
//
// The word 'QR Code' is registered trademark of
// DENSO WAVE INCORPORATED
//  http://www.denso-wave.com/qrcode/faqpatent-e.html
//
//---------------------------------------------------------------------

var qrcode = function() {

  //---------------------------------------------------------------------
  // qrcode
  //---------------------------------------------------------------------

  /**
   * qrcode
   * @param typeNumber 1 to 40
   * @param errorCorrectionLevel 'L','M','Q','H'
   */
  var qrcode = function(typeNumber, errorCorrectionLevel) {

    var PAD0 = 0xEC;
    var PAD1 = 0x11;

    var _typeNumber = typeNumber;
    var _errorCorrectionLevel = QRErrorCorrectionLevel[errorCorrectionLevel];
    var _modules = null;
    var _moduleCount = 0;
    var _dataCache = null;
    var _dataList = [];

    var _this = {};

    var makeImpl = function(test, maskPattern) {

      _moduleCount = _typeNumber * 4 + 17;
      _modules = function(moduleCount) {
        var modules = new Array(moduleCount);
        for (var row = 0; row < moduleCount; row += 1) {
          modules[row] = new Array(moduleCount);
          for (var col = 0; col < moduleCount; col += 1) {
            modules[row][col] = null;
          }
        }
        return modules;
      }(_moduleCount);

      setupPositionProbePattern(0, 0);
      setupPositionProbePattern(_moduleCount - 7, 0);
      setupPositionProbePattern(0, _moduleCount - 7);
      setupPositionAdjustPattern();
      setupTimingPattern();
      setupTypeInfo(test, maskPattern);

      if (_typeNumber >= 7) {
        setupTypeNumber(test);
      }

      if (_dataCache == null) {
        _dataCache = createData(_typeNumber, _errorCorrectionLevel, _dataList);
      }

      mapData(_dataCache, maskPattern);
    };

    var setupPositionProbePattern = function(row, col) {

      for (var r = -1; r <= 7; r += 1) {

        if (row + r <= -1 || _moduleCount <= row + r) continue;

        for (var c = -1; c <= 7; c += 1) {

          if (col + c <= -1 || _moduleCount <= col + c) continue;

          if ( (0 <= r && r <= 6 && (c == 0 || c == 6) )
              || (0 <= c && c <= 6 && (r == 0 || r == 6) )
              || (2 <= r && r <= 4 && 2 <= c && c <= 4) ) {
            _modules[row + r][col + c] = true;
          } else {
            _modules[row + r][col + c] = false;
          }
        }
      }
    };

    var getBestMaskPattern = function() {

      var minLostPoint = 0;
      var pattern = 0;

      for (var i = 0; i < 8; i += 1) {

        makeImpl(true, i);

        var lostPoint = QRUtil.getLostPoint(_this);

        if (i == 0 || minLostPoint > lostPoint) {
          minLostPoint = lostPoint;
          pattern = i;
        }
      }

      return pattern;
    };

    var setupTimingPattern = function() {

      for (var r = 8; r < _moduleCount - 8; r += 1) {
        if (_modules[r][6] != null) {
          continue;
        }
        _modules[r][6] = (r % 2 == 0);
      }

      for (var c = 8; c < _moduleCount - 8; c += 1) {
        if (_modules[6][c] != null) {
          continue;
        }
        _modules[6][c] = (c % 2 == 0);
      }
    };

    var setupPositionAdjustPattern = function() {

      var pos = QRUtil.getPatternPosition(_typeNumber);

      for (var i = 0; i < pos.length; i += 1) {

        for (var j = 0; j < pos.length; j += 1) {

          var row = pos[i];
          var col = pos[j];

          if (_modules[row][col] != null) {
            continue;
          }

          for (var r = -2; r <= 2; r += 1) {

            for (var c = -2; c <= 2; c += 1) {

              if (r == -2 || r == 2 || c == -2 || c == 2
                  || (r == 0 && c == 0) ) {
                _modules[row + r][col + c] = true;
              } else {
                _modules[row + r][col + c] = false;
              }
            }
          }
        }
      }
    };

    var setupTypeNumber = function(test) {

      var bits = QRUtil.getBCHTypeNumber(_typeNumber);

      for (var i = 0; i < 18; i += 1) {
        var mod = (!test && ( (bits >> i) & 1) == 1);
        _modules[Math.floor(i / 3)][i % 3 + _moduleCount - 8 - 3] = mod;
      }

      for (var i = 0; i < 18; i += 1) {
        var mod = (!test && ( (bits >> i) & 1) == 1);
        _modules[i % 3 + _moduleCount - 8 - 3][Math.floor(i / 3)] = mod;
      }
    };

    var setupTypeInfo = function(test, maskPattern) {

      var data = (_errorCorrectionLevel << 3) | maskPattern;
      var bits = QRUtil.getBCHTypeInfo(data);

      // vertical
      for (var i = 0; i < 15; i += 1) {

        var mod = (!test && ( (bits >> i) & 1) == 1);

        if (i < 6) {
          _modules[i][8] = mod;
        } else if (i < 8) {
          _modules[i + 1][8] = mod;
        } else {
          _modules[_moduleCount - 15 + i][8] = mod;
        }
      }

      // horizontal
      for (var i = 0; i < 15; i += 1) {

        var mod = (!test && ( (bits >> i) & 1) == 1);

        if (i < 8) {
          _modules[8][_moduleCount - i - 1] = mod;
        } else if (i < 9) {
          _modules[8][15 - i - 1 + 1] = mod;
        } else {
          _modules[8][15 - i - 1] = mod;
        }
      }

      // fixed module
      _modules[_moduleCount - 8][8] = (!test);
    };

    var mapData = function(data, maskPattern) {

      var inc = -1;
      var row = _moduleCount - 1;
      var bitIndex = 7;
      var byteIndex = 0;
      var maskFunc = QRUtil.getMaskFunction(maskPattern);

      for (var col = _moduleCount - 1; col > 0; col -= 2) {

        if (col == 6) col -= 1;

        while (true) {

          for (var c = 0; c < 2; c += 1) {

            if (_modules[row][col - c] == null) {

              var dark = false;

              if (byteIndex < data.length) {
                dark = ( ( (data[byteIndex] >>> bitIndex) & 1) == 1);
              }

              var mask = maskFunc(row, col - c);

              if (mask) {
                dark = !dark;
              }

              _modules[row][col - c] = dark;
              bitIndex -= 1;

              if (bitIndex == -1) {
                byteIndex += 1;
                bitIndex = 7;
              }
            }
          }

          row += inc;

          if (row < 0 || _moduleCount <= row) {
            row -= inc;
            inc = -inc;
            break;
          }
        }
      }
    };

    var createBytes = function(buffer, rsBlocks) {

      var offset = 0;

      var maxDcCount = 0;
      var maxEcCount = 0;

      var dcdata = new Array(rsBlocks.length);
      var ecdata = new Array(rsBlocks.length);

      for (var r = 0; r < rsBlocks.length; r += 1) {

        var dcCount = rsBlocks[r].dataCount;
        var ecCount = rsBlocks[r].totalCount - dcCount;

        maxDcCount = Math.max(maxDcCount, dcCount);
        maxEcCount = Math.max(maxEcCount, ecCount);

        dcdata[r] = new Array(dcCount);

        for (var i = 0; i < dcdata[r].length; i += 1) {
          dcdata[r][i] = 0xff & buffer.getBuffer()[i + offset];
        }
        offset += dcCount;

        var rsPoly = QRUtil.getErrorCorrectPolynomial(ecCount);
        var rawPoly = qrPolynomial(dcdata[r], rsPoly.getLength() - 1);

        var modPoly = rawPoly.mod(rsPoly);
        ecdata[r] = new Array(rsPoly.getLength() - 1);
        for (var i = 0; i < ecdata[r].length; i += 1) {
          var modIndex = i + modPoly.getLength() - ecdata[r].length;
          ecdata[r][i] = (modIndex >= 0)? modPoly.getAt(modIndex) : 0;
        }
      }

      var totalCodeCount = 0;
      for (var i = 0; i < rsBlocks.length; i += 1) {
        totalCodeCount += rsBlocks[i].totalCount;
      }

      var data = new Array(totalCodeCount);
      var index = 0;

      for (var i = 0; i < maxDcCount; i += 1) {
        for (var r = 0; r < rsBlocks.length; r += 1) {
          if (i < dcdata[r].length) {
            data[index] = dcdata[r][i];
            index += 1;
          }
        }
      }

      for (var i = 0; i < maxEcCount; i += 1) {
        for (var r = 0; r < rsBlocks.length; r += 1) {
          if (i < ecdata[r].length) {
            data[index] = ecdata[r][i];
            index += 1;
          }
        }
      }

      return data;
    };

    var createData = function(typeNumber, errorCorrectionLevel, dataList) {

      var rsBlocks = QRRSBlock.getRSBlocks(typeNumber, errorCorrectionLevel);

      var buffer = qrBitBuffer();

      for (var i = 0; i < dataList.length; i += 1) {
        var data = dataList[i];
        buffer.put(data.getMode(), 4);
        buffer.put(data.getLength(), QRUtil.getLengthInBits(data.getMode(), typeNumber) );
        data.write(buffer);
      }

      // calc num max data.
      var totalDataCount = 0;
      for (var i = 0; i < rsBlocks.length; i += 1) {
        totalDataCount += rsBlocks[i].dataCount;
      }

      if (buffer.getLengthInBits() > totalDataCount * 8) {
        throw 'code length overflow. ('
          + buffer.getLengthInBits()
          + '>'
          + totalDataCount * 8
          + ')';
      }

      // end code
      if (buffer.getLengthInBits() + 4 <= totalDataCount * 8) {
        buffer.put(0, 4);
      }

      // padding
      while (buffer.getLengthInBits() % 8 != 0) {
        buffer.putBit(false);
      }

      // padding
      while (true) {

        if (buffer.getLengthInBits() >= totalDataCount * 8) {
          break;
        }
        buffer.put(PAD0, 8);

        if (buffer.getLengthInBits() >= totalDataCount * 8) {
          break;
        }
        buffer.put(PAD1, 8);
      }

      return createBytes(buffer, rsBlocks);
    };

    _this.addData = function(data, mode) {

      mode = mode || 'Byte';

      var newData = null;

      switch(mode) {
      case 'Numeric' :
        newData = qrNumber(data);
        break;
      case 'Alphanumeric' :
        newData = qrAlphaNum(data);
        break;
      case 'Byte' :
        newData = qr8BitByte(data);
        break;
      case 'Kanji' :
        newData = qrKanji(data);
        break;
      default :
        throw 'mode:' + mode;
      }

      _dataList.push(newData);
      _dataCache = null;
    };

    _this.isDark = function(row, col) {
      if (row < 0 || _moduleCount <= row || col < 0 || _moduleCount <= col) {
        throw row + ',' + col;
      }
      return _modules[row][col];
    };

    _this.getModuleCount = function() {
      return _moduleCount;
    };

    _this.make = function() {
      if (_typeNumber < 1) {
        var typeNumber = 1;

        for (; typeNumber < 40; typeNumber++) {
          var rsBlocks = QRRSBlock.getRSBlocks(typeNumber, _errorCorrectionLevel);
          var buffer = qrBitBuffer();

          for (var i = 0; i < _dataList.length; i++) {
            var data = _dataList[i];
            buffer.put(data.getMode(), 4);
            buffer.put(data.getLength(), QRUtil.getLengthInBits(data.getMode(), typeNumber) );
            data.write(buffer);
          }

          var totalDataCount = 0;
          for (var i = 0; i < rsBlocks.length; i++) {
            totalDataCount += rsBlocks[i].dataCount;
          }

          if (buffer.getLengthInBits() <= totalDataCount * 8) {
            break;
          }
        }

        _typeNumber = typeNumber;
      }

      makeImpl(false, getBestMaskPattern() );
    };

    _this.createTableTag = function(cellSize, margin) {

      cellSize = cellSize || 2;
      margin = (typeof margin == 'undefined')? cellSize * 4 : margin;

      var qrHtml = '';

      qrHtml += '<table style="';
      qrHtml += ' border-width: 0px; border-style: none;';
      qrHtml += ' border-collapse: collapse;';
      qrHtml += ' padding: 0px; margin: ' + margin + 'px;';
      qrHtml += '">';
      qrHtml += '<tbody>';

      for (var r = 0; r < _this.getModuleCount(); r += 1) {

        qrHtml += '<tr>';

        for (var c = 0; c < _this.getModuleCount(); c += 1) {
          qrHtml += '<td style="';
          qrHtml += ' border-width: 0px; border-style: none;';
          qrHtml += ' border-collapse: collapse;';
          qrHtml += ' padding: 0px; margin: 0px;';
          qrHtml += ' width: ' + cellSize + 'px;';
          qrHtml += ' height: ' + cellSize + 'px;';
          qrHtml += ' background-color: ';
          qrHtml += _this.isDark(r, c)? '#000000' : '#ffffff';
          qrHtml += ';';
          qrHtml += '"/>';
        }

        qrHtml += '</tr>';
      }

      qrHtml += '</tbody>';
      qrHtml += '</table>';

      return qrHtml;
    };

    _this.createSvgTag = function(cellSize, margin, alt, title) {

      var opts = {};
      if (typeof arguments[0] == 'object') {
        // Called by options.
        opts = arguments[0];
        // overwrite cellSize and margin.
        cellSize = opts.cellSize;
        margin = opts.margin;
        alt = opts.alt;
        title = opts.title;
      }

      cellSize = cellSize || 2;
      margin = (typeof margin == 'undefined')? cellSize * 4 : margin;

      // Compose alt property surrogate
      alt = (typeof alt === 'string') ? {text: alt} : alt || {};
      alt.text = alt.text || null;
      alt.id = (alt.text) ? alt.id || 'qrcode-description' : null;

      // Compose title property surrogate
      title = (typeof title === 'string') ? {text: title} : title || {};
      title.text = title.text || null;
      title.id = (title.text) ? title.id || 'qrcode-title' : null;

      var size = _this.getModuleCount() * cellSize + margin * 2;
      var c, mc, r, mr, qrSvg='', rect;

      rect = 'l' + cellSize + ',0 0,' + cellSize +
        ' -' + cellSize + ',0 0,-' + cellSize + 'z ';

      qrSvg += '<svg version="1.1" xmlns="http://www.w3.org/2000/svg"';
      qrSvg += !opts.scalable ? ' width="' + size + 'px" height="' + size + 'px"' : '';
      qrSvg += ' viewBox="0 0 ' + size + ' ' + size + '" ';
      qrSvg += ' preserveAspectRatio="xMinYMin meet"';
      qrSvg += (title.text || alt.text) ? ' role="img" aria-labelledby="' +
          escapeXml([title.id, alt.id].join(' ').trim() ) + '"' : '';
      qrSvg += '>';
      qrSvg += (title.text) ? '<title id="' + escapeXml(title.id) + '">' +
          escapeXml(title.text) + '</title>' : '';
      qrSvg += (alt.text) ? '<description id="' + escapeXml(alt.id) + '">' +
          escapeXml(alt.text) + '</description>' : '';
      qrSvg += '<rect width="100%" height="100%" fill="white" cx="0" cy="0"/>';
      qrSvg += '<path d="';

      for (r = 0; r < _this.getModuleCount(); r += 1) {
        mr = r * cellSize + margin;
        for (c = 0; c < _this.getModuleCount(); c += 1) {
          if (_this.isDark(r, c) ) {
            mc = c*cellSize+margin;
            qrSvg += 'M' + mc + ',' + mr + rect;
          }
        }
      }

      qrSvg += '" stroke="transparent" fill="black"/>';
      qrSvg += '</svg>';

      return qrSvg;
    };

    _this.createDataURL = function(cellSize, margin) {

      cellSize = cellSize || 2;
      margin = (typeof margin == 'undefined')? cellSize * 4 : margin;

      var size = _this.getModuleCount() * cellSize + margin * 2;
      var min = margin;
      var max = size - margin;

      return createDataURL(size, size, function(x, y) {
        if (min <= x && x < max && min <= y && y < max) {
          var c = Math.floor( (x - min) / cellSize);
          var r = Math.floor( (y - min) / cellSize);
          return _this.isDark(r, c)? 0 : 1;
        } else {
          return 1;
        }
      } );
    };

    _this.createImgTag = function(cellSize, margin, alt) {

      cellSize = cellSize || 2;
      margin = (typeof margin == 'undefined')? cellSize * 4 : margin;

      var size = _this.getModuleCount() * cellSize + margin * 2;

      var img = '';
      img += '<img';
      img += '\u0020src="';
      img += _this.createDataURL(cellSize, margin);
      img += '"';
      img += '\u0020width="';
      img += size;
      img += '"';
      img += '\u0020height="';
      img += size;
      img += '"';
      if (alt) {
        img += '\u0020alt="';
        img += escapeXml(alt);
        img += '"';
      }
      img += '/>';

      return img;
    };

    var escapeXml = function(s) {
      var escaped = '';
      for (var i = 0; i < s.length; i += 1) {
        var c = s.charAt(i);
        switch(c) {
        case '<': escaped += '&lt;'; break;
        case '>': escaped += '&gt;'; break;
        case '&': escaped += '&amp;'; break;
        case '"': escaped += '&quot;'; break;
        default : escaped += c; break;
        }
      }
      return escaped;
    };

    var _createHalfASCII = function(margin) {
      var cellSize = 1;
      margin = (typeof margin == 'undefined')? cellSize * 2 : margin;

      var size = _this.getModuleCount() * cellSize + margin * 2;
      var min = margin;
      var max = size - margin;

      var y, x, r1, r2, p;

      var blocks = {
        '██': '█',
        '█ ': '▀',
        ' █': '▄',
        '  ': ' '
      };

      var blocksLastLineNoMargin = {
        '██': '▀',
        '█ ': '▀',
        ' █': ' ',
        '  ': ' '
      };

      var ascii = '';
      for (y = 0; y < size; y += 2) {
        r1 = Math.floor((y - min) / cellSize);
        r2 = Math.floor((y + 1 - min) / cellSize);
        for (x = 0; x < size; x += 1) {
          p = '█';

          if (min <= x && x < max && min <= y && y < max && _this.isDark(r1, Math.floor((x - min) / cellSize))) {
            p = ' ';
          }

          if (min <= x && x < max && min <= y+1 && y+1 < max && _this.isDark(r2, Math.floor((x - min) / cellSize))) {
            p += ' ';
          }
          else {
            p += '█';
          }

          // Output 2 characters per pixel, to create full square. 1 character per pixels gives only half width of square.
          ascii += (margin < 1 && y+1 >= max) ? blocksLastLineNoMargin[p] : blocks[p];
        }

        ascii += '\n';
      }

      if (size % 2 && margin > 0) {
        return ascii.substring(0, ascii.length - size - 1) + Array(size+1).join('▀');
      }

      return ascii.substring(0, ascii.length-1);
    };

    _this.createASCII = function(cellSize, margin) {
      cellSize = cellSize || 1;

      if (cellSize < 2) {
        return _createHalfASCII(margin);
      }

      cellSize -= 1;
      margin = (typeof margin == 'undefined')? cellSize * 2 : margin;

      var size = _this.getModuleCount() * cellSize + margin * 2;
      var min = margin;
      var max = size - margin;

      var y, x, r, p;

      var white = Array(cellSize+1).join('██');
      var black = Array(cellSize+1).join('  ');

      var ascii = '';
      var line = '';
      for (y = 0; y < size; y += 1) {
        r = Math.floor( (y - min) / cellSize);
        line = '';
        for (x = 0; x < size; x += 1) {
          p = 1;

          if (min <= x && x < max && min <= y && y < max && _this.isDark(r, Math.floor((x - min) / cellSize))) {
            p = 0;
          }

          // Output 2 characters per pixel, to create full square. 1 character per pixels gives only half width of square.
          line += p ? white : black;
        }

        for (r = 0; r < cellSize; r += 1) {
          ascii += line + '\n';
        }
      }

      return ascii.substring(0, ascii.length-1);
    };

    _this.renderTo2dContext = function(context, cellSize) {
      cellSize = cellSize || 2;
      var length = _this.getModuleCount();
      for (var row = 0; row < length; row++) {
        for (var col = 0; col < length; col++) {
          context.fillStyle = _this.isDark(row, col) ? 'black' : 'white';
          context.fillRect(row * cellSize, col * cellSize, cellSize, cellSize);
        }
      }
    }

    return _this;
  };

  //---------------------------------------------------------------------
  // qrcode.stringToBytes
  //---------------------------------------------------------------------

  qrcode.stringToBytesFuncs = {
    'default' : function(s) {
      var bytes = [];
      for (var i = 0; i < s.length; i += 1) {
        var c = s.charCodeAt(i);
        bytes.push(c & 0xff);
      }
      return bytes;
    }
  };

  qrcode.stringToBytes = qrcode.stringToBytesFuncs['default'];

  //---------------------------------------------------------------------
  // qrcode.createStringToBytes
  //---------------------------------------------------------------------

  /**
   * @param unicodeData base64 string of byte array.
   * [16bit Unicode],[16bit Bytes], ...
   * @param numChars
   */
  qrcode.createStringToBytes = function(unicodeData, numChars) {

    // create conversion map.

    var unicodeMap = function() {

      var bin = base64DecodeInputStream(unicodeData);
      var read = function() {
        var b = bin.read();
        if (b == -1) throw 'eof';
        return b;
      };

      var count = 0;
      var unicodeMap = {};
      while (true) {
        var b0 = bin.read();
        if (b0 == -1) break;
        var b1 = read();
        var b2 = read();
        var b3 = read();
        var k = String.fromCharCode( (b0 << 8) | b1);
        var v = (b2 << 8) | b3;
        unicodeMap[k] = v;
        count += 1;
      }
      if (count != numChars) {
        throw count + ' != ' + numChars;
      }

      return unicodeMap;
    }();

    var unknownChar = '?'.charCodeAt(0);

    return function(s) {
      var bytes = [];
      for (var i = 0; i < s.length; i += 1) {
        var c = s.charCodeAt(i);
        if (c < 128) {
          bytes.push(c);
        } else {
          var b = unicodeMap[s.charAt(i)];
          if (typeof b == 'number') {
            if ( (b & 0xff) == b) {
              // 1byte
              bytes.push(b);
            } else {
              // 2bytes
              bytes.push(b >>> 8);
              bytes.push(b & 0xff);
            }
          } else {
            bytes.push(unknownChar);
          }
        }
      }
      return bytes;
    };
  };

  //---------------------------------------------------------------------
  // QRMode
  //---------------------------------------------------------------------

  var QRMode = {
    MODE_NUMBER :    1 << 0,
    MODE_ALPHA_NUM : 1 << 1,
    MODE_8BIT_BYTE : 1 << 2,
    MODE_KANJI :     1 << 3
  };

  //---------------------------------------------------------------------
  // QRErrorCorrectionLevel
  //---------------------------------------------------------------------

  var QRErrorCorrectionLevel = {
    L : 1,
    M : 0,
    Q : 3,
    H : 2
  };

  //---------------------------------------------------------------------
  // QRMaskPattern
  //---------------------------------------------------------------------

  var QRMaskPattern = {
    PATTERN000 : 0,
    PATTERN001 : 1,
    PATTERN010 : 2,
    PATTERN011 : 3,
    PATTERN100 : 4,
    PATTERN101 : 5,
    PATTERN110 : 6,
    PATTERN111 : 7
  };

  //---------------------------------------------------------------------
  // QRUtil
  //---------------------------------------------------------------------

  var QRUtil = function() {

    var PATTERN_POSITION_TABLE = [
      [],
      [6, 18],
      [6, 22],
      [6, 26],
      [6, 30],
      [6, 34],
      [6, 22, 38],
      [6, 24, 42],
      [6, 26, 46],
      [6, 28, 50],
      [6, 30, 54],
      [6, 32, 58],
      [6, 34, 62],
      [6, 26, 46, 66],
      [6, 26, 48, 70],
      [6, 26, 50, 74],
      [6, 30, 54, 78],
      [6, 30, 56, 82],
      [6, 30, 58, 86],
      [6, 34, 62, 90],
      [6, 28, 50, 72, 94],
      [6, 26, 50, 74, 98],
      [6, 30, 54, 78, 102],
      [6, 28, 54, 80, 106],
      [6, 32, 58, 84, 110],
      [6, 30, 58, 86, 114],
      [6, 34, 62, 90, 118],
      [6, 26, 50, 74, 98, 122],
      [6, 30, 54, 78, 102, 126],
      [6, 26, 52, 78, 104, 130],
      [6, 30, 56, 82, 108, 134],
      [6, 34, 60, 86, 112, 138],
      [6, 30, 58, 86, 114, 142],
      [6, 34, 62, 90, 118, 146],
      [6, 30, 54, 78, 102, 126, 150],
      [6, 24, 50, 76, 102, 128, 154],
      [6, 28, 54, 80, 106, 132, 158],
      [6, 32, 58, 84, 110, 136, 162],
      [6, 26, 54, 82, 110, 138, 166],
      [6, 30, 58, 86, 114, 142, 170]
    ];
    var G15 = (1 << 10) | (1 << 8) | (1 << 5) | (1 << 4) | (1 << 2) | (1 << 1) | (1 << 0);
    var G18 = (1 << 12) | (1 << 11) | (1 << 10) | (1 << 9) | (1 << 8) | (1 << 5) | (1 << 2) | (1 << 0);
    var G15_MASK = (1 << 14) | (1 << 12) | (1 << 10) | (1 << 4) | (1 << 1);

    var _this = {};

    var getBCHDigit = function(data) {
      var digit = 0;
      while (data != 0) {
        digit += 1;
        data >>>= 1;
      }
      return digit;
    };

    _this.getBCHTypeInfo = function(data) {
      var d = data << 10;
      while (getBCHDigit(d) - getBCHDigit(G15) >= 0) {
        d ^= (G15 << (getBCHDigit(d) - getBCHDigit(G15) ) );
      }
      return ( (data << 10) | d) ^ G15_MASK;
    };

    _this.getBCHTypeNumber = function(data) {
      var d = data << 12;
      while (getBCHDigit(d) - getBCHDigit(G18) >= 0) {
        d ^= (G18 << (getBCHDigit(d) - getBCHDigit(G18) ) );
      }
      return (data << 12) | d;
    };

    _this.getPatternPosition = function(typeNumber) {
      return PATTERN_POSITION_TABLE[typeNumber - 1];
    };

    _this.getMaskFunction = function(maskPattern) {

      switch (maskPattern) {

      case QRMaskPattern.PATTERN000 :
        return function(i, j) { return (i + j) % 2 == 0; };
      case QRMaskPattern.PATTERN001 :
        return function(i, j) { return i % 2 == 0; };
      case QRMaskPattern.PATTERN010 :
        return function(i, j) { return j % 3 == 0; };
      case QRMaskPattern.PATTERN011 :
        return function(i, j) { return (i + j) % 3 == 0; };
      case QRMaskPattern.PATTERN100 :
        return function(i, j) { return (Math.floor(i / 2) + Math.floor(j / 3) ) % 2 == 0; };
      case QRMaskPattern.PATTERN101 :
        return function(i, j) { return (i * j) % 2 + (i * j) % 3 == 0; };
      case QRMaskPattern.PATTERN110 :
        return function(i, j) { return ( (i * j) % 2 + (i * j) % 3) % 2 == 0; };
      case QRMaskPattern.PATTERN111 :
        return function(i, j) { return ( (i * j) % 3 + (i + j) % 2) % 2 == 0; };

      default :
        throw 'bad maskPattern:' + maskPattern;
      }
    };

    _this.getErrorCorrectPolynomial = function(errorCorrectLength) {
      var a = qrPolynomial([1], 0);
      for (var i = 0; i < errorCorrectLength; i += 1) {
        a = a.multiply(qrPolynomial([1, QRMath.gexp(i)], 0) );
      }
      return a;
    };

    _this.getLengthInBits = function(mode, type) {

      if (1 <= type && type < 10) {

        // 1 - 9

        switch(mode) {
        case QRMode.MODE_NUMBER    : return 10;
        case QRMode.MODE_ALPHA_NUM : return 9;
        case QRMode.MODE_8BIT_BYTE : return 8;
        case QRMode.MODE_KANJI     : return 8;
        default :
          throw 'mode:' + mode;
        }

      } else if (type < 27) {

        // 10 - 26

        switch(mode) {
        case QRMode.MODE_NUMBER    : return 12;
        case QRMode.MODE_ALPHA_NUM : return 11;
        case QRMode.MODE_8BIT_BYTE : return 16;
        case QRMode.MODE_KANJI     : return 10;
        default :
          throw 'mode:' + mode;
        }

      } else if (type < 41) {

        // 27 - 40

        switch(mode) {
        case QRMode.MODE_NUMBER    : return 14;
        case QRMode.MODE_ALPHA_NUM : return 13;
        case QRMode.MODE_8BIT_BYTE : return 16;
        case QRMode.MODE_KANJI     : return 12;
        default :
          throw 'mode:' + mode;
        }

      } else {
        throw 'type:' + type;
      }
    };

    _this.getLostPoint = function(qrcode) {

      var moduleCount = qrcode.getModuleCount();

      var lostPoint = 0;

      // LEVEL1

      for (var row = 0; row < moduleCount; row += 1) {
        for (var col = 0; col < moduleCount; col += 1) {

          var sameCount = 0;
          var dark = qrcode.isDark(row, col);

          for (var r = -1; r <= 1; r += 1) {

            if (row + r < 0 || moduleCount <= row + r) {
              continue;
            }

            for (var c = -1; c <= 1; c += 1) {

              if (col + c < 0 || moduleCount <= col + c) {
                continue;
              }

              if (r == 0 && c == 0) {
                continue;
              }

              if (dark == qrcode.isDark(row + r, col + c) ) {
                sameCount += 1;
              }
            }
          }

          if (sameCount > 5) {
            lostPoint += (3 + sameCount - 5);
          }
        }
      };

      // LEVEL2

      for (var row = 0; row < moduleCount - 1; row += 1) {
        for (var col = 0; col < moduleCount - 1; col += 1) {
          var count = 0;
          if (qrcode.isDark(row, col) ) count += 1;
          if (qrcode.isDark(row + 1, col) ) count += 1;
          if (qrcode.isDark(row, col + 1) ) count += 1;
          if (qrcode.isDark(row + 1, col + 1) ) count += 1;
          if (count == 0 || count == 4) {
            lostPoint += 3;
          }
        }
      }

      // LEVEL3

      for (var row = 0; row < moduleCount; row += 1) {
        for (var col = 0; col < moduleCount - 6; col += 1) {
          if (qrcode.isDark(row, col)
              && !qrcode.isDark(row, col + 1)
              &&  qrcode.isDark(row, col + 2)
              &&  qrcode.isDark(row, col + 3)
              &&  qrcode.isDark(row, col + 4)
              && !qrcode.isDark(row, col + 5)
              &&  qrcode.isDark(row, col + 6) ) {
            lostPoint += 40;
          }
        }
      }

      for (var col = 0; col < moduleCount; col += 1) {
        for (var row = 0; row < moduleCount - 6; row += 1) {
          if (qrcode.isDark(row, col)
              && !qrcode.isDark(row + 1, col)
              &&  qrcode.isDark(row + 2, col)
              &&  qrcode.isDark(row + 3, col)
              &&  qrcode.isDark(row + 4, col)
              && !qrcode.isDark(row + 5, col)
              &&  qrcode.isDark(row + 6, col) ) {
            lostPoint += 40;
          }
        }
      }

      // LEVEL4

      var darkCount = 0;

      for (var col = 0; col < moduleCount; col += 1) {
        for (var row = 0; row < moduleCount; row += 1) {
          if (qrcode.isDark(row, col) ) {
            darkCount += 1;
          }
        }
      }

      var ratio = Math.abs(100 * darkCount / moduleCount / moduleCount - 50) / 5;
      lostPoint += ratio * 10;

      return lostPoint;
    };

    return _this;
  }();

  //---------------------------------------------------------------------
  // QRMath
  //---------------------------------------------------------------------

  var QRMath = function() {

    var EXP_TABLE = new Array(256);
    var LOG_TABLE = new Array(256);

    // initialize tables
    for (var i = 0; i < 8; i += 1) {
      EXP_TABLE[i] = 1 << i;
    }
    for (var i = 8; i < 256; i += 1) {
      EXP_TABLE[i] = EXP_TABLE[i - 4]
        ^ EXP_TABLE[i - 5]
        ^ EXP_TABLE[i - 6]
        ^ EXP_TABLE[i - 8];
    }
    for (var i = 0; i < 255; i += 1) {
      LOG_TABLE[EXP_TABLE[i] ] = i;
    }

    var _this = {};

    _this.glog = function(n) {

      if (n < 1) {
        throw 'glog(' + n + ')';
      }

      return LOG_TABLE[n];
    };

    _this.gexp = function(n) {

      while (n < 0) {
        n += 255;
      }

      while (n >= 256) {
        n -= 255;
      }

      return EXP_TABLE[n];
    };

    return _this;
  }();

  //---------------------------------------------------------------------
  // qrPolynomial
  //---------------------------------------------------------------------

  function qrPolynomial(num, shift) {

    if (typeof num.length == 'undefined') {
      throw num.length + '/' + shift;
    }

    var _num = function() {
      var offset = 0;
      while (offset < num.length && num[offset] == 0) {
        offset += 1;
      }
      var _num = new Array(num.length - offset + shift);
      for (var i = 0; i < num.length - offset; i += 1) {
        _num[i] = num[i + offset];
      }
      return _num;
    }();

    var _this = {};

    _this.getAt = function(index) {
      return _num[index];
    };

    _this.getLength = function() {
      return _num.length;
    };

    _this.multiply = function(e) {

      var num = new Array(_this.getLength() + e.getLength() - 1);

      for (var i = 0; i < _this.getLength(); i += 1) {
        for (var j = 0; j < e.getLength(); j += 1) {
          num[i + j] ^= QRMath.gexp(QRMath.glog(_this.getAt(i) ) + QRMath.glog(e.getAt(j) ) );
        }
      }

      return qrPolynomial(num, 0);
    };

    _this.mod = function(e) {

      if (_this.getLength() - e.getLength() < 0) {
        return _this;
      }

      var ratio = QRMath.glog(_this.getAt(0) ) - QRMath.glog(e.getAt(0) );

      var num = new Array(_this.getLength() );
      for (var i = 0; i < _this.getLength(); i += 1) {
        num[i] = _this.getAt(i);
      }

      for (var i = 0; i < e.getLength(); i += 1) {
        num[i] ^= QRMath.gexp(QRMath.glog(e.getAt(i) ) + ratio);
      }

      // recursive call
      return qrPolynomial(num, 0).mod(e);
    };

    return _this;
  };

  //---------------------------------------------------------------------
  // QRRSBlock
  //---------------------------------------------------------------------

  var QRRSBlock = function() {

    var RS_BLOCK_TABLE = [

      // L
      // M
      // Q
      // H

      // 1
      [1, 26, 19],
      [1, 26, 16],
      [1, 26, 13],
      [1, 26, 9],

      // 2
      [1, 44, 34],
      [1, 44, 28],
      [1, 44, 22],
      [1, 44, 16],

      // 3
      [1, 70, 55],
      [1, 70, 44],
      [2, 35, 17],
      [2, 35, 13],

      // 4
      [1, 100, 80],
      [2, 50, 32],
      [2, 50, 24],
      [4, 25, 9],

      // 5
      [1, 134, 108],
      [2, 67, 43],
      [2, 33, 15, 2, 34, 16],
      [2, 33, 11, 2, 34, 12],

      // 6
      [2, 86, 68],
      [4, 43, 27],
      [4, 43, 19],
      [4, 43, 15],

      // 7
      [2, 98, 78],
      [4, 49, 31],
      [2, 32, 14, 4, 33, 15],
      [4, 39, 13, 1, 40, 14],

      // 8
      [2, 121, 97],
      [2, 60, 38, 2, 61, 39],
      [4, 40, 18, 2, 41, 19],
      [4, 40, 14, 2, 41, 15],

      // 9
      [2, 146, 116],
      [3, 58, 36, 2, 59, 37],
      [4, 36, 16, 4, 37, 17],
      [4, 36, 12, 4, 37, 13],

      // 10
      [2, 86, 68, 2, 87, 69],
      [4, 69, 43, 1, 70, 44],
      [6, 43, 19, 2, 44, 20],
      [6, 43, 15, 2, 44, 16],

      // 11
      [4, 101, 81],
      [1, 80, 50, 4, 81, 51],
      [4, 50, 22, 4, 51, 23],
      [3, 36, 12, 8, 37, 13],

      // 12
      [2, 116, 92, 2, 117, 93],
      [6, 58, 36, 2, 59, 37],
      [4, 46, 20, 6, 47, 21],
      [7, 42, 14, 4, 43, 15],

      // 13
      [4, 133, 107],
      [8, 59, 37, 1, 60, 38],
      [8, 44, 20, 4, 45, 21],
      [12, 33, 11, 4, 34, 12],

      // 14
      [3, 145, 115, 1, 146, 116],
      [4, 64, 40, 5, 65, 41],
      [11, 36, 16, 5, 37, 17],
      [11, 36, 12, 5, 37, 13],

      // 15
      [5, 109, 87, 1, 110, 88],
      [5, 65, 41, 5, 66, 42],
      [5, 54, 24, 7, 55, 25],
      [11, 36, 12, 7, 37, 13],

      // 16
      [5, 122, 98, 1, 123, 99],
      [7, 73, 45, 3, 74, 46],
      [15, 43, 19, 2, 44, 20],
      [3, 45, 15, 13, 46, 16],

      // 17
      [1, 135, 107, 5, 136, 108],
      [10, 74, 46, 1, 75, 47],
      [1, 50, 22, 15, 51, 23],
      [2, 42, 14, 17, 43, 15],

      // 18
      [5, 150, 120, 1, 151, 121],
      [9, 69, 43, 4, 70, 44],
      [17, 50, 22, 1, 51, 23],
      [2, 42, 14, 19, 43, 15],

      // 19
      [3, 141, 113, 4, 142, 114],
      [3, 70, 44, 11, 71, 45],
      [17, 47, 21, 4, 48, 22],
      [9, 39, 13, 16, 40, 14],

      // 20
      [3, 135, 107, 5, 136, 108],
      [3, 67, 41, 13, 68, 42],
      [15, 54, 24, 5, 55, 25],
      [15, 43, 15, 10, 44, 16],

      // 21
      [4, 144, 116, 4, 145, 117],
      [17, 68, 42],
      [17, 50, 22, 6, 51, 23],
      [19, 46, 16, 6, 47, 17],

      // 22
      [2, 139, 111, 7, 140, 112],
      [17, 74, 46],
      [7, 54, 24, 16, 55, 25],
      [34, 37, 13],

      // 23
      [4, 151, 121, 5, 152, 122],
      [4, 75, 47, 14, 76, 48],
      [11, 54, 24, 14, 55, 25],
      [16, 45, 15, 14, 46, 16],

      // 24
      [6, 147, 117, 4, 148, 118],
      [6, 73, 45, 14, 74, 46],
      [11, 54, 24, 16, 55, 25],
      [30, 46, 16, 2, 47, 17],

      // 25
      [8, 132, 106, 4, 133, 107],
      [8, 75, 47, 13, 76, 48],
      [7, 54, 24, 22, 55, 25],
      [22, 45, 15, 13, 46, 16],

      // 26
      [10, 142, 114, 2, 143, 115],
      [19, 74, 46, 4, 75, 47],
      [28, 50, 22, 6, 51, 23],
      [33, 46, 16, 4, 47, 17],

      // 27
      [8, 152, 122, 4, 153, 123],
      [22, 73, 45, 3, 74, 46],
      [8, 53, 23, 26, 54, 24],
      [12, 45, 15, 28, 46, 16],

      // 28
      [3, 147, 117, 10, 148, 118],
      [3, 73, 45, 23, 74, 46],
      [4, 54, 24, 31, 55, 25],
      [11, 45, 15, 31, 46, 16],

      // 29
      [7, 146, 116, 7, 147, 117],
      [21, 73, 45, 7, 74, 46],
      [1, 53, 23, 37, 54, 24],
      [19, 45, 15, 26, 46, 16],

      // 30
      [5, 145, 115, 10, 146, 116],
      [19, 75, 47, 10, 76, 48],
      [15, 54, 24, 25, 55, 25],
      [23, 45, 15, 25, 46, 16],

      // 31
      [13, 145, 115, 3, 146, 116],
      [2, 74, 46, 29, 75, 47],
      [42, 54, 24, 1, 55, 25],
      [23, 45, 15, 28, 46, 16],

      // 32
      [17, 145, 115],
      [10, 74, 46, 23, 75, 47],
      [10, 54, 24, 35, 55, 25],
      [19, 45, 15, 35, 46, 16],

      // 33
      [17, 145, 115, 1, 146, 116],
      [14, 74, 46, 21, 75, 47],
      [29, 54, 24, 19, 55, 25],
      [11, 45, 15, 46, 46, 16],

      // 34
      [13, 145, 115, 6, 146, 116],
      [14, 74, 46, 23, 75, 47],
      [44, 54, 24, 7, 55, 25],
      [59, 46, 16, 1, 47, 17],

      // 35
      [12, 151, 121, 7, 152, 122],
      [12, 75, 47, 26, 76, 48],
      [39, 54, 24, 14, 55, 25],
      [22, 45, 15, 41, 46, 16],

      // 36
      [6, 151, 121, 14, 152, 122],
      [6, 75, 47, 34, 76, 48],
      [46, 54, 24, 10, 55, 25],
      [2, 45, 15, 64, 46, 16],

      // 37
      [17, 152, 122, 4, 153, 123],
      [29, 74, 46, 14, 75, 47],
      [49, 54, 24, 10, 55, 25],
      [24, 45, 15, 46, 46, 16],

      // 38
      [4, 152, 122, 18, 153, 123],
      [13, 74, 46, 32, 75, 47],
      [48, 54, 24, 14, 55, 25],
      [42, 45, 15, 32, 46, 16],

      // 39
      [20, 147, 117, 4, 148, 118],
      [40, 75, 47, 7, 76, 48],
      [43, 54, 24, 22, 55, 25],
      [10, 45, 15, 67, 46, 16],

      // 40
      [19, 148, 118, 6, 149, 119],
      [18, 75, 47, 31, 76, 48],
      [34, 54, 24, 34, 55, 25],
      [20, 45, 15, 61, 46, 16]
    ];

    var qrRSBlock = function(totalCount, dataCount) {
      var _this = {};
      _this.totalCount = totalCount;
      _this.dataCount = dataCount;
      return _this;
    };

    var _this = {};

    var getRsBlockTable = function(typeNumber, errorCorrectionLevel) {

      switch(errorCorrectionLevel) {
      case QRErrorCorrectionLevel.L :
        return RS_BLOCK_TABLE[(typeNumber - 1) * 4 + 0];
      case QRErrorCorrectionLevel.M :
        return RS_BLOCK_TABLE[(typeNumber - 1) * 4 + 1];
      case QRErrorCorrectionLevel.Q :
        return RS_BLOCK_TABLE[(typeNumber - 1) * 4 + 2];
      case QRErrorCorrectionLevel.H :
        return RS_BLOCK_TABLE[(typeNumber - 1) * 4 + 3];
      default :
        return undefined;
      }
    };

    _this.getRSBlocks = function(typeNumber, errorCorrectionLevel) {

      var rsBlock = getRsBlockTable(typeNumber, errorCorrectionLevel);

      if (typeof rsBlock == 'undefined') {
        throw 'bad rs block @ typeNumber:' + typeNumber +
            '/errorCorrectionLevel:' + errorCorrectionLevel;
      }

      var length = rsBlock.length / 3;

      var list = [];

      for (var i = 0; i < length; i += 1) {

        var count = rsBlock[i * 3 + 0];
        var totalCount = rsBlock[i * 3 + 1];
        var dataCount = rsBlock[i * 3 + 2];

        for (var j = 0; j < count; j += 1) {
          list.push(qrRSBlock(totalCount, dataCount) );
        }
      }

      return list;
    };

    return _this;
  }();

  //---------------------------------------------------------------------
  // qrBitBuffer
  //---------------------------------------------------------------------

  var qrBitBuffer = function() {

    var _buffer = [];
    var _length = 0;

    var _this = {};

    _this.getBuffer = function() {
      return _buffer;
    };

    _this.getAt = function(index) {
      var bufIndex = Math.floor(index / 8);
      return ( (_buffer[bufIndex] >>> (7 - index % 8) ) & 1) == 1;
    };

    _this.put = function(num, length) {
      for (var i = 0; i < length; i += 1) {
        _this.putBit( ( (num >>> (length - i - 1) ) & 1) == 1);
      }
    };

    _this.getLengthInBits = function() {
      return _length;
    };

    _this.putBit = function(bit) {

      var bufIndex = Math.floor(_length / 8);
      if (_buffer.length <= bufIndex) {
        _buffer.push(0);
      }

      if (bit) {
        _buffer[bufIndex] |= (0x80 >>> (_length % 8) );
      }

      _length += 1;
    };

    return _this;
  };

  //---------------------------------------------------------------------
  // qrNumber
  //---------------------------------------------------------------------

  var qrNumber = function(data) {

    var _mode = QRMode.MODE_NUMBER;
    var _data = data;

    var _this = {};

    _this.getMode = function() {
      return _mode;
    };

    _this.getLength = function(buffer) {
      return _data.length;
    };

    _this.write = function(buffer) {

      var data = _data;

      var i = 0;

      while (i + 2 < data.length) {
        buffer.put(strToNum(data.substring(i, i + 3) ), 10);
        i += 3;
      }

      if (i < data.length) {
        if (data.length - i == 1) {
          buffer.put(strToNum(data.substring(i, i + 1) ), 4);
        } else if (data.length - i == 2) {
          buffer.put(strToNum(data.substring(i, i + 2) ), 7);
        }
      }
    };

    var strToNum = function(s) {
      var num = 0;
      for (var i = 0; i < s.length; i += 1) {
        num = num * 10 + chatToNum(s.charAt(i) );
      }
      return num;
    };

    var chatToNum = function(c) {
      if ('0' <= c && c <= '9') {
        return c.charCodeAt(0) - '0'.charCodeAt(0);
      }
      throw 'illegal char :' + c;
    };

    return _this;
  };

  //---------------------------------------------------------------------
  // qrAlphaNum
  //---------------------------------------------------------------------

  var qrAlphaNum = function(data) {

    var _mode = QRMode.MODE_ALPHA_NUM;
    var _data = data;

    var _this = {};

    _this.getMode = function() {
      return _mode;
    };

    _this.getLength = function(buffer) {
      return _data.length;
    };

    _this.write = function(buffer) {

      var s = _data;

      var i = 0;

      while (i + 1 < s.length) {
        buffer.put(
          getCode(s.charAt(i) ) * 45 +
          getCode(s.charAt(i + 1) ), 11);
        i += 2;
      }

      if (i < s.length) {
        buffer.put(getCode(s.charAt(i) ), 6);
      }
    };

    var getCode = function(c) {

      if ('0' <= c && c <= '9') {
        return c.charCodeAt(0) - '0'.charCodeAt(0);
      } else if ('A' <= c && c <= 'Z') {
        return c.charCodeAt(0) - 'A'.charCodeAt(0) + 10;
      } else {
        switch (c) {
        case ' ' : return 36;
        case '$' : return 37;
        case '%' : return 38;
        case '*' : return 39;
        case '+' : return 40;
        case '-' : return 41;
        case '.' : return 42;
        case '/' : return 43;
        case ':' : return 44;
        default :
          throw 'illegal char :' + c;
        }
      }
    };

    return _this;
  };

  //---------------------------------------------------------------------
  // qr8BitByte
  //---------------------------------------------------------------------

  var qr8BitByte = function(data) {

    var _mode = QRMode.MODE_8BIT_BYTE;
    var _data = data;
    var _bytes = qrcode.stringToBytes(data);

    var _this = {};

    _this.getMode = function() {
      return _mode;
    };

    _this.getLength = function(buffer) {
      return _bytes.length;
    };

    _this.write = function(buffer) {
      for (var i = 0; i < _bytes.length; i += 1) {
        buffer.put(_bytes[i], 8);
      }
    };

    return _this;
  };

  //---------------------------------------------------------------------
  // qrKanji
  //---------------------------------------------------------------------

  var qrKanji = function(data) {

    var _mode = QRMode.MODE_KANJI;
    var _data = data;

    var stringToBytes = qrcode.stringToBytesFuncs['SJIS'];
    if (!stringToBytes) {
      throw 'sjis not supported.';
    }
    !function(c, code) {
      // self test for sjis support.
      var test = stringToBytes(c);
      if (test.length != 2 || ( (test[0] << 8) | test[1]) != code) {
        throw 'sjis not supported.';
      }
    }('\u53cb', 0x9746);

    var _bytes = stringToBytes(data);

    var _this = {};

    _this.getMode = function() {
      return _mode;
    };

    _this.getLength = function(buffer) {
      return ~~(_bytes.length / 2);
    };

    _this.write = function(buffer) {

      var data = _bytes;

      var i = 0;

      while (i + 1 < data.length) {

        var c = ( (0xff & data[i]) << 8) | (0xff & data[i + 1]);

        if (0x8140 <= c && c <= 0x9FFC) {
          c -= 0x8140;
        } else if (0xE040 <= c && c <= 0xEBBF) {
          c -= 0xC140;
        } else {
          throw 'illegal char at ' + (i + 1) + '/' + c;
        }

        c = ( (c >>> 8) & 0xff) * 0xC0 + (c & 0xff);

        buffer.put(c, 13);

        i += 2;
      }

      if (i < data.length) {
        throw 'illegal char at ' + (i + 1);
      }
    };

    return _this;
  };

  //=====================================================================
  // GIF Support etc.
  //

  //---------------------------------------------------------------------
  // byteArrayOutputStream
  //---------------------------------------------------------------------

  var byteArrayOutputStream = function() {

    var _bytes = [];

    var _this = {};

    _this.writeByte = function(b) {
      _bytes.push(b & 0xff);
    };

    _this.writeShort = function(i) {
      _this.writeByte(i);
      _this.writeByte(i >>> 8);
    };

    _this.writeBytes = function(b, off, len) {
      off = off || 0;
      len = len || b.length;
      for (var i = 0; i < len; i += 1) {
        _this.writeByte(b[i + off]);
      }
    };

    _this.writeString = function(s) {
      for (var i = 0; i < s.length; i += 1) {
        _this.writeByte(s.charCodeAt(i) );
      }
    };

    _this.toByteArray = function() {
      return _bytes;
    };

    _this.toString = function() {
      var s = '';
      s += '[';
      for (var i = 0; i < _bytes.length; i += 1) {
        if (i > 0) {
          s += ',';
        }
        s += _bytes[i];
      }
      s += ']';
      return s;
    };

    return _this;
  };

  //---------------------------------------------------------------------
  // base64EncodeOutputStream
  //---------------------------------------------------------------------

  var base64EncodeOutputStream = function() {

    var _buffer = 0;
    var _buflen = 0;
    var _length = 0;
    var _base64 = '';

    var _this = {};

    var writeEncoded = function(b) {
      _base64 += String.fromCharCode(encode(b & 0x3f) );
    };

    var encode = function(n) {
      if (n < 0) {
        // error.
      } else if (n < 26) {
        return 0x41 + n;
      } else if (n < 52) {
        return 0x61 + (n - 26);
      } else if (n < 62) {
        return 0x30 + (n - 52);
      } else if (n == 62) {
        return 0x2b;
      } else if (n == 63) {
        return 0x2f;
      }
      throw 'n:' + n;
    };

    _this.writeByte = function(n) {

      _buffer = (_buffer << 8) | (n & 0xff);
      _buflen += 8;
      _length += 1;

      while (_buflen >= 6) {
        writeEncoded(_buffer >>> (_buflen - 6) );
        _buflen -= 6;
      }
    };

    _this.flush = function() {

      if (_buflen > 0) {
        writeEncoded(_buffer << (6 - _buflen) );
        _buffer = 0;
        _buflen = 0;
      }

      if (_length % 3 != 0) {
        // padding
        var padlen = 3 - _length % 3;
        for (var i = 0; i < padlen; i += 1) {
          _base64 += '=';
        }
      }
    };

    _this.toString = function() {
      return _base64;
    };

    return _this;
  };

  //---------------------------------------------------------------------
  // base64DecodeInputStream
  //---------------------------------------------------------------------

  var base64DecodeInputStream = function(str) {

    var _str = str;
    var _pos = 0;
    var _buffer = 0;
    var _buflen = 0;

    var _this = {};

    _this.read = function() {

      while (_buflen < 8) {

        if (_pos >= _str.length) {
          if (_buflen == 0) {
            return -1;
          }
          throw 'unexpected end of file./' + _buflen;
        }

        var c = _str.charAt(_pos);
        _pos += 1;

        if (c == '=') {
          _buflen = 0;
          return -1;
        } else if (c.match(/^\s$/) ) {
          // ignore if whitespace.
          continue;
        }

        _buffer = (_buffer << 6) | decode(c.charCodeAt(0) );
        _buflen += 6;
      }

      var n = (_buffer >>> (_buflen - 8) ) & 0xff;
      _buflen -= 8;
      return n;
    };

    var decode = function(c) {
      if (0x41 <= c && c <= 0x5a) {
        return c - 0x41;
      } else if (0x61 <= c && c <= 0x7a) {
        return c - 0x61 + 26;
      } else if (0x30 <= c && c <= 0x39) {
        return c - 0x30 + 52;
      } else if (c == 0x2b) {
        return 62;
      } else if (c == 0x2f) {
        return 63;
      } else {
        throw 'c:' + c;
      }
    };

    return _this;
  };

  //---------------------------------------------------------------------
  // gifImage (B/W)
  //---------------------------------------------------------------------

  var gifImage = function(width, height) {

    var _width = width;
    var _height = height;
    var _data = new Array(width * height);

    var _this = {};

    _this.setPixel = function(x, y, pixel) {
      _data[y * _width + x] = pixel;
    };

    _this.write = function(out) {

      //---------------------------------
      // GIF Signature

      out.writeString('GIF87a');

      //---------------------------------
      // Screen Descriptor

      out.writeShort(_width);
      out.writeShort(_height);

      out.writeByte(0x80); // 2bit
      out.writeByte(0);
      out.writeByte(0);

      //---------------------------------
      // Global Color Map

      // black
      out.writeByte(0x00);
      out.writeByte(0x00);
      out.writeByte(0x00);

      // white
      out.writeByte(0xff);
      out.writeByte(0xff);
      out.writeByte(0xff);

      //---------------------------------
      // Image Descriptor

      out.writeString(',');
      out.writeShort(0);
      out.writeShort(0);
      out.writeShort(_width);
      out.writeShort(_height);
      out.writeByte(0);

      //---------------------------------
      // Local Color Map

      //---------------------------------
      // Raster Data

      var lzwMinCodeSize = 2;
      var raster = getLZWRaster(lzwMinCodeSize);

      out.writeByte(lzwMinCodeSize);

      var offset = 0;

      while (raster.length - offset > 255) {
        out.writeByte(255);
        out.writeBytes(raster, offset, 255);
        offset += 255;
      }

      out.writeByte(raster.length - offset);
      out.writeBytes(raster, offset, raster.length - offset);
      out.writeByte(0x00);

      //---------------------------------
      // GIF Terminator
      out.writeString(';');
    };

    var bitOutputStream = function(out) {

      var _out = out;
      var _bitLength = 0;
      var _bitBuffer = 0;

      var _this = {};

      _this.write = function(data, length) {

        if ( (data >>> length) != 0) {
          throw 'length over';
        }

        while (_bitLength + length >= 8) {
          _out.writeByte(0xff & ( (data << _bitLength) | _bitBuffer) );
          length -= (8 - _bitLength);
          data >>>= (8 - _bitLength);
          _bitBuffer = 0;
          _bitLength = 0;
        }

        _bitBuffer = (data << _bitLength) | _bitBuffer;
        _bitLength = _bitLength + length;
      };

      _this.flush = function() {
        if (_bitLength > 0) {
          _out.writeByte(_bitBuffer);
        }
      };

      return _this;
    };

    var getLZWRaster = function(lzwMinCodeSize) {

      var clearCode = 1 << lzwMinCodeSize;
      var endCode = (1 << lzwMinCodeSize) + 1;
      var bitLength = lzwMinCodeSize + 1;

      // Setup LZWTable
      var table = lzwTable();

      for (var i = 0; i < clearCode; i += 1) {
        table.add(String.fromCharCode(i) );
      }
      table.add(String.fromCharCode(clearCode) );
      table.add(String.fromCharCode(endCode) );

      var byteOut = byteArrayOutputStream();
      var bitOut = bitOutputStream(byteOut);

      // clear code
      bitOut.write(clearCode, bitLength);

      var dataIndex = 0;

      var s = String.fromCharCode(_data[dataIndex]);
      dataIndex += 1;

      while (dataIndex < _data.length) {

        var c = String.fromCharCode(_data[dataIndex]);
        dataIndex += 1;

        if (table.contains(s + c) ) {

          s = s + c;

        } else {

          bitOut.write(table.indexOf(s), bitLength);

          if (table.size() < 0xfff) {

            if (table.size() == (1 << bitLength) ) {
              bitLength += 1;
            }

            table.add(s + c);
          }

          s = c;
        }
      }

      bitOut.write(table.indexOf(s), bitLength);

      // end code
      bitOut.write(endCode, bitLength);

      bitOut.flush();

      return byteOut.toByteArray();
    };

    var lzwTable = function() {

      var _map = {};
      var _size = 0;

      var _this = {};

      _this.add = function(key) {
        if (_this.contains(key) ) {
          throw 'dup key:' + key;
        }
        _map[key] = _size;
        _size += 1;
      };

      _this.size = function() {
        return _size;
      };

      _this.indexOf = function(key) {
        return _map[key];
      };

      _this.contains = function(key) {
        return typeof _map[key] != 'undefined';
      };

      return _this;
    };

    return _this;
  };

  var createDataURL = function(width, height, getPixel) {
    var gif = gifImage(width, height);
    for (var y = 0; y < height; y += 1) {
      for (var x = 0; x < width; x += 1) {
        gif.setPixel(x, y, getPixel(x, y) );
      }
    }

    var b = byteArrayOutputStream();
    gif.write(b);

    var base64 = base64EncodeOutputStream();
    var bytes = b.toByteArray();
    for (var i = 0; i < bytes.length; i += 1) {
      base64.writeByte(bytes[i]);
    }
    base64.flush();

    return 'data:image/gif;base64,' + base64;
  };

  //---------------------------------------------------------------------
  // returns qrcode function.

  return qrcode;
}();

// multibyte support
!function() {

  qrcode.stringToBytesFuncs['UTF-8'] = function(s) {
    // http://stackoverflow.com/questions/18729405/how-to-convert-utf8-string-to-byte-array
    function toUTF8Array(str) {
      var utf8 = [];
      for (var i=0; i < str.length; i++) {
        var charcode = str.charCodeAt(i);
        if (charcode < 0x80) utf8.push(charcode);
        else if (charcode < 0x800) {
          utf8.push(0xc0 | (charcode >> 6),
              0x80 | (charcode & 0x3f));
        }
        else if (charcode < 0xd800 || charcode >= 0xe000) {
          utf8.push(0xe0 | (charcode >> 12),
              0x80 | ((charcode>>6) & 0x3f),
              0x80 | (charcode & 0x3f));
        }
        // surrogate pair
        else {
          i++;
          // UTF-16 encodes 0x10000-0x10FFFF by
          // subtracting 0x10000 and splitting the
          // 20 bits of 0x0-0xFFFFF into two halves
          charcode = 0x10000 + (((charcode & 0x3ff)<<10)
            | (str.charCodeAt(i) & 0x3ff));
          utf8.push(0xf0 | (charcode >>18),
              0x80 | ((charcode>>12) & 0x3f),
              0x80 | ((charcode>>6) & 0x3f),
              0x80 | (charcode & 0x3f));
        }
      }
      return utf8;
    }
    return toUTF8Array(s);
  };

}();

(function (factory) {
  if (typeof define === 'function' && define.amd) {
      define([], factory);
  } else if (typeof exports === 'object') {
      module.exports = factory();
  }
}(function () {
    return qrcode;
}));

/*
 * Tarayıcı araçları için ortak yardımcılar.
 *
 * Bu dosya sunucuya istek göndermez; tüm yardımcılar dosyanın içinde
 * tanımlıdır ve başka bir dosyaya bağımlılık yoktur.
 */
(function (root, factory) {
    'use strict';

    root.PortfolioTools = root.PortfolioTools || {};
    root.PortfolioTools.common = factory();
}(typeof globalThis !== 'undefined' ? globalThis : this, function () {
    'use strict';

    function formatBytes(bytes) {
        var value = Number(bytes);

        if (!isFinite(value) || value < 0) {
            return '0 B';
        }

        if (value < 1024) {
            return Math.round(value) + ' B';
        }

        if (value < 1024 * 1024) {
            return (value / 1024).toFixed(1).replace('.', ',') + ' KB';
        }

        if (value < 1024 * 1024 * 1024) {
            return (value / (1024 * 1024)).toFixed(1).replace('.', ',') + ' MB';
        }

        return (value / (1024 * 1024 * 1024)).toFixed(2).replace('.', ',') + ' GB';
    }

    function safeFilename(name, fallback) {
        var value = typeof name === 'string' ? name : '';
        value = value.replace(/[\\/:*?"<>|\u0000-\u001f\u007f]/g, '-');
        value = value.replace(/\s+/g, ' ').trim();
        value = value.replace(/^\.+/, '');

        if (value === '') {
            value = typeof fallback === 'string' && fallback !== '' ? fallback : 'dosya';
        }

        if (value.length > 120) {
            value = value.slice(0, 120);
        }

        return value;
    }

    function debounce(callback, wait) {
        var timer = null;

        return function () {
            var args = arguments;
            var context = this;

            if (timer !== null) {
                clearTimeout(timer);
            }

            timer = setTimeout(function () {
                timer = null;
                callback.apply(context, args);
            }, wait);
        };
    }

    function setStatus(element, message, isError) {
        if (!element) {
            return;
        }

        element.textContent = message || '';
        element.classList.toggle('is-error', Boolean(isError));
    }

    function downloadBlob(blob, filename) {
        if (!blob || typeof document === 'undefined') {
            return false;
        }

        var url = URL.createObjectURL(blob);
        var link = document.createElement('a');

        link.href = url;
        link.download = safeFilename(filename, 'indirme');
        link.rel = 'noopener';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        setTimeout(function () {
            URL.revokeObjectURL(url);
        }, 30000);

        return true;
    }

    function downloadText(text, mime, filename) {
        return downloadBlob(new Blob([text], { type: mime + ';charset=utf-8' }), filename);
    }

    function copyText(text) {
        if (typeof navigator !== 'undefined' && navigator.clipboard && typeof navigator.clipboard.writeText === 'function') {
            return navigator.clipboard.writeText(text);
        }

        return new Promise(function (resolve, reject) {
            if (typeof document === 'undefined') {
                reject(new Error('Panoya kopyalama bu ortamda kullanılamıyor.'));
                return;
            }

            var area = document.createElement('textarea');
            area.value = text;
            area.setAttribute('readonly', 'readonly');
            area.className = 'visually-hidden';
            document.body.appendChild(area);
            area.select();

            try {
                var copied = document.execCommand('copy');
                document.body.removeChild(area);

                if (copied) {
                    resolve();
                } else {
                    reject(new Error('Panoya kopyalama tarayıcı tarafından engellendi.'));
                }
            } catch (error) {
                document.body.removeChild(area);
                reject(new Error('Panoya kopyalama bu tarayıcıda desteklenmiyor.'));
            }
        });
    }

    function extensionOf(name) {
        var value = typeof name === 'string' ? name : '';
        var dot = value.lastIndexOf('.');

        return dot > 0 ? value.slice(dot + 1).toLowerCase() : '';
    }

    function baseName(name) {
        var value = typeof name === 'string' ? name : '';
        var dot = value.lastIndexOf('.');

        return dot > 0 ? value.slice(0, dot) : value;
    }

    return {
        formatBytes: formatBytes,
        safeFilename: safeFilename,
        debounce: debounce,
        setStatus: setStatus,
        downloadBlob: downloadBlob,
        downloadText: downloadText,
        copyText: copyText,
        extensionOf: extensionOf,
        baseName: baseName
    };
}));

/*
 * QR Studio — QR kodunu tamamen tarayıcıda üretir.
 *
 * qrcode-generator 1.4.4 (MIT) kullanılır. SVG çıktısı yalnızca modül
 * koordinatları ve doğrulanmış renklerden oluşur; kullanıcı metni SVG'ye
 * yazılmaz. Wi-Fi parolası dahil hiçbir girdi ağa gönderilmez.
 */
(function (root, factory) {
    'use strict';

    root.PortfolioTools = root.PortfolioTools || {};
    root.PortfolioTools.qrStudio = factory(root.qrcode, root.PortfolioTools.common);
}(typeof globalThis !== 'undefined' ? globalThis : this, function (qrcode, common) {
    'use strict';

    var MIN_SIZE = 128;
    var MAX_SIZE = 1024;
    var MAX_MARGIN = 16;
    var MAX_TEXT_LENGTH = 2000;

    function qrError(message) {
        return new Error(message);
    }

    function sanitizeColor(value) {
        var color = String(value || '').trim().toLowerCase();

        if (/^#[0-9a-f]{3}$/.test(color)) {
            color = '#' + color.charAt(1) + color.charAt(1)
                + color.charAt(2) + color.charAt(2)
                + color.charAt(3) + color.charAt(3);
        }

        if (!/^#[0-9a-f]{6}$/.test(color)) {
            throw qrError('Renk değeri #rrggbb biçiminde olmalıdır.');
        }

        return color;
    }

    function hexToRgb(color) {
        var normalized = sanitizeColor(color);
        return {
            r: parseInt(normalized.slice(1, 3), 16),
            g: parseInt(normalized.slice(3, 5), 16),
            b: parseInt(normalized.slice(5, 7), 16)
        };
    }

    function channelLuminance(channel) {
        var value = channel / 255;
        return value <= 0.03928 ? value / 12.92 : Math.pow((value + 0.055) / 1.055, 2.4);
    }

    function relativeLuminance(color) {
        var rgb = hexToRgb(color);
        return 0.2126 * channelLuminance(rgb.r)
            + 0.7152 * channelLuminance(rgb.g)
            + 0.0722 * channelLuminance(rgb.b);
    }

    function contrastRatio(first, second) {
        var one = relativeLuminance(first);
        var two = relativeLuminance(second);
        var lighter = Math.max(one, two);
        var darker = Math.min(one, two);

        return (lighter + 0.05) / (darker + 0.05);
    }

    function escapeWifi(value) {
        return String(value).replace(/([\\;,":])/g, '\\$1');
    }

    function buildWifiPayload(options) {
        var settings = options || {};
        var ssid = String(settings.ssid === undefined ? '' : settings.ssid);
        var password = String(settings.password === undefined ? '' : settings.password);
        var security = settings.security === 'WEP' || settings.security === 'nopass' ? settings.security : 'WPA';

        if (ssid.trim() === '') {
            throw qrError('Wi-Fi ağ adı (SSID) boş olamaz.');
        }

        if (/[\r\n]/.test(ssid) || /[\r\n]/.test(password)) {
            throw qrError('Wi-Fi alanları satır sonu içeremez.');
        }

        if (security !== 'nopass' && password === '') {
            throw qrError('WPA/WEP için Wi-Fi parolası gerekir.');
        }

        var payload = 'WIFI:T:' + security + ';S:' + escapeWifi(ssid) + ';';

        if (security !== 'nopass') {
            payload += 'P:' + escapeWifi(password) + ';';
        }

        if (settings.hidden) {
            payload += 'H:true;';
        }

        return payload + ';';
    }

    function validateUrl(value) {
        var text = String(value === undefined ? '' : value).trim();

        if (text === '') {
            throw qrError('URL boş olamaz.');
        }

        var parsed;

        try {
            parsed = new URL(text);
        } catch (error) {
            throw qrError('URL geçersiz. http:// veya https:// ile başlayan tam bir adres girin.');
        }

        if (parsed.protocol !== 'http:' && parsed.protocol !== 'https:') {
            throw qrError('Yalnızca http:// ve https:// URL’leri kabul edilir.');
        }

        return text;
    }

    function payloadFor(type, data) {
        var settings = data || {};
        var payload;

        if (type === 'url') {
            payload = validateUrl(settings.url);
        } else if (type === 'wifi') {
            payload = buildWifiPayload(settings);
        } else {
            payload = String(settings.text === undefined ? '' : settings.text);

            if (payload.trim() === '') {
                throw qrError('QR kodu için metin boş olamaz.');
            }
        }

        if (payload.length > MAX_TEXT_LENGTH) {
            throw qrError('Girdi çok uzun. En fazla ' + MAX_TEXT_LENGTH + ' karakter desteklenir.');
        }

        return payload;
    }

    function buildMatrix(text, ecc) {
        if (!qrcode || typeof qrcode !== 'function') {
            throw qrError('QR kod kütüphanesi yüklenemedi.');
        }

        var level = ['L', 'M', 'Q', 'H'].indexOf(String(ecc).toUpperCase()) === -1
            ? 'M'
            : String(ecc).toUpperCase();

        qrcode.stringToBytes = qrcode.stringToBytesFuncs['UTF-8'];

        try {
            var qr = qrcode(0, level);
            qr.addData(text, 'Byte');
            qr.make();
            var count = qr.getModuleCount();
            var matrix = [];

            for (var row = 0; row < count; row += 1) {
                var line = [];

                for (var column = 0; column < count; column += 1) {
                    line.push(qr.isDark(row, column));
                }

                matrix.push(line);
            }

            return matrix;
        } catch (error) {
            throw qrError('Girdi QR kapasitesini aşıyor. Metni kısaltın veya daha düşük hata düzeltme seviyesi seçin.');
        }
    }

    function normalizeOptions(options) {
        var settings = options || {};
        var size = Math.round(Number(settings.size));
        var margin = Math.round(Number(settings.margin));

        if (!isFinite(size)) {
            size = 256;
        }

        if (!isFinite(margin)) {
            margin = 4;
        }

        size = Math.max(MIN_SIZE, Math.min(MAX_SIZE, size));
        margin = Math.max(0, Math.min(MAX_MARGIN, margin));

        return {
            size: size,
            margin: margin,
            foreground: sanitizeColor(settings.foreground || '#282828'),
            background: sanitizeColor(settings.background || '#fbf7ed')
        };
    }

    function geometry(matrix, options) {
        var settings = normalizeOptions(options);
        var totalModules = matrix.length + settings.margin * 2;
        var cellSize = Math.max(1, Math.floor(settings.size / totalModules));

        return {
            settings: settings,
            totalModules: totalModules,
            cellSize: cellSize,
            actualSize: totalModules * cellSize
        };
    }

    function buildSvg(matrix, options) {
        var result = geometry(matrix, options);
        var settings = result.settings;
        var parts = [];

        for (var row = 0; row < matrix.length; row += 1) {
            for (var column = 0; column < matrix[row].length; column += 1) {
                if (matrix[row][column]) {
                    var x = (column + settings.margin) * result.cellSize;
                    var y = (row + settings.margin) * result.cellSize;
                    parts.push('M' + x + ' ' + y + 'h' + result.cellSize + 'v' + result.cellSize
                        + 'h-' + result.cellSize + 'z');
                }
            }
        }

        var svg = '<svg xmlns="http://www.w3.org/2000/svg" width="' + result.actualSize
            + '" height="' + result.actualSize + '" viewBox="0 0 ' + result.actualSize + ' '
            + result.actualSize + '" role="img" aria-label="QR kodu">'
            + '<title>QR kodu</title>'
            + '<rect width="' + result.actualSize + '" height="' + result.actualSize
            + '" fill="' + settings.background + '"/>'
            + '<path d="' + parts.join('') + '" fill="' + settings.foreground + '"/>'
            + '</svg>';

        return {
            svg: svg,
            size: result.actualSize,
            cellSize: result.cellSize
        };
    }

    function renderCanvas(canvas, matrix, options) {
        var result = geometry(matrix, options);
        var settings = result.settings;

        canvas.width = result.actualSize;
        canvas.height = result.actualSize;
        var context = canvas.getContext('2d');

        if (!context) {
            throw qrError('QR önizlemesi için canvas bağlamı oluşturulamadı.');
        }

        context.fillStyle = settings.background;
        context.fillRect(0, 0, result.actualSize, result.actualSize);
        context.fillStyle = settings.foreground;

        for (var row = 0; row < matrix.length; row += 1) {
            for (var column = 0; column < matrix[row].length; column += 1) {
                if (matrix[row][column]) {
                    context.fillRect(
                        (column + settings.margin) * result.cellSize,
                        (row + settings.margin) * result.cellSize,
                        result.cellSize,
                        result.cellSize
                    );
                }
            }
        }

        return {
            size: result.actualSize,
            cellSize: result.cellSize
        };
    }

    function init() {
        if (typeof document === 'undefined') {
            return;
        }

        var tool = document.querySelector('[data-qr-tool]');

        if (!tool) {
            return;
        }

        var typeSelect = document.getElementById('qr-type');
        var textInput = document.getElementById('qr-text');
        var urlInput = document.getElementById('qr-url');
        var ssidInput = document.getElementById('qr-ssid');
        var passwordInput = document.getElementById('qr-password');
        var securitySelect = document.getElementById('qr-security');
        var hiddenInput = document.getElementById('qr-hidden');
        var sizeInput = document.getElementById('qr-size');
        var marginInput = document.getElementById('qr-margin');
        var eccSelect = document.getElementById('qr-ecc');
        var foregroundInput = document.getElementById('qr-foreground');
        var backgroundInput = document.getElementById('qr-background');
        var canvas = document.getElementById('qr-preview');
        var status = document.querySelector('[data-qr-status]');
        var warning = document.querySelector('[data-qr-warning]');
        var sizeNote = document.querySelector('[data-qr-size-note]');
        var pngButton = document.querySelector('[data-qr-png]');
        var svgButton = document.querySelector('[data-qr-svg]');
        var clearButton = document.querySelector('[data-qr-clear]');
        var fields = Array.prototype.slice.call(document.querySelectorAll('[data-qr-fields]'));

        if (!typeSelect || !canvas || !status) {
            return;
        }

        var matrix = null;
        var lastPayload = '';
        var timer = null;

        function setStatus(message, isError) {
            status.textContent = message || '';
            status.classList.toggle('is-error', Boolean(isError));
        }

        function setWarning(message) {
            if (!warning) {
                return;
            }

            warning.textContent = message || '';
            warning.hidden = !message;
        }

        function updateFields() {
            fields.forEach(function (field) {
                field.hidden = field.getAttribute('data-qr-fields') !== typeSelect.value;
            });

            if (textInput) {
                textInput.required = typeSelect.value === 'text';
            }
            if (urlInput) {
                urlInput.required = typeSelect.value === 'url';
            }
            if (ssidInput) {
                ssidInput.required = typeSelect.value === 'wifi';
            }
            if (passwordInput) {
                passwordInput.disabled = typeSelect.value === 'wifi' && securitySelect && securitySelect.value === 'nopass';
                passwordInput.required = typeSelect.value === 'wifi' && securitySelect && securitySelect.value !== 'nopass';
            }
        }

        function clearPreview() {
            matrix = null;
            lastPayload = '';
            canvas.width = 1;
            canvas.height = 1;
            if (pngButton) {
                pngButton.disabled = true;
            }
            if (svgButton) {
                svgButton.disabled = true;
            }
            if (sizeNote) {
                sizeNote.textContent = '';
            }
            setWarning('');
        }

        function dataForType() {
            return {
                text: textInput ? textInput.value : '',
                url: urlInput ? urlInput.value : '',
                ssid: ssidInput ? ssidInput.value : '',
                password: passwordInput ? passwordInput.value : '',
                security: securitySelect ? securitySelect.value : 'WPA',
                hidden: hiddenInput ? hiddenInput.checked : false
            };
        }

        function generate() {
            updateFields();

            var data = dataForType();
            var type = typeSelect.value;
            var empty = (type === 'text' && data.text.trim() === '')
                || (type === 'url' && data.url.trim() === '')
                || (type === 'wifi' && data.ssid.trim() === '');

            if (empty) {
                clearPreview();
                setStatus(type === 'wifi'
                    ? 'QR üretmek için Wi-Fi ağ adını girin.'
                    : 'QR üretmek için bir ' + (type === 'url' ? 'URL' : 'metin') + ' girin.');
                return;
            }

            try {
                lastPayload = payloadFor(type, data);
                matrix = buildMatrix(lastPayload, eccSelect ? eccSelect.value : 'M');
                var rendered = renderCanvas(canvas, matrix, {
                    size: sizeInput ? sizeInput.value : 256,
                    margin: marginInput ? marginInput.value : 4,
                    foreground: foregroundInput ? foregroundInput.value : '#282828',
                    background: backgroundInput ? backgroundInput.value : '#fbf7ed'
                });

                if (pngButton) {
                    pngButton.disabled = false;
                }
                if (svgButton) {
                    svgButton.disabled = false;
                }
                if (sizeNote) {
                    sizeNote.textContent = 'Gerçek çıktı: ' + rendered.size + ' × ' + rendered.size
                        + ' piksel · modül başına ' + rendered.cellSize + ' piksel.';
                }

                var ratio = contrastRatio(
                    foregroundInput ? foregroundInput.value : '#282828',
                    backgroundInput ? backgroundInput.value : '#fbf7ed'
                );
                var foregroundLuminance = relativeLuminance(foregroundInput ? foregroundInput.value : '#282828');
                var backgroundLuminance = relativeLuminance(backgroundInput ? backgroundInput.value : '#fbf7ed');

                if (foregroundLuminance >= backgroundLuminance) {
                    setWarning('Ön plan rengi arka plandan daha koyu olmalı. QR okuyucular bu renklerle okuyamayabilir.');
                } else if (ratio < 3) {
                    setWarning('Renk kontrastı düşük (' + ratio.toFixed(2) + ':1). En az 3:1 önerilir; QR okunabilirliği azalabilir.');
                } else {
                    setWarning('');
                }

                setStatus('QR kodu hazır. Girdi yalnızca bu sayfada işlendi.');
            } catch (error) {
                clearPreview();
                setStatus(error.message, true);
            }
        }

        function scheduleGenerate() {
            if (timer !== null) {
                clearTimeout(timer);
            }

            timer = setTimeout(function () {
                timer = null;
                generate();
            }, 120);
        }

        typeSelect.addEventListener('change', function () {
            updateFields();
            scheduleGenerate();
        });

        if (securitySelect) {
            securitySelect.addEventListener('change', function () {
                updateFields();
                scheduleGenerate();
            });
        }

        [textInput, urlInput, ssidInput, passwordInput, hiddenInput, sizeInput, marginInput, eccSelect, foregroundInput, backgroundInput].forEach(function (element) {
            if (element) {
                element.addEventListener('input', scheduleGenerate);
                element.addEventListener('change', scheduleGenerate);
            }
        });

        function downloadPng() {
            if (!matrix) {
                setStatus('Önce geçerli bir QR kodu üretin.', true);
                return;
            }

            canvas.toBlob(function (blob) {
                if (!blob || blob.type !== 'image/png') {
                    setStatus('PNG çıktısı oluşturulamadı.', true);
                    return;
                }

                common.downloadBlob(blob, 'qr-kod.png');
                setStatus('PNG indirildi.');
            }, 'image/png');
        }

        function downloadSvg() {
            if (!matrix) {
                setStatus('Önce geçerli bir QR kodu üretin.', true);
                return;
            }

            try {
                var built = buildSvg(matrix, {
                    size: sizeInput ? sizeInput.value : 256,
                    margin: marginInput ? marginInput.value : 4,
                    foreground: foregroundInput ? foregroundInput.value : '#282828',
                    background: backgroundInput ? backgroundInput.value : '#fbf7ed'
                });
                var blob = new Blob([built.svg], { type: 'image/svg+xml;charset=utf-8' });
                common.downloadBlob(blob, 'qr-kod.svg');
                setStatus('SVG indirildi.');
            } catch (error) {
                setStatus(error.message, true);
            }
        }

        if (pngButton) {
            pngButton.addEventListener('click', downloadPng);
        }

        if (svgButton) {
            svgButton.addEventListener('click', downloadSvg);
        }

        if (clearButton) {
            clearButton.addEventListener('click', function () {
                [textInput, urlInput, ssidInput, passwordInput].forEach(function (field) {
                    if (field) {
                        field.value = '';
                    }
                });
                if (hiddenInput) {
                    hiddenInput.checked = false;
                }
                clearPreview();
                setStatus('Girdiler temizlendi.');
                if (typeSelect.value === 'wifi' && ssidInput) {
                    ssidInput.focus();
                } else if (typeSelect.value === 'url' && urlInput) {
                    urlInput.focus();
                } else if (textInput) {
                    textInput.focus();
                }
            });
        }

        updateFields();
        clearPreview();
        setStatus('QR üretmek için bir tür seçip girdiyi doldurun.');
    }

    if (typeof document !== 'undefined') {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    }

    return {
        MIN_SIZE: MIN_SIZE,
        MAX_SIZE: MAX_SIZE,
        MAX_MARGIN: MAX_MARGIN,
        MAX_TEXT_LENGTH: MAX_TEXT_LENGTH,
        sanitizeColor: sanitizeColor,
        hexToRgb: hexToRgb,
        relativeLuminance: relativeLuminance,
        contrastRatio: contrastRatio,
        escapeWifi: escapeWifi,
        buildWifiPayload: buildWifiPayload,
        validateUrl: validateUrl,
        payloadFor: payloadFor,
        buildMatrix: buildMatrix,
        normalizeOptions: normalizeOptions,
        geometry: geometry,
        buildSvg: buildSvg,
        renderCanvas: renderCanvas
    };
}));

</script>
</body>
</html>
