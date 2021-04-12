import { Controller } from "stimulus"

export default class extends Controller {

  static targets = ['message']

  connect() {
    this.timeout = setTimeout(this.closeFlash, 2500)
  }

  disconnect() {
    clearTimeout(this.timeout)
  }

  closeFlash = () => {
    this.flashBox.style.opacity = '0'
  }

  get flashBox() {
    return this.element
  }
}