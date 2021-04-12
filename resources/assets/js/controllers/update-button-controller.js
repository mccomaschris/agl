import { Controller } from "stimulus"

export default class extends Controller {

  update(e) {
    e.preventDefault()
    this.element.classList.add('loader')

    fetch(this.data.get("url"), {
      method: 'GET',
      credentials: "include",
      dataType: 'script',
      headers: {
        "X-CSRF-Token": getMetaValue("csrf-token"),
        "Content-Type": "application/json"
      },
    })
      .then(response => response.text(), setTimeout(this.element.classList.remove('loader'), 5000))
  }
}