(() => {
  'use strict';
  const menu = document.querySelector('.admin-sidebar');
  document.querySelector('.admin-menu-toggle')?.addEventListener('click', () => menu?.classList.toggle('is-open'));
  document.addEventListener('click', (event) => {
    if (window.innerWidth <= 800 && menu?.classList.contains('is-open') && !menu.contains(event.target) && !event.target.closest('.admin-menu-toggle')) menu.classList.remove('is-open');
  });
  const slugSource = document.querySelector('[data-slug-source]');
  const slugTarget = document.querySelector('[data-slug-target]');
  if (slugSource && slugTarget && !slugTarget.value) slugSource.addEventListener('input', () => { slugTarget.value = slugSource.value.toLowerCase().trim().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, ''); });
  document.querySelectorAll('[data-countable]').forEach((field) => {
    const counter = document.createElement('span'); counter.className = 'word-count'; field.insertAdjacentElement('afterend', counter);
    const update = () => { counter.textContent = `${field.value.length} characters`; }; field.addEventListener('input', update); update();
  });
  const contentField = document.querySelector('textarea[name="content"]');
  const wordCounter = document.querySelector('[data-word-count]');
  const updateWords = () => {
    if (!contentField || !wordCounter) return;
    const temp = document.createElement('div'); temp.innerHTML = contentField.value;
    const words = (temp.textContent || '').trim().split(/\s+/).filter(Boolean).length;
    wordCounter.textContent = `${words} words${words < 600 ? ' — add detail to reach 600+' : words > 1000 ? ' — consider trimming below 1,000' : ' — within the recommended range'}`;
  };
  contentField?.addEventListener('input', updateWords); updateWords();
})();

