// Init period pills + Bootstrap tooltips
document.addEventListener('DOMContentLoaded', () => {
  // Tooltips (Bootstrap)
  try {
    const Tooltip = window.bootstrap?.Tooltip;
    if (Tooltip) {
      document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new Tooltip(el));
    }
  } catch {}

  // Period toggles
  document.querySelectorAll('[data-hr-box]').forEach(box => {
    const current = box.getAttribute('data-period') || '30d';
    box.querySelectorAll('.hr-pill').forEach(btn => {
      const p = btn.getAttribute('data-period');
      if (p === current) btn.classList.add('is-active');
      btn.addEventListener('click', () => {
        if (btn.classList.contains('is-active')) return;
        box.querySelectorAll('.hr-pill').forEach(b => b.classList.remove('is-active'));
        btn.classList.add('is-active');
        box.setAttribute('data-period', p);
        box.dispatchEvent(new CustomEvent('hr-box:change-period', {
          bubbles: true,
          detail: { id: box.id, period: p }
        }));
      });
    });
  });
});