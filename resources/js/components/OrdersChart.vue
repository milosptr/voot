<template>
  <div class="w-full bg-white rounded-md shadow border border-gray-100 px-6 py-3" style="height: 400px">
    <vue3-chart-js
      v-if="showChart"
      :id="lineChart.id"
      ref="chartOrdersRef"
      :type="lineChart.type"
      :data="lineChart.data"
      height="400px"
    ></vue3-chart-js>
  </div>
</template>
<script>
  import Vue3ChartJs from '@j-t-mcc/vue3-chartjs'
  import dayjs from 'dayjs'

  export default {
    components: {
      Vue3ChartJs
    },
    data: () => ({
      showChart: false,
      oreders: [],
      lineChart: {
        id: 'orders-line-chart',
        type: 'line',
        maintainAspectRatio: false,
        responsive: true,
        options: {
          plugins: {
            legend: {
              display: false
            },
          },
        },
        data: {
          labels: [],
          datasets: [
            {
              label: 'Total orders for date',
              borderColor: '#bed4ed',
              backgroundColor: '#214b76',
              data: [],
              cubicInterpolationMode: 'monotone',
              tension: 0.4
            }
          ]
        }
      },
    }),
    mounted() {
      axios.get('/api/reports/orders')
        .then((res) => {
          this.orders = res.data
          this.lineChart.data.labels = res.data.map((r) => dayjs(r.created_at_date).format('DD MMM YY'))
          this.lineChart.data.datasets[0].data = res.data.map((r) => r.total)
          this.showChart = true
        })
    }
  }
</script>
