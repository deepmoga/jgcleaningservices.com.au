(() => {
  'use strict';
  document.querySelectorAll('textarea[data-editor]').forEach((textarea) => {
    const shell = document.createElement('div'); shell.className = 'editor-shell';
    const toolbar = document.createElement('div'); toolbar.className = 'editor-toolbar';
    const area = document.createElement('div'); area.className = 'editor-area'; area.contentEditable = 'true'; area.innerHTML = textarea.value;
    const controls = [['Paragraph','formatBlock','p'],['Heading 2','formatBlock','h2'],['Heading 3','formatBlock','h3'],['Bold','bold'],['Italic','italic'],['Underline','underline'],['• List','insertUnorderedList'],['1. List','insertOrderedList'],['Quote','formatBlock','blockquote'],['Link','createLink'],['Remove formatting','removeFormat']];
    controls.forEach(([label, command, value]) => {
      const button = document.createElement('button'); button.type = 'button'; button.textContent = label;
      button.addEventListener('click', () => {
        area.focus(); let commandValue = value || null;
        if (command === 'createLink') { commandValue = window.prompt('Enter a complete https:// URL, mailto: or tel: link'); if (!commandValue) return; }
        document.execCommand(command, false, commandValue); textarea.value = area.innerHTML; textarea.dispatchEvent(new Event('input', { bubbles: true }));
      }); toolbar.appendChild(button);
    });
    area.addEventListener('input', () => { textarea.value = area.innerHTML; textarea.dispatchEvent(new Event('input', { bubbles: true })); });
    textarea.classList.add('editor-source'); textarea.parentNode.insertBefore(shell, textarea.nextSibling); shell.append(toolbar, area);
    textarea.closest('form')?.addEventListener('submit', () => { textarea.value = area.innerHTML; });
  });
})();

