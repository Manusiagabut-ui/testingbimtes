<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" type="image/png" href="{{ asset('images/logo-bimtes.png') }}" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no"
    />
    <title>CBT BIMTES Universal 2026</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <style>
      *,
      *::before,
      *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }
      :root {
        --bg: #0d0f18;
        --surface: #161927;
        --surface2: #1e2235;
        --surface3: #252a42;
        --border: rgba(255, 255, 255, 0.07);
        --border2: rgba(255, 255, 255, 0.13);
        --border3: rgba(255, 255, 255, 0.22);
        --primary: #5b5ef4;
        --primary-dark: #4a4dd4;
        --primary-light: rgba(91, 94, 244, 0.15);
        --accent2: #7b7ef7;
        --accent-glow: rgba(91, 94, 244, 0.18);
        --success: #22c55e;
        --danger: #ef4444;
        --warning: #f59e0b;
        --text: #eef0f8;
        --text2: #8b8fa8;
        --text3: #4a4e6a;
        --radius: 12px;
        --radius-sm: 8px;
        --font: "Plus Jakarta Sans", sans-serif;
        --mono: "JetBrains Mono", monospace;
        /* compat aliases for original JS */
        --gray-50: var(--bg);
        --gray-100: var(--surface);
        --gray-200: var(--border2);
        --gray-300: var(--border3);
        --gray-400: var(--text3);
        --gray-500: var(--text2);
        --gray-600: var(--text2);
        --gray-700: var(--text);
        --gray-800: var(--surface2);
        --gray-900: var(--text);
        --shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.4);
        --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.5);
      }
      body {
        font-family: var(--font);
        background: var(--bg);
        color: var(--text);
        min-height: 100vh;
        overflow-x: hidden;
      }
      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(12px);
        }
        to {
          opacity: 1;
          transform: none;
        }
      }
      @keyframes pulse {
        0%,
        100% {
          opacity: 1;
        }
        50% {
          opacity: 0.3;
        }
      }

      .screen {
        display: none;
        min-height: 100vh;
      }
      .screen.active {
        display: block;
      }

      /* ══ LOGIN ══ */
      .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
        background:
          radial-gradient(
            ellipse 80% 60% at 50% -10%,
            rgba(91, 94, 244, 0.2),
            transparent
          ),
          var(--bg);
      }
      .login-card {
        background: var(--surface);
        border: 1px solid var(--border2);
        border-radius: 24px;
        padding: 44px;
        width: 100%;
        max-width: 480px;
        box-shadow: var(--shadow-lg);
        animation: fadeIn 0.4s ease;
      }
      .logo-area {
        text-align: center;
        margin-bottom: 32px;
      }
      .logo-icon {
        font-size: 48px;
        margin-bottom: 14px;
        display: block;
      }
      .logo-area h1 {
        font-size: 26px;
        font-weight: 800;
        letter-spacing: -0.8px;
        background: linear-gradient(135deg, var(--primary), var(--accent2));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
      }
      .logo-area p {
        color: var(--text2);
        font-size: 14px;
        margin-top: 4px;
      }

      .form-group {
        margin-bottom: 18px;
      }
      .form-group label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: var(--text2);
        margin-bottom: 7px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }
      .form-group input {
        width: 100%;
        background: var(--bg);
        border: 1.5px solid var(--border2);
        border-radius: 10px;
        padding: 13px 15px;
        color: var(--text);
        font-family: var(--font);
        font-size: 15px;
        outline: none;
        transition: border-color 0.2s;
      }
      .form-group input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--accent-glow);
      }
      .form-group input::placeholder {
        color: var(--text3);
      }

      .info-grid-login {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin: 22px 0;
        padding: 0;
        background: transparent;
        border-radius: 0;
      }
      .info-item {
        background: var(--surface2);
        border: 1px solid var(--border2);
        border-radius: 10px;
        padding: 14px;
        text-align: center;
      }
      .info-label {
        font-size: 11px;
        font-weight: 700;
        color: var(--text2);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
      }
      .info-value {
        font-size: 20px;
        font-weight: 800;
        color: var(--primary);
      }

      .btn {
        width: 100%;
        padding: 15px;
        border: none;
        border-radius: 11px;
        font-size: 15px;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.15s;
        font-family: var(--font);
      }
      .btn-primary {
        background: var(--primary);
        color: #fff;
        letter-spacing: -0.2px;
      }
      .btn-primary:hover {
        background: var(--accent2);
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(91, 94, 244, 0.4);
      }
      .btn-primary:active {
        transform: scale(0.98);
      }

      /* ══ EXAM HEADER ══ */
      #examScreen {
        display: none;
        flex-direction: column;
      }
      #examScreen.active {
        display: flex;
      }

      .exam-header {
        background: var(--surface);
        border-bottom: 1px solid var(--border);
        padding: 0 24px;
        height: 62px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 100;
        flex-shrink: 0;
        flex-wrap: nowrap;
        gap: 12px;
      }
      .session-info {
        display: flex;
        align-items: center;
        gap: 12px;
      }
      .session-badge {
        background: var(--accent-glow);
        border: 1px solid rgba(91, 94, 244, 0.3);
        border-radius: 7px;
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 700;
        color: var(--accent2);
        font-family: var(--mono);
        white-space: nowrap;
      }
      .session-name {
        font-size: 14px;
        font-weight: 700;
        color: var(--text);
        letter-spacing: -0.2px;
      }

      .timer {
        font-family: var(--mono);
        font-size: 20px;
        font-weight: 700;
        letter-spacing: 2px;
        color: var(--text);
        background: var(--bg);
        border: 1.5px solid var(--border2);
        border-radius: 9px;
        padding: 8px 14px;
        transition: all 0.3s;
        min-width: 80px;
        text-align: center;
      }
      .timer.urgent {
        border-color: rgba(239, 68, 68, 0.5);
        background: rgba(239, 68, 68, 0.08);
        color: var(--danger);
        animation: pulse 0.7s ease-in-out infinite;
      }
      .timer.done-mode {
        border-color: rgba(245, 158, 11, 0.4);
        background: rgba(245, 158, 11, 0.08);
        color: var(--warning);
      }

      .toolbar-btn {
        background: var(--surface2);
        border: 1px solid var(--border2);
        border-radius: 8px;
        color: var(--text2);
        cursor: pointer;
        padding: 8px 12px;
        font-size: 13px;
        transition: all 0.15s;
        font-family: var(--font);
        white-space: nowrap;
      }
      .toolbar-btn:hover {
        background: var(--surface3);
        color: var(--text);
        border-color: var(--border3);
      }

      /* ══ PROGRESS BAR ══ */
      .progress-bar {
        height: 3px;
        background: var(--border);
        flex-shrink: 0;
      }
      .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary), var(--accent2));
        transition: width 0.4s ease;
      }

      /* ══ TOOLBAR ══ */
      .toolbar {
        background: var(--surface2);
        border-bottom: 1px solid var(--border);
        padding: 8px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
      }
      .font-control {
        display: flex;
        align-items: center;
        gap: 8px;
      }
      .font-control button {
        background: var(--surface3);
        border: 1px solid var(--border2);
        border-radius: 6px;
        color: var(--text2);
        cursor: pointer;
        padding: 4px 10px;
        font-size: 13px;
        font-weight: 700;
        transition: all 0.15s;
        font-family: var(--mono);
      }
      .font-control button:hover {
        color: var(--text);
        background: var(--surface);
      }
      .font-control span {
        color: var(--text2);
      }

      #endSessionBtn {
        margin-left: auto;
        background: transparent;
        border: 1.5px solid rgba(239, 68, 68, 0.35);
        color: var(--danger);
        border-radius: 8px;
        padding: 7px 14px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.15s;
        font-family: var(--font);
      }
      #endSessionBtn:hover {
        background: rgba(239, 68, 68, 0.1);
        border-color: var(--danger);
      }

      /* ══ EXAM MAIN LAYOUT ══ */
      .exam-main {
        flex: 1;
        display: flex;
        min-height: 0;
        position: relative;
      }

      /* ══ QUESTION PANEL ══ */
      .question-panel {
        flex: 1;
        padding: 32px 36px 100px;
        overflow-y: auto;
        max-width: 760px;
      }
      .question-text {
  font-size: 17px;
  font-weight: 500;
  line-height: 1.7;
  margin-bottom: 28px;
  color: var(--text);
  letter-spacing: -0.1px;
  white-space: pre-line;  
}
      .question-image {
      display: block;
      max-width: 100%;
      height: auto;
      border-radius: var(--radius-sm);
      border: 1px solid var(--border2);
      margin-top: 16px;
      }
   bdi[dir="rtl"] {
  font-family: 'Traditional Arabic', 'Amiri', 'Scheherazade New', serif;
  font-size: 1.15em;
  unicode-bidi: isolate;
}
      .options-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
      }

      .option-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        background: var(--surface);
        border: 1.5px solid var(--border);
        border-radius: 13px;
        padding: 16px 18px;
        cursor: pointer;
        transition: all 0.15s;
        user-select: none;
      }
      .option-item:hover {
        border-color: var(--border2);
        background: var(--surface2);
      }
      .option-item.selected {
        border-color: var(--primary);
        background: rgba(91, 94, 244, 0.1);
      }
      .option-item.flagged {
        border-color: var(--warning);
        background: rgba(245, 158, 11, 0.08);
      }
      .option-item.selected.flagged {
        border-color: var(--primary);
        background: rgba(91, 94, 244, 0.1);
      }

      .option-letter {
        width: 32px;
        height: 32px;
        border: 1.5px solid var(--border2);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        color: var(--text2);
        flex-shrink: 0;
        transition: all 0.15s;
        font-family: var(--mono);
      }
      .option-item.selected .option-letter {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
      }
      .option-text {
        font-size: 15px;
        line-height: 1.55;
        padding-top: 5px;
        color: var(--text);
      }

      /* ══ SIDEBAR ══ */
      .sidebar {
        width: 280px;
        background: var(--surface);
        border-left: 1px solid var(--border);
        padding: 22px 18px;
        overflow-y: auto;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        gap: 0;
        position: relative;
        transition: all 0.3s;
      }
      .sidebar-close {
        display: none;
        position: absolute;
        top: 12px;
        right: 12px;
        background: transparent;
        border: none;
        color: var(--text2);
        font-size: 18px;
        cursor: pointer;
        padding: 4px;
      }
      .sidebar-section {
        margin-bottom: 20px;
      }
      .sidebar-section h3 {
        font-size: 11px;
        font-weight: 700;
        color: var(--text2);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 12px;
      }

      .question-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 6px;
        margin-bottom: 0;
      }
      .grid-item {
        aspect-ratio: 1;
        border-radius: 7px;
        border: 1.5px solid var(--border2);
        background: var(--bg);
        color: var(--text2);
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.15s;
        font-family: var(--mono);
      }
      .grid-item:hover {
        border-color: var(--primary);
        color: var(--primary);
      }
      .grid-item.answered {
        background: rgba(91, 94, 244, 0.15);
        border-color: var(--primary);
        color: var(--accent2);
      }
      .grid-item.current {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
      }
      .grid-item.flagged {
        background: rgba(245, 158, 11, 0.15);
        border-color: var(--warning);
        color: var(--warning);
      }
      .grid-item.answered.flagged {
        background: rgba(245, 158, 11, 0.15);
        border-color: var(--warning);
        color: var(--warning);
      }

      .stats {
        display: flex;
        flex-direction: column;
        gap: 8px;
      }
      .stat-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        color: var(--text2);
      }
      .stat-value {
        font-weight: 700;
        font-family: var(--mono);
        color: var(--text);
      }
      .stat-value.answered {
        color: var(--success);
      }
      .stat-value.unanswered {
        color: var(--danger);
      }
      .stat-value.flagged {
        color: var(--warning);
      }

      .btn-flag {
        width: 100%;
        margin-top: 12px;
        background: transparent;
        border: 1.5px solid var(--border2);
        border-radius: 8px;
        padding: 9px;
        font-family: var(--font);
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        color: var(--text2);
        transition: all 0.15s;
      }
      .btn-flag:hover {
        border-color: var(--warning);
        color: var(--warning);
        background: rgba(245, 158, 11, 0.08);
      }

      .nav-buttons {
        display: flex;
        gap: 8px;
        margin-top: auto;
        padding-top: 16px;
        border-top: 1px solid var(--border);
      }
      .btn-nav {
        flex: 1;
        background: var(--surface2);
        border: 1.5px solid var(--border2);
        border-radius: 9px;
        padding: 11px;
        color: var(--text);
        font-family: var(--font);
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.15s;
      }
      .btn-nav:hover {
        background: var(--surface3);
        border-color: var(--border3);
      }
      #nextBtn {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
      }
      #nextBtn:hover {
        background: var(--accent2);
      }

      /* ══ MOBILE DRAWER ══ */
      .drawer-toggle {
        display: none;
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 200;
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: var(--primary);
        color: #fff;
        border: none;
        font-size: 20px;
        cursor: pointer;
        box-shadow: 0 4px 16px rgba(91, 94, 244, 0.5);
        align-items: center;
        justify-content: center;
        transition: all 0.15s;
      }
      .drawer-toggle:hover {
        background: var(--accent2);
        transform: scale(1.05);
      }

      .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(3px);
        z-index: 150;
      }

      /* ══ SUMMARY & FINAL ══ */
      .summary-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px 24px;
        background:
          radial-gradient(
            ellipse 60% 50% at 50% 0%,
            rgba(91, 94, 244, 0.12),
            transparent
          ),
          var(--bg);
      }
      .summary-card {
        background: var(--surface);
        border: 1px solid var(--border2);
        border-radius: 24px;
        padding: 40px;
        width: 100%;
        max-width: 540px;
        animation: fadeIn 0.4s ease;
      }

      /* session summary inner styles */
      .sum-progress-bar {
        display: flex;
        align-items: center;
        gap: 5px;
        justify-content: center;
        margin-bottom: 20px;
      }
      .sum-progress-bar .spb-item {
        height: 5px;
        border-radius: 3px;
        flex: 1;
        background: var(--border);
        transition: background 0.4s;
      }
      .sum-progress-bar .spb-item.done {
        background: var(--success);
      }
      .sum-progress-bar .spb-item.active {
        background: var(--primary);
      }

      .sum-header {
        text-align: center;
        margin-bottom: 22px;
      }
      .sum-session-label {
        font-size: 12px;
        font-weight: 700;
        color: var(--accent2);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 6px;
      }
      .sum-session-name {
        font-size: 22px;
        font-weight: 800;
        letter-spacing: -0.5px;
        margin-bottom: 4px;
        color: var(--text);
      }
      .sum-sub {
        font-size: 14px;
        color: var(--text2);
        line-height: 1.6;
      }

      .sum-stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 18px;
      }
      .sum-stat {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 14px;
        text-align: center;
      }
      .sum-stat-val {
        font-size: 28px;
        font-weight: 800;
        font-family: var(--mono);
        margin-bottom: 4px;
      }
      .sum-stat-label {
        font-size: 12px;
        color: var(--text2);
      }
      .sum-stat.c .sum-stat-val {
        color: var(--success);
      }
      .sum-stat.w .sum-stat-val {
        color: var(--danger);
      }
      .sum-stat.s .sum-stat-val {
        color: var(--warning);
      }

      .sdivider {
        height: 1px;
        background: var(--border);
        margin: 18px 0;
      }
      .sum-answer-label {
        font-size: 11px;
        font-weight: 700;
        color: var(--text2);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 10px;
      }
      .sum-answer-list {
        max-height: 260px;
        overflow-y: auto;
        margin-bottom: 20px;
      }
      .sum-answer-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        padding: 8px 0;
        border-bottom: 1px solid var(--border);
      }
      .sum-answer-item:last-child {
        border: none;
      }
      .sai-num {
        font-family: var(--mono);
        font-weight: 700;
        color: var(--text2);
        min-width: 56px;
      }

      .btn-next-session {
        width: 100%;
        background: var(--success);
        color: #fff;
        border: none;
        border-radius: 11px;
        padding: 15px;
        font-family: var(--font);
        font-size: 15px;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.15s;
      }
      .btn-next-session:hover {
        filter: brightness(1.1);
        transform: translateY(-1px);
      }
      .btn-next-session.last {
        background: var(--primary);
      }

      /* done screen table */
      .done-header {
        text-align: center;
        margin-bottom: 20px;
      }
      .done-icon {
        font-size: 52px;
        margin-bottom: 14px;
        display: block;
      }
      .done-title {
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -0.8px;
        margin-bottom: 6px;
      }
      .done-sub {
        font-size: 15px;
        color: var(--text2);
        line-height: 1.6;
      }
      .done-note {
        background: rgba(91, 94, 244, 0.1);
        border: 1px solid rgba(91, 94, 244, 0.2);
        border-radius: 12px;
        padding: 14px;
        font-size: 13px;
        color: var(--accent2);
        line-height: 1.6;
        margin-bottom: 20px;
      }
      .done-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 13px;
        text-align: left;
      }
      .done-table th {
        font-size: 11px;
        font-weight: 700;
        color: var(--text2);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 8px 12px;
        border-bottom: 1px solid var(--border2);
      }
      .done-table td {
        padding: 10px 12px;
        border-bottom: 1px solid var(--border);
      }
      .done-table tr:last-child td {
        border-bottom: none;
      }
      .done-table .td-score {
        font-family: var(--mono);
        font-weight: 700;
        color: var(--success);
        text-align: right;
      }
      .btn-done {
        width: 100%;
        background: var(--surface2);
        border: 1.5px solid var(--border2);
        border-radius: 11px;
        padding: 13px;
        font-family: var(--font);
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        color: var(--text);
        transition: all 0.15s;
      }
      .btn-done:hover {
        background: var(--surface3);
      }

      /* ══ MODAL ══ */
      .modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(4px);
        align-items: center;
        justify-content: center;
        z-index: 300;
      }
      .modal.active,
      .modal[style*="flex"] {
        display: flex;
      }
      .modal-content {
        background: var(--surface);
        border: 1px solid var(--border2);
        border-radius: 20px;
        padding: 36px;
        max-width: 380px;
        width: 90%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        animation: fadeIn 0.25s ease;
      }
      .modal-content h3 {
        font-size: 20px;
        font-weight: 800;
        margin-bottom: 10px;
      }
      .modal-content p {
        font-size: 14px;
        color: var(--text2);
        line-height: 1.6;
        margin-bottom: 24px;
      }
      .modal-buttons {
        display: flex;
        gap: 10px;
      }
      .modal-btn {
        flex: 1;
        padding: 12px;
        border-radius: 9px;
        font-family: var(--font);
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        border: none;
        transition: all 0.15s;
      }
      .modal-btn-cancel {
        background: var(--surface2);
        color: var(--text);
        border: 1.5px solid var(--border2);
      }
      .modal-btn-cancel:hover {
        background: var(--surface3);
      }
      .modal-btn-confirm {
        background: var(--primary);
        color: #fff;
      }
      .modal-btn-confirm:hover {
        background: var(--accent2);
      }

      /* ══ WAIT OVERLAY — centered full screen ══ */
      .wait-overlay,
      .all-done-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(13, 15, 24, 0.88);
        backdrop-filter: blur(6px);
        align-items: center;
        justify-content: center;
        z-index: 250;
      }
      .wait-overlay.active,
      .all-done-overlay.active {
        display: flex;
      }
      .wait-card {
        background: var(--surface);
        border: 1px solid var(--border2);
        border-radius: 20px;
        padding: 40px;
        text-align: center;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        animation: fadeIn 0.3s ease;
      }
      .wait-icon {
        font-size: 44px;
        margin-bottom: 16px;
      }
      .wait-title {
        font-size: 22px;
        font-weight: 800;
        margin-bottom: 10px;
      }
      .wait-sub {
        font-size: 14px;
        color: var(--text2);
        line-height: 1.6;
        margin-bottom: 20px;
      }
      .wait-timer-disp {
        font-family: var(--mono);
        font-size: 44px;
        font-weight: 700;
        color: var(--warning);
        letter-spacing: 3px;
      }
      .wait-hint {
        font-size: 12px;
        color: var(--text3);
        margin-top: 10px;
      }

      /* ══ RESPONSIVE ══ */
      @media (max-width: 768px) {
        .sidebar {
          position: fixed;
          right: 0;
          top: 0;
          bottom: 0;
          z-index: 160;
          transform: translateX(100%);
          transition: transform 0.3s;
          width: 300px;
        }
        .sidebar.open {
          transform: translateX(0);
        }
        .sidebar-close {
          display: block;
        }
        .sidebar-overlay.active {
          display: block;
        }
        .drawer-toggle {
          display: flex;
        }
        .question-panel {
          padding: 20px 16px 80px;
        }
        .exam-header {
          padding: 0 16px;
          height: 56px;
        }
        .session-name {
          display: none;
        }
        .toolbar {
          padding: 8px 16px;
        }
      }

      /* ══ JS-INJECTED COMPONENTS ══ */
      .score-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--accent2));
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 8px 24px rgba(91, 94, 244, 0.4);
      }
      .score-number {
        font-size: 36px;
        font-weight: 800;
        color: #fff;
        font-family: var(--mono);
        line-height: 1;
      }
      .score-label {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.8);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 4px;
      }
      .session-summary-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin: 20px 0;
      }
      .stat-card {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 16px;
        text-align: center;
      }
      .stat-card .number {
        font-size: 26px;
        font-weight: 800;
        font-family: var(--mono);
        margin-bottom: 4px;
        color: var(--text);
      }
      .stat-card .label {
        font-size: 12px;
        color: var(--text2);
      }
      .status-badge {
        display: inline-block;
        padding: 6px 18px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 800;
        letter-spacing: 0.5px;
      }
      .status-pass {
        background: rgba(34, 197, 94, 0.15);
        color: var(--success);
        border: 1px solid rgba(34, 197, 94, 0.3);
      }
      .status-fail {
        background: rgba(239, 68, 68, 0.15);
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, 0.3);
      }
      .answer-review {
        margin-top: 20px;
        border-top: 1px solid var(--border);
        padding-top: 16px;
      }
      .answer-review h3 {
        font-size: 13px;
        font-weight: 700;
        color: var(--text2);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 12px;
      }
      .answer-review table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
      }
      .answer-review th {
        font-size: 11px;
        font-weight: 700;
        color: var(--text2);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 8px 10px;
        border-bottom: 1px solid var(--border2);
        text-align: left;
      }
      .answer-review td {
        padding: 10px;
        border-bottom: 1px solid var(--border);
        color: var(--text);
      }
      .answer-review tr:last-child td {
        border-bottom: none;
      }
      .btn-continue {
        display: block;
        width: 100%;
        margin-top: 20px;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 11px;
        padding: 15px;
        font-family: var(--font);
        font-size: 15px;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.15s;
      }
      .btn-continue:hover {
        background: var(--accent2);
        transform: translateY(-1px);
      }
      .toast {
        position: fixed;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--surface);
        border: 1px solid var(--border2);
        border-radius: 10px;
        padding: 12px 20px;
        font-size: 13px;
        font-weight: 600;
        color: var(--text);
        box-shadow: var(--shadow-lg);
        z-index: 400;
        animation: fadeIn 0.3s ease;
      }
    </style>
  </head>
  <body>
    <!-- LOGIN SCREEN -->
    <div id="loginScreen" class="screen active">
      <div class="login-container">
        <div class="login-card">
          <div class="logo-area">
            <div class="logo-icon">📚</div>
            <h1>CBT BIMTES 2026</h1>
            <p>Computer Based Test - Profesional</p>
          </div>
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input
              type="text"
              id="studentName"
              placeholder="Masukkan nama lengkap"
              value="{{ $peserta->nama ?? '' }}"
            />
          </div>
          <div class="form-group">
            <label>Nomor Peserta</label>
            <input
              type="text"
              id="studentNumber"
              placeholder="Masukkan nomor peserta"
              value="{{ $peserta->nomor_peserta ?? '' }}"
            />
          </div>
          <div class="info-grid-login">
            <div class="info-item">
              <div class="info-label">Sesi</div>
              <div class="info-value">10</div>
            </div>
            <div class="info-item">
              <div class="info-label">Soal Total</div>
              <div class="info-value">100</div>
            </div>
            <div class="info-item">
              <div class="info-label">Per Sesi</div>
              <div class="info-value">10 soal</div>
            </div>
            <div class="info-item">
              <div class="info-label">Waktu</div>
              <div class="info-value">30 menit</div>
            </div>
          </div>
          <button class="btn btn-primary" id="startExamBtn">
            Mulai Ujian →
          </button>
        </div>
      </div>
    </div>

    <!-- EXAM SCREEN -->
    <div id="examScreen" class="screen">
      <div class="exam-header">
        <div class="session-info">
          <span class="session-badge" id="sessionBadge">Sesi 1/10</span>
          <span class="session-name" id="sessionName">Memuat...</span>
        </div>
        <div class="timer" id="timer">30:00</div>
        <button class="toolbar-btn" id="themeToggleBtn">
          <i class="fas fa-moon"></i>
        </button>
        <button class="toolbar-btn" id="fullscreenBtn">
          <i class="fas fa-expand"></i>
        </button>
      </div>
      <div class="progress-bar">
        <div class="progress-fill" id="progressFill"></div>
      </div>

      <div class="toolbar">
        <div class="font-control">
          <button id="fontMinus">A-</button>
          <span style="font-size: 12px">Font</span>
          <button id="fontPlus">A+</button>
        </div>
        <button class="toolbar-btn" id="toggleSidebarBtn">
          <i class="fas fa-bars"></i> Navigasi
        </button>
        <button class="toolbar-btn" id="endSessionBtn">
          <i class="fas fa-flag-checkered"></i> Akhiri Sesi
        </button>
      </div>

      <div class="exam-main">
        <div class="question-panel">
          <div class="question-text" id="questionText"></div>
          <div class="options-list" id="optionsList"></div>
        </div>

        <div class="sidebar" id="sidebar">
          <button class="sidebar-close" id="closeSidebarBtn">✕</button>
          <div class="sidebar-section">
            <h3>Navigasi Soal</h3>
            <div class="question-grid" id="questionGrid"></div>
          </div>
          <div class="sidebar-section">
            <h3>Status</h3>
            <div class="stats">
              <div class="stat-row">
                <span>Terjawab</span
                ><span class="stat-value answered" id="answeredCount">0</span>
              </div>
              <div class="stat-row">
                <span>Belum Dijawab</span
                ><span class="stat-value unanswered" id="unansweredCount"
                  >10</span
                >
              </div>
              <div class="stat-row">
                <span>Ditandai</span
                ><span class="stat-value flagged" id="flaggedCount">0</span>
              </div>
            </div>
            <button class="btn-flag" id="flagBtn">🔖 Tandai Ragu-ragu</button>
          </div>
          <div class="sidebar-section">
            <h3>Informasi</h3>
            <div class="stats">
              <div class="stat-row">
                <span>Peserta</span><span id="infoName">-</span>
              </div>
              <div class="stat-row">
                <span>No Peserta</span><span id="infoNumber">-</span>
              </div>
            </div>
          </div>
          <div class="nav-buttons">
            <button class="btn-nav" id="prevBtn">← Sebelumnya</button>
            <button class="btn-nav" id="nextBtn">Selanjutnya →</button>
          </div>
        </div>
      </div>
      <button class="drawer-toggle" id="mobileDrawerBtn">
        <i class="fas fa-list"></i>
      </button>
      <div class="sidebar-overlay" id="sidebarOverlay"></div>
    </div>

    <!-- SESSION SUMMARY SCREEN -->
    <div id="summaryScreen" class="screen">
      <div class="summary-container">
        <div class="summary-card" id="summaryCard"></div>
      </div>
    </div>

    <!-- FINAL RESULT SCREEN -->
    <div id="finalScreen" class="screen">
      <div class="summary-container">
        <div class="summary-card" id="finalCard"></div>
      </div>
    </div>

    <!-- MODAL -->
    <div id="confirmModal" class="modal">
      <div class="modal-content">
        <h3 id="modalTitle">Konfirmasi</h3>
        <p id="modalMessage">Apakah Anda yakin?</p>
        <div class="modal-buttons">
          <button class="modal-btn modal-btn-cancel" id="modalCancelBtn">
            Batal
          </button>
          <button class="modal-btn modal-btn-confirm" id="modalConfirmBtn">
            Ya
          </button>
        </div>
      </div>
    </div>

    <script>
      // ==================== ENKRIPSI KUNCI JAWABAN ====================
      // ==================== ENKRIPSI KUNCI JAWABAN ====================
const ENCRYPT_KEY = 7;
function encryptAnswer(ans) {
  return Number(ans) + ENCRYPT_KEY;
}
function decryptAnswer(enc) {
  return Number(enc) - ENCRYPT_KEY;
}

      // ==================== DATA SOAL DARI DATABASE ====================
      let SESSIONS_DATA = []; 

      // Ambil data soal dari API Laravel
      // Ambil data soal dari API Laravel
      async function loadExamData() {
          try {
              const response = await fetch('/api/soal'); // Sesuaikan rute API-mu jika diperlukan
              SESSIONS_DATA = await response.json();
              
              if (SESSIONS_DATA.length === 0) {
                  alert("Belum ada soal yang di-upload di database!");
                  return;
              }

              // Jalankan enkripsi jawaban bawaan kode asli setelah data berhasil mendarat
              for (let s of SESSIONS_DATA) {
                  for (let q of s.questions) {
                      q.correct = encryptAnswer(q.correct);
                  }
              }

              // Jalankan pembaruan data statistik di halaman login secara otomatis
              updateLoginScreenInfo();
              
              // 🌟 OTOMATIS BYPASS: Jika nama & nomor sudah terisi dari Session Laravel, langsung gas mulai ujian!
              const autoName = document.getElementById("studentName").value.trim();
              const autoNumber = document.getElementById("studentNumber").value.trim();
              if (autoName && autoNumber) {
                  startExam();
              }
              
          } catch (error) {
              console.error("Gagal memuat soal:", error);
          }
      }

      // Fungsi otomatis mengubah 4 kotak info login berdasarkan data Excel Admin
      function updateLoginScreenInfo() {
          if (SESSIONS_DATA.length > 0) {
              // 1. Hitung total seluruh soal dari semua materi/sesi
              let totalSoal = SESSIONS_DATA.reduce((acc, curr) => acc + curr.questions.length, 0);
              
              // 2. Ambil jumlah soal dari sesi pertama sebagai sampel "Per Sesi"
              let soalPerSesi = SESSIONS_DATA[0].questions.length;
              
              // 3. Ambil waktu durasi dari sesi pertama
              let waktuMenit = SESSIONS_DATA[0].duration;
              
              // 4. Bidik semua selector kotak angka di halaman login
              const infoValues = document.querySelectorAll('.info-grid-login .info-value');
              
              // Tulis datanya secara dinamis ke HTML template
              if (infoValues.length >= 4) {
                  infoValues[0].innerText = SESSIONS_DATA.length;         // Kotak 1: Jumlah Sesi
                  infoValues[1].innerText = totalSoal;                    // Kotak 2: Total Soal
                  infoValues[2].innerText = soalPerSesi + " soal";        // Kotak 3: Jumlah Soal Per Sesi
                  infoValues[3].innerText = waktuMenit + " menit";        // Kotak 4: Durasi Waktu Ujian
              }
          }
      }

      // Jalankan fetch saat halaman selesai dimuat browser
      window.addEventListener('DOMContentLoaded', loadExamData);

      // ==================== GLOBAL STATE ====================
      let student = { name: "", number: "" };
      let currentSession = 0;
      let currentQuestion = 0;
      let answers = [];
      let flagged = [];
      let sessionResults = [];
      let timer = null;
      let timeLeft = 0;
      let sessionActive = true;
      let fontSize = 16;
      let modalConfirmCallback = null;
      let examStartTime = null; // ⏱️ Dipakai untuk hitung durasi_menit yang sebenarnya (bukan hardcode)

      // ==================== ANTI-CHEAT LOCK STATE ====================
      let examLocked = false; // true selama siswa benar2 sedang mengerjakan ujian
      let violationCount = 0;
      const MAX_VIOLATIONS = 3; // batas pelanggaran sebelum auto-submit paksa
      let warningModalOpen = false;

      // ==================== DOM ELEMENTS ====================
      const loginScreen = document.getElementById("loginScreen");
      const examScreen = document.getElementById("examScreen");
      const summaryScreen = document.getElementById("summaryScreen");
      const finalScreen = document.getElementById("finalScreen");
      const confirmModal = document.getElementById("confirmModal");

      // ==================== UTILITY FUNCTIONS ====================
      function formatTime(seconds) {
        let mins = Math.floor(seconds / 60);
        let secs = seconds % 60;
        return `${mins.toString().padStart(2, "0")}:${secs.toString().padStart(2, "0")}`;
      }

      function showScreen(screenId) {
        document
          .querySelectorAll(".screen")
          .forEach((s) => s.classList.remove("active"));
        document.getElementById(screenId).classList.add("active");
      }

      function showToast(message, isWarning = true) {
        const toast = document.createElement("div");
        toast.className = "toast";
        toast.innerHTML = `${isWarning ? "⚠️ " : "✅ "}${message}`;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
      }

      function showModal(title, message, onConfirm) {
        document.getElementById("modalTitle").innerText = title;
        document.getElementById("modalMessage").innerHTML = message;
        modalConfirmCallback = onConfirm;
        confirmModal.classList.add("active");
      }

      function closeModal() {
        confirmModal.classList.remove("active");
        modalConfirmCallback = null;
      }

      // Theme
      function toggleTheme() {
        if (document.documentElement.getAttribute("data-theme") === "dark") {
          document.documentElement.removeAttribute("data-theme");
          localStorage.setItem("theme", "light");
        } else {
          document.documentElement.setAttribute("data-theme", "dark");
          localStorage.setItem("theme", "dark");
        }
      }

      // Font Size
      function changeFontSize(delta) {
        fontSize = Math.min(24, Math.max(12, fontSize + delta));
        const qText = document.querySelector(".question-text");
        if (qText) qText.style.fontSize = `${fontSize}px`;
        document
          .querySelectorAll(".option-text")
          .forEach((el) => (el.style.fontSize = `${fontSize}px`));
        localStorage.setItem("fontSize", fontSize);
      }

      // Fullscreen
      function toggleFullscreen() {
        if (!document.fullscreenElement) {
          document.documentElement.requestFullscreen();
        } else {
          document.exitFullscreen();
        }
      }

      // Sidebar untuk mobile
      function openSidebar() {
        document.getElementById("sidebar").classList.add("open");
        document.getElementById("sidebarOverlay").style.display = "block";
      }
      function closeSidebar() {
        document.getElementById("sidebar").classList.remove("open");
        document.getElementById("sidebarOverlay").style.display = "none";
      }
      function toggleSidebar() {
        if (document.getElementById("sidebar").classList.contains("open")) {
          closeSidebar();
        } else {
          openSidebar();
        }
      }

      // Cek passing grade
      function checkPassingGrade(score) {
        return score >= 70;
      }

      // ==================== CORE FUNCTIONS ====================
      function startExam() {
        const name = document.getElementById("studentName").value.trim();
        const number = document.getElementById("studentNumber").value.trim();
        if (!name || !number) {
          alert("Mohon lengkapi nama dan nomor peserta!");
          return;
        }
        student = { name, number };
        examStartTime = Date.now(); // ⏱️ Mulai hitung durasi pengerjaan dari sini
        
        // Dinamis mengikuti jumlah soal asli per sesi dari database
        answers = SESSIONS_DATA.map((session) => new Array(session.questions.length).fill(null));
        flagged = SESSIONS_DATA.map((session) => new Array(session.questions.length).fill(false));
        sessionResults = [];
        currentSession = 0;
        currentQuestion = 0;
        sessionActive = true;
        loadFromLocalStorage();
        initSession();
        showScreen("examScreen");

        // Anti cheat
        document.addEventListener("contextmenu", (e) => e.preventDefault());
        document.addEventListener("copy", (e) => e.preventDefault());
        document.addEventListener("cut", (e) => e.preventDefault());
        document.addEventListener("paste", (e) => e.preventDefault());

        // 🔒 Kunci layar ujian: fullscreen wajib + pantau perpindahan tab/fokus
        lockExam();
      }

      // ==================== EXAM LOCK / ANTI TAB-SWITCH ====================
      function lockExam() {
        examLocked = true;
        violationCount = 0;
        enterFullscreenLock();
      }

      function enterFullscreenLock() {
        const elem = document.documentElement;
        const req =
          elem.requestFullscreen ||
          elem.webkitRequestFullscreen ||
          elem.msRequestFullscreen;
        if (req) {
          req.call(elem).catch(() => {
            /* sebagian browser/iframe menolak fullscreen, lock via tab/fokus tetap jalan */
          });
        }
      }

      function isReallyFullscreen() {
        return !!(
          document.fullscreenElement ||
          document.webkitFullscreenElement ||
          document.msFullscreenElement
        );
      }

      function handleExamViolation(reason) {
        if (!examLocked || !sessionActive) return;
        violationCount++;
        if (violationCount >= MAX_VIOLATIONS) {
          showToast(
            "Batas pelanggaran tercapai. Ujian otomatis disubmit dengan jawaban saat ini!",
          );
          forceSubmitAllSessions();
        } else {
          showLockWarning(reason, violationCount);
        }
      }

      function showLockWarning(reason, count) {
        warningModalOpen = true;
        document.getElementById("modalTitle").innerText =
          "⚠️ Pelanggaran Ujian Terdeteksi";
        document.getElementById("modalMessage").innerHTML =
          `${reason}<br><br>Peringatan <b>${count}/${MAX_VIOLATIONS}</b>. Jika batas terlampaui, ujian akan <b>otomatis disubmit</b> dengan jawaban yang sudah terisi saat ini.`;
        document.getElementById("modalCancelBtn").style.display = "none";
        document.getElementById("modalConfirmBtn").innerText =
          "Kembali ke Ujian";
        modalConfirmCallback = () => {
          warningModalOpen = false;
          document.getElementById("modalCancelBtn").style.display = "";
          document.getElementById("modalConfirmBtn").innerText = "Konfirmasi";
          enterFullscreenLock();
        };
        confirmModal.classList.add("active");
      }

      // Submit paksa semua sesi (sesi berjalan + sesi yang belum dikerjakan)
      // dipakai saat siswa melebihi batas pelanggaran anti-cheat.
      function forceSubmitAllSessions() {
        examLocked = false;
        sessionActive = false;
        clearInterval(timer);
        confirmModal.classList.remove("active");
        warningModalOpen = false;

        const session = SESSIONS_DATA[currentSession];
        let correct = 0;
        for (let i = 0; i < session.questions.length; i++) {
          const answer = answers[currentSession][i];
          const correctAnswer = decryptAnswer(session.questions[i].correct);
          if (answer !== null && answer === correctAnswer) correct++;
        }
        sessionResults.push({
          sessionIndex: currentSession,
          sessionName: session.name,
          totalQuestions: session.questions.length,
          correct: correct,
          score: (correct / session.questions.length) * 100,
          answers: [...answers[currentSession]],
        });

        // Sesi yang belum sempat dikerjakan dianggap kosong (skor 0), bukan dihilangkan,
        // supaya rekap akhir tetap mencakup seluruh sesi ujian.
        for (let s = currentSession + 1; s < SESSIONS_DATA.length; s++) {
          const sess = SESSIONS_DATA[s];
          sessionResults.push({
            sessionIndex: s,
            sessionName: sess.name,
            totalQuestions: sess.questions.length,
            correct: 0,
            score: 0,
            answers: new Array(sess.questions.length).fill(null),
          });
        }

        saveToLocalStorage();
        showFinalResult();
      }

      function initSession() {
        const session = SESSIONS_DATA[currentSession];
        timeLeft = session.duration * 60;
        sessionActive = true;
        document.getElementById("sessionBadge").innerHTML =
          `Sesi ${currentSession + 1}/${SESSIONS_DATA.length}`;
        document.getElementById("sessionName").innerText = session.name;
        document.getElementById("infoName").innerText = student.name;
        document.getElementById("infoNumber").innerText = student.number;
        renderCurrentQuestion();
        renderQuestionGrid();
        updateStats();
        if (timer) clearInterval(timer);
        timer = setInterval(() => {
          if (!sessionActive) return;
          if (timeLeft <= 0) {
            clearInterval(timer);
            endSession();
          } else {
            timeLeft--;
            updateTimerDisplay();
          }
        }, 1000);
        updateTimerDisplay();
      }

      function updateTimerDisplay() {
        const timerElem = document.getElementById("timer");
        timerElem.innerText = formatTime(timeLeft);
        if (timeLeft <= 60) timerElem.classList.add("warning");
        else timerElem.classList.remove("warning");
      }
function isolateArabic(text) {
  return text.replace(
    /([\u0600-\u06FF][\u0600-\u06FF\u0610-\u061A\u064B-\u065F\u0670\u06D6-\u06ED\u0660-\u0669\s.,،؛؟!:ـ«»'"()\-]*[\u0600-\u06FF]|[\u0600-\u06FF])/g,
    (m) => `<bdi dir="rtl">${m}</bdi>`
  );
}
        function normalizeText(text) {
  const PARA_BREAK = '§§PARA§§';
  let t = text.replace(/\n\s*\n/g, PARA_BREAK); // lindungi jeda paragraf asli
  t = t.replace(/\n/g, ' ');                     // sisa \n tunggal jadi spasi
  t = t.split(PARA_BREAK).join('\n\n');          // kembalikan jeda paragraf
  return t.replace(/\s+/g, (m) => (m.includes('\n') ? m : ' ')); // rapihin spasi ganda
}
      function renderCurrentQuestion() {
        const session = SESSIONS_DATA[currentSession];
        const question = session.questions[currentQuestion];
        const currentAnswer = answers[currentSession][currentQuestion];
       const gambarHtml = question.gambar
  ? `<img src="/storage/${question.gambar}" class="question-image" alt="Gambar soal">`
  : "";
document.getElementById("questionText").innerHTML =
  `<i class="fas fa-question-circle"></i> ${isolateArabic(normalizeText(question.text))}${gambarHtml}`;
        
        const letters = ["A", "B", "C", "D", "E"];
        
        const optionsHtml = question.options
          .map(
            (opt, idx) => {
              // 🔥 SAKTI: Otomatis mendeteksi teks pilihan dari object database
              let txt = opt;
              if (typeof opt === 'object' && opt !== null) {
                  txt = opt.text || opt.option_text || opt.option || opt.pilihan || opt.jawaban;
                  // Jika nama kolom di DB kamu berbeda, script ini akan otomatis mencari field string acak selain ID & Timestamp
                  if (!txt) {
                      for (let key in opt) {
                          if (!['id', 'question_id', 'created_at', 'updated_at'].includes(key.toLowerCase()) && typeof opt[key] === 'string') {
                              txt = opt[key];
                              break;
                          }
                      }
                  }
              }

              return `
    <div class="option-item ${currentAnswer === idx ? "selected" : ""}" data-opt-index="${idx}">
      <div class="option-letter">${letters[idx]}</div>
     <div class="option-text">${isolateArabic(normalizeText(txt))}</div>
    </div>
  `;
            }
          )
          .join("");
          
        document.getElementById("optionsList").innerHTML = optionsHtml;
        document.querySelectorAll(".option-item").forEach((el) => {
          el.addEventListener("click", () =>
            selectAnswer(parseInt(el.dataset.optIndex)),
          );
        });
        const isFlagged = flagged[currentSession][currentQuestion];
        const flagBtn = document.getElementById("flagBtn");
        if (isFlagged) {
          flagBtn.classList.add("active");
          flagBtn.innerHTML = "⭐ Hapus Tanda Ragu";
        } else {
          flagBtn.classList.remove("active");
          flagBtn.innerHTML = "🔖 Tandai Ragu-ragu";
        }
        const progress =
          ((currentQuestion + 1) / session.questions.length) * 100;
        document.getElementById("progressFill").style.width = `${progress}%`;
      }
      function selectAnswer(answerIndex) {
        if (!sessionActive) return;
        answers[currentSession][currentQuestion] = answerIndex;
        renderCurrentQuestion();
        renderQuestionGrid();
        updateStats();
        saveToLocalStorage();
      }

      // Mengubah render grid agar class tombolnya sesuai CSS (.grid-item)
      function renderQuestionGrid() {
        const session = SESSIONS_DATA[currentSession];
        const grid = document.getElementById("questionGrid");
        grid.innerHTML = "";
        for (let i = 0; i < session.questions.length; i++) {
          const btn = document.createElement("button");
          btn.className = "grid-item"; // Menyesuaikan class style css asli kamu (.grid-item)
          btn.innerText = (i + 1).toString();
          if (answers[currentSession][i] !== null)
            btn.classList.add("answered");
          if (flagged[currentSession][i]) btn.classList.add("flagged");
          if (i === currentQuestion) btn.classList.add("current");
          btn.onclick = () => goToQuestion(i);
          grid.appendChild(btn);
        }
      }

      function toggleFlag() {
        flagged[currentSession][currentQuestion] =
          !flagged[currentSession][currentQuestion];
        renderCurrentQuestion();
        renderQuestionGrid();
        updateStats();
        saveToLocalStorage();
      }

      function prevQuestion() {
        if (currentQuestion > 0) {
          currentQuestion--;
          renderCurrentQuestion();
          renderQuestionGrid();
          updateStats();
        }
      }

      function nextQuestion() {
        if (
          currentQuestion <
          SESSIONS_DATA[currentSession].questions.length - 1
        ) {
          currentQuestion++;
          renderCurrentQuestion();
          renderQuestionGrid();
          updateStats();
        }
      }

      function goToQuestion(index) {
        currentQuestion = index;
        renderCurrentQuestion();
        renderQuestionGrid();
        updateStats();
        if (window.innerWidth <= 768) closeSidebar();
      }

      function updateStats() {
        const session = SESSIONS_DATA[currentSession];
        let answered = 0,
          flaggedCount = 0;
        for (let i = 0; i < session.questions.length; i++) {
          if (answers[currentSession][i] !== null) answered++;
          if (flagged[currentSession][i]) flaggedCount++;
        }
        document.getElementById("answeredCount").innerText = answered;
        document.getElementById("unansweredCount").innerText =
          session.questions.length - answered;
        document.getElementById("flaggedCount").innerText = flaggedCount;
      }

      function endSessionWithWarning() {
        const session = SESSIONS_DATA[currentSession];
        const unanswered =
          session.questions.length -
          answers[currentSession].filter((a) => a !== null).length;
        if (unanswered > 0) {
          showModal(
            "Peringatan",
            `Masih ada ${unanswered} soal yang belum dijawab. Yakin ingin mengakhiri sesi?`,
            () => endSession(),
          );
        } else {
          endSession();
        }
      }

      function endSession() {
        sessionActive = false;
        clearInterval(timer);
        const session = SESSIONS_DATA[currentSession];
        let correct = 0;
        for (let i = 0; i < session.questions.length; i++) {
          const answer = answers[currentSession][i];
          const correctAnswer = decryptAnswer(session.questions[i].correct);
          if (answer !== null && answer === correctAnswer) correct++;
        }
        const score = (correct / session.questions.length) * 100;
        sessionResults.push({
          sessionIndex: currentSession,
          sessionName: session.name,
          totalQuestions: session.questions.length,
          correct: correct,
          score: score,
          answers: [...answers[currentSession]],
        });
        saveToLocalStorage();
        showSessionSummary();
      }

      function showSessionSummary() {
        const result = sessionResults[sessionResults.length - 1];

        // 🔒 Hasil sesi dirahasiakan dari peserta — tidak ada skor, statistik,
        // atau rekap jawaban yang ditampilkan. Layar ini cuma transisi ke sesi berikutnya.
        const summaryHtml = `
          <div class="score-circle" style="background: linear-gradient(135deg, var(--success), #16a34a);">
            <div class="score-number"><i class="fas fa-check"></i></div><div class="score-label">Selesai</div>
          </div>
          <h2 style="text-align:center;">${result.sessionName}</h2>
          <p style="text-align:center; color:var(--text2);">Sesi ${currentSession + 1} dari ${SESSIONS_DATA.length}</p>
          <p style="text-align:center; color:var(--text2); margin-top:16px;">Jawaban Anda telah tersimpan.</p>
          <button class="btn btn-continue" id="continueBtn" style="margin-top:24px;">${currentSession + 1 === SESSIONS_DATA.length ? "🎉 Lihat Hasil Akhir" : "📖 Lanjut ke Sesi " + (currentSession + 2)}</button>
        `;
        document.getElementById("summaryCard").innerHTML = summaryHtml;
        document.getElementById("continueBtn").onclick = continueToNextSession;
        showScreen("summaryScreen");
      }

      function continueToNextSession() {
        if (currentSession + 1 < SESSIONS_DATA.length) {
          currentSession++;
          currentQuestion = 0;
          initSession();
          showScreen("examScreen");
        } else {
          showFinalResult();
        }
      }

      // ==================== KIRIM HASIL UJIAN KE DATABASE LARAVEL ====================
      // Dipanggil otomatis dari showFinalResult() begitu siswa menyelesaikan SEMUA sesi.
      function kirimHasilUjianKeServer(finalScore, totalCorrect, totalQuestions, isPass, durasiMenit) {
        // Rekap per sesi/materi. `materi_id` di sini ambil dari field "id" hasil /api/soal —
        // SESUAIKAN nama field-nya kalau di tabel/migration kamu nama kolomnya beda (mis. sesi_id, ujian_id, dll).
        const urlParams = new URLSearchParams(window.location.search);
        const idMateri = urlParams.get('session_id');
        const detailSesi = sessionResults.map((r) => ({
          materi_id: SESSIONS_DATA[r.sessionIndex] ? SESSIONS_DATA[r.sessionIndex].id : null,
          nama_materi: r.sessionName,
          total_soal: r.totalQuestions,
          jawaban_benar: r.correct,
          jawaban_salah: r.totalQuestions - r.correct,
          skor: r.score,
        }));

        fetch('/api/submit-ujian', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    },
    body: JSON.stringify({
        // Sesuaikan dengan yang dibutuhkan oleh Nilai::create di CbtController
        peserta_id: "{{ session('peserta_id') }}", // Pastikan ID peserta dikirim
        session_id: idMateri,                     // Pastikan ID sesi ujian dikirim
        total_soal: totalQuestions,
        jawaban_benar: totalCorrect,
        jawaban_salah: totalQuestions - totalCorrect,
        skor: finalScore,
        durasi_menit: durasiMenit,
    }),
})
          .then((response) => response.json())
          .then((data) => {
            if (data.status === 'success') {
              showToast('Nilai berhasil disimpan ke server!', false);
            } else {
              showToast('Gagal menyimpan nilai: ' + data.message);
            }
          })
          .catch((error) => {
            console.error('Gagal mengirim hasil ujian:', error);
            showToast('Koneksi gagal, nilai belum tersimpan ke server.');
          });
      }

      function showFinalResult() {
        // 🔓 Ujian selesai total: lepas kunci anti-cheat & keluar dari fullscreen.
        examLocked = false;
        sessionActive = false;
        if (isReallyFullscreen() && document.exitFullscreen) {
          document.exitFullscreen().catch(() => {});
        }

        let totalCorrect = 0,
          totalQuestions = 0;
        for (let i = 0; i < sessionResults.length; i++) {
          totalCorrect += sessionResults[i].correct;
          totalQuestions += sessionResults[i].totalQuestions;
        }
        const finalScore = (totalCorrect / totalQuestions) * 100;
        const isPass = checkPassingGrade(finalScore);

        // 🚀 Tembak hasil ujian ke backend Laravel (background, gak ganggu tampilan hasil)
        const durasiMenit = examStartTime
          ? Math.round((Date.now() - examStartTime) / 60000)
          : null;
        kirimHasilUjianKeServer(finalScore, totalCorrect, totalQuestions, isPass, durasiMenit);

        // 🔒 Hasil dirahasiakan dari peserta. Tidak ada skor, nilai, atau status
        // lulus/tidak lulus yang ditampilkan di sisi client — hanya konfirmasi
        // bahwa data sudah dikirim/tersimpan ke server.
        const finalHtml = `
          <div class="score-circle" style="background: linear-gradient(135deg, var(--success), #16a34a);">
            <div class="score-number"><i class="fas fa-check"></i></div><div class="score-label">Selesai</div>
          </div>
          <h2 style="text-align:center;">${student.name}</h2>
          <p style="text-align:center;">No. Peserta: ${student.number}</p>
          <div style="text-align:center; margin:16px 0;"><span class="status-badge status-pass">Data berhasil disimpan</span></div>
          <p style="text-align:center; color:var(--text2); max-width:380px; margin:0 auto;">
            Ujian Anda telah selesai dan jawaban telah tersimpan ke server.
            Hasil dan nilai akan diumumkan kemudian oleh panitia/pengajar.
          </p>
          <button class="btn btn-continue" id="resetBtn" style="margin-top:24px;">🏠 Kembali ke Halaman Awal</button>
        `;
        document.getElementById("finalCard").innerHTML = finalHtml;
        document.getElementById("resetBtn").onclick = resetToLogin;
        showScreen("finalScreen");
        localStorage.removeItem("cbt_bimtes_data");
      }

      function resetToLogin() {
        clearInterval(timer);
        localStorage.removeItem("cbt_bimtes_data");
        
        // 🚀 FIX LOGIKA: Jangan cuma main ganti screen UI, tapi tendang fisik ke halaman depan Laravel!
        window.location.href = "/"; 
      }

      function saveToLocalStorage() {
        localStorage.setItem(
          "cbt_bimtes_data",
          JSON.stringify({
            student,
            answers,
            flagged,
            currentSession,
            currentQuestion,
            sessionResults,
            timeLeft,
            sessionActive,
          }),
        );
      }

      function loadFromLocalStorage() {
        const saved = localStorage.getItem("cbt_bimtes_data");
        if (saved) {
          const data = JSON.parse(saved);
          if (
            data.student &&
            data.student.name === student.name &&
            data.student.number === student.number
          ) {
            answers = data.answers;
            flagged = data.flagged;
            currentSession = data.currentSession;
            currentQuestion = data.currentQuestion;
            sessionResults = data.sessionResults;
            timeLeft = data.timeLeft;
            sessionActive = data.sessionActive;
          }
        }
      }

      // ==================== EVENT LISTENERS ====================
      document.getElementById("startExamBtn").onclick = startExam;
      document.getElementById("themeToggleBtn").onclick = toggleTheme;
      document.getElementById("fullscreenBtn").onclick = toggleFullscreen;
      document.getElementById("fontMinus").onclick = () => changeFontSize(-1);
      document.getElementById("fontPlus").onclick = () => changeFontSize(1);
      document.getElementById("toggleSidebarBtn").onclick = toggleSidebar;
      document.getElementById("endSessionBtn").onclick = endSessionWithWarning;
      document.getElementById("flagBtn").onclick = toggleFlag;
      document.getElementById("prevBtn").onclick = prevQuestion;
      document.getElementById("nextBtn").onclick = nextQuestion;
      document.getElementById("closeSidebarBtn").onclick = closeSidebar;
      document.getElementById("mobileDrawerBtn").onclick = openSidebar;
      document.getElementById("sidebarOverlay").onclick = closeSidebar;
      document.getElementById("modalCancelBtn").onclick = closeModal;
      document.getElementById("modalConfirmBtn").onclick = () => {
        if (modalConfirmCallback) modalConfirmCallback();
        closeModal();
      };

      window.addEventListener("beforeunload", (e) => {
        if (examScreen.classList.contains("active") && sessionActive) {
          e.preventDefault();
          e.returnValue = "Ujian sedang berlangsung. Data akan tersimpan.";
        }
      });

      // 🔒 Deteksi pindah tab / minimize. Browser tidak mengizinkan JS
      // benar-benar mencegah Alt+Tab atau pindah tab secara paksa — yang bisa
      // dilakukan hanyalah mendeteksinya lalu memberi peringatan / auto-submit.
      document.addEventListener("visibilitychange", () => {
        if (examLocked && sessionActive && document.hidden) {
          handleExamViolation("Anda berpindah tab atau meminimalkan jendela!");
        }
      });

      // Jaring pengaman tambahan: sebagian browser/desktop tidak memicu
      // visibilitychange saat Alt+Tab, tapi tetap memicu blur pada window.
      window.addEventListener("blur", () => {
        if (
          examLocked &&
          sessionActive &&
          !warningModalOpen &&
          document.visibilityState === "visible"
        ) {
          handleExamViolation("Jendela ujian kehilangan fokus!");
        }
      });

      // Wajib fullscreen selama ujian — kalau keluar fullscreen (Esc / tombol
      // browser), hitung sebagai pelanggaran dan minta siswa kembali masuk.
      document.addEventListener("fullscreenchange", () => {
        if (examLocked && sessionActive && !isReallyFullscreen()) {
          handleExamViolation("Anda keluar dari mode layar penuh (fullscreen)!");
        }
      });

      // Blokir sebagian shortcut umum untuk membuka tab baru / pindah window.
      // Catatan: ini best-effort, browser modern membatasi seberapa jauh
      // halaman web bisa mem-block shortcut sistem seperti Alt+Tab.
      document.addEventListener("keydown", (e) => {
        if (!examLocked || !sessionActive) return;
        const blockedCombo =
          (e.ctrlKey || e.metaKey) &&
          ["t", "n", "w", "r"].includes(e.key.toLowerCase());
        if (blockedCombo || e.key === "F5" || e.key === "F11") {
          e.preventDefault();
        }
      });

      if (localStorage.getItem("theme") === "dark")
        document.documentElement.setAttribute("data-theme", "dark");
      if (localStorage.getItem("fontSize"))
        fontSize = parseInt(localStorage.getItem("fontSize"));
</script>
  </body>
</html>
