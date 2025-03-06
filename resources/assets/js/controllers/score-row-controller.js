import { Controller } from "stimulus"

export default class extends Controller {

  static targets = [
    'absent', 'weeklyWinner', 'substitute', 'scoreInput', 'gross', 'pointsInput', 'container', 'save',
    'hole1', 'hole2', 'hole3', 'hole4', 'hole5', 'hole6', 'hole7', 'hole8', 'hole9', 'official'
  ]

  connect() {
    this.absent()
    this.countGross()
  }

  countGross(e) {
    let gross = 0
    this.scoreInputTargets.forEach((el, i) => {
      gross = gross + parseInt(el.value)
    })
    this.grossTarget.innerHTML = gross
  }

  absent() {
    if (this.absentTarget.checked) {
      this.scoreInputTargets.forEach((el, i) => {
        el.value = null
        el.disabled = true
      })
      this.pointsInputTarget.disabled = true
      this.pointsInputTarget.value = null
    } else {
      this.scoreInputTargets.forEach((el, i) => {
        el.disabled = false
      })
      this.pointsInputTarget.disabled = false
    }
  }

  update(e) {
    if (e) e.preventDefault()
    console.log('test')

    this.saveTarget.classList.add("loader", "loader-green")
    this.saveTarget.firstElementChild.classList.add('opacity-0')

    let formData = {
      absent: this.absentTarget.checked, weekly_winner: this.weeklyWinnerTarget.checked, substitute_id: this.substituteTarget.checked,
      hole_1: this.hole1Target.value, hole_2: this.hole2Target.value, hole_3: this.hole3Target.value,
      hole_4: this.hole4Target.value, hole_5: this.hole5Target.value, hole_6: this.hole6Target.value,
      hole_7: this.hole7Target.value, hole_8: this.hole8Target.value, hole_9: this.hole9Target.value,
      points: this.pointsInputTarget.value, official: this.officialTarget.value,
    }

    fetch(this.data.get("url"), {
      method: 'POST',
      body: JSON.stringify(formData),
      credentials: "include",
      dataType: 'script',
      headers: {
        "X-CSRF-Token": getMetaValue("csrf-token"),
        "Content-Type": "application/json"
      },
    }).then(response => {
      this.saveTarget.firstElementChild.classList.remove('opacity-0')
      this.saveTarget.classList.remove("loader", "loader-green")
      if (response.status === 204) {
        this.saveTarget.classList.remove("text-zinc-400")
        this.saveTarget.classList.add("text-red-500")
      } else {
        this.saveTarget.classList.remove("text-red-500")
        this.saveTarget.classList.add("text-zinc-400")
      }
    });
  }

  toggle(e) {
    e.preventDefault()
    this.openTarget.classList.toggle('hidden')
    this.closeTarget.classList.toggle('hidden')
    this.menuTarget.classList.toggle('active')
  }
}
