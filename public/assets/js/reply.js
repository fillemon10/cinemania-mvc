const replyBtns = document.querySelectorAll('.reply-btn');
const replyForms = document.querySelectorAll('.reply-form');
for (var i = 0; i < replyBtns.length; i++) {
  replyBtns[i].addEventListener('click', function () {
    for (let j = 0; j < replyBtns.length; j++) {
      if (replyBtns[j] == this) {
        replyBtns[j].setAttribute('hidden', '');
        replyForms[j]['hidden'] = false;
        break;
      }
    }
  });
}
