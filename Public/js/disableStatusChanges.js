let convStatusGroup = document.querySelector("[data-mailbox_id='1'] .conv-info #conv-status.btn-group");
convStatusGroup.childNodes.forEach(function(item){
  if ('button' === item.type) {
    item.setAttribute('disabled', 'disabled')
  }
});