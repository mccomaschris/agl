<script>
import { Line } from 'vue-chartjs'

export default {
    extends: Line,
    props: ['chartdata', 'options', 'labels', 'gross_scores', 'net_scores', 'high_gross', 'low_net'],

  
    mounted () {
        
        this.renderChart({
            labels: this.labels,
            datasets: [
                {
                    label: 'Gross Score',
                    backgroundColor: '#08CD4F',
                    data: this.gross_scores,
                    fill: false,
                    borderColor: '#08CD4F'
                },
                {
                    label: 'Net Score',
                    backgroundColor: '#121514',
                    data: this.net_scores,
                    fill: false,
                    borderColor: '#121514'
                }
            ],
        }, {
      responsive: true, 
      maintainAspectRatio: false,
      scales: {
        xAxes: [{
            ticks: {
                suggestedMin: this.low_net - 5,
                suggestedMax: this.high_gross + 5
            }
        }]
    },
    })
    }
}
</script>

<style>
</style>