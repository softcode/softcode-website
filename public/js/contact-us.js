$(document).ready(function () {
  const form = document.querySelector("#contact-us");

  async function sendData() {
    const formData = new FormData(form);

    try {
      fetch("/submit_form", {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          if (response.ok) {
            $("#contact-us")[0].reset();
            return response.json();
          } else {
            return response.text().then(text => { throw new Error(text) })
          }
        }).then((success) => {
          $("#message-area p").text(success).css({ "color": "green" });
        }).catch((err) => {
          $("#message-area p").text(err).css({ "color": "red" });
        });
    } catch (e) {
      console.error(e);
    }
  }

  form.addEventListener("submit", (event) => {
    event.preventDefault();
    sendData();
  });
});
