let convStatusGroup = document.querySelector(".conv-info #conv-status.btn-group");
convStatusGroup.childNodes.forEach(function(item){
  if ('button' === item.type) {
    item.setAttribute('disabled', 'disabled')
  }
});