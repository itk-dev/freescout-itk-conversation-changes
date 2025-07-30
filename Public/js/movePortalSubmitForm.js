let header = document.querySelector(".heading.eup-ticket-header");
if (header) {
  let headerContainer = header.parentNode;
  let ticketFormContainer = document.querySelector("#eup-ticket-form").parentNode;
  headerContainer.after(ticketFormContainer);
}

