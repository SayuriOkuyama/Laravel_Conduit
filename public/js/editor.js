const TAG_INPUT = document.querySelector('#tag-input');
const LABELS = document.querySelectorAll('.tag-label');
const TAG_LIST = document.querySelector('.tag-list');

// タグ削除
TAG_LIST.addEventListener('click', (e) => {
  if (e.target.tagName === 'I') {
    const TARGET_LABEL = e.target.parentElement.parentElement;
    const TARGET_INOUT = TARGET_LABEL.nextElementSibling;
    TARGET_LABEL.remove();
    TARGET_INOUT.remove();
  }
});

// タグ生成
TAG_INPUT.addEventListener('keydown', (e) => {
  if (!e.isComposing && e.key === 'Enter') {
    const NEW_LABEL = document.createElement('label');
    NEW_LABEL.setAttribute('for', `input_${LABELS.length}`);

    NEW_LABEL.innerHTML = `
      <span class="tag-default tag-pill">
      <i class="ion-close-round"></i>${e.target.value}</span>
    `;

    NEW_LABEL.addEventListener('click', () => {
      NEW_LABEL.nextElementSibling.remove();
      NEW_LABEL.remove();
    });

    TAG_LIST.appendChild(NEW_LABEL);

    const NEW_INPUT = document.createElement('input');
    NEW_INPUT.setAttribute('id', `input_${LABELS.length}`);
    NEW_INPUT.setAttribute('name', 'tags[]');
    NEW_INPUT.setAttribute('type', 'text');
    NEW_INPUT.setAttribute('hidden', true);
    NEW_INPUT.setAttribute('value', `${e.target.value}`);

    TAG_LIST.appendChild(NEW_INPUT);

    e.target.value = '';
  }
});
