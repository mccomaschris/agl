import { Controller } from "stimulus"

export default class extends Controller {

  static targets = ['menu', 'open', 'close']

  toggle(e) {
    e.preventDefault()
    this.openTarget.classList.toggle('hidden')
    this.closeTarget.classList.toggle('hidden')
    this.menuTarget.classList.toggle('active')
  }
}