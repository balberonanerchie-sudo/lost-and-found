<script setup>
import { ref } from 'vue'
import VueApexCharts from 'vue3-apexcharts'

const props = defineProps({
  totalReports: { type: String, default: '156' }, // Renamed from totalLeads
  percentageChange: { type: Number, default: 12.5 },
  lostCount: { type: String, default: '89' },     // Renamed from moneySpent
  foundCount: { type: String, default: '67' },    // Renamed from conversionRate
})

const isDropdownOpen = ref(false)
const toggleDropdown = () => { isDropdownOpen.value = !isDropdownOpen.value }

const series = ref([
  { 
    name: "Lost Items", 
    data: [{ x: "Mon", y: 12 }, { x: "Tue", y: 15 }, { x: "Wed", y: 8 }, { x: "Thu", y: 20 }, { x: "Fri", y: 10 }, { x: "Sat", y: 25 }, { x: "Sun", y: 18 }] 
  },
  { 
    name: "Found Items", 
    data: [{ x: "Mon", y: 8 }, { x: "Tue", y: 10 }, { x: "Wed", y: 12 }, { x: "Thu", y: 15 }, { x: "Fri", y: 18 }, { x: "Sat", y: 20 }, { x: "Sun", y: 14 }] 
  },
])

const chartOptions = ref({
  chart: { 
    type: "bar", 
    height: 320, 
    fontFamily: "Inter, sans-serif", 
    toolbar: { show: false },
    width: "100%"
  },
  plotOptions: { 
    bar: { 
      horizontal: false, 
      columnWidth: "50%", 
      borderRadiusApplication: "end", 
      borderRadius: 6 
    } 
  },
  tooltip: { shared: true, intersect: false },
  states: { hover: { filter: { type: "darken", value: 1 } } },
  stroke: { show: true, width: 0, colors: ["transparent"] },
  grid: { 
    show: true, 
    strokeDashArray: 4, 
    padding: { left: 10, right: 10, top: 0, bottom: 0 } 
  },
  dataLabels: { enabled: false },
  legend: { show: true, position: 'top' },
  xaxis: { 
    floating: false, 
    labels: { 
        show: true,
        style: { fontFamily: "Inter, sans-serif", cssClass: 'text-xs font-normal fill-gray-500' }
    }, 
    axisBorder: { show: false }, 
    axisTicks: { show: false } 
  },
  yaxis: { show: false },
  fill: { opacity: 1 },
  colors: ["#2d5f3f", "#10b981"], // Red for Lost, Green for Found
})
</script>

<template>
  <div class="w-full bg-white rounded-lg shadow-sm p-4 md:p-6 border border-gray-200">
    
    <div class="flex justify-between pb-4 mb-4 border-b border-gray-100">
      <div class="flex items-center">
        <div class="w-12 h-12 rounded-full bg-green-100 text-green-700 flex items-center justify-center me-3">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
        </div>
        <div>
          <h5 class="text-2xl font-bold text-gray-900">{{ props.totalReports }}</h5>
          <p class="text-sm text-gray-500">Weekly Reports</p>
        </div>
      </div>
      <div>
        <span class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded">
          <svg class="w-3 h-3 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
          {{ props.percentageChange }}%
        </span>
      </div>
    </div>

    <div class="grid grid-cols-2 mb-4">
      <dl class="flex items-center">
          <dt class="text-gray-500 text-sm font-normal me-2">Lost Items:</dt>
          <dd class="text-gray-900 text-sm font-semibold">{{ props.lostCount }}</dd>
      </dl>
      <dl class="flex items-center justify-end">
          <dt class="text-gray-500 text-sm font-normal me-2">Found Items:</dt>
          <dd class="text-gray-900 text-sm font-semibold">{{ props.foundCount }}</dd>
      </dl>
    </div>

    <div id="column-chart" class="w-full">
      <VueApexCharts type="bar" height="320" width="100%" :options="chartOptions" :series="series" />
    </div>

    <div class="grid grid-cols-1 items-center border-t border-gray-100 justify-between mt-4">
      <div class="flex justify-between items-center pt-4 relative">
        <button @click="toggleDropdown" class="text-sm font-medium text-gray-500 hover:text-gray-900 text-center inline-flex items-center" type="button">
            Last 7 days
            <svg class="w-4 h-4 ms-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/></svg>
        </button>

        <div v-if="isDropdownOpen" class="absolute top-10 left-0 z-10 bg-white border border-gray-200 rounded shadow-lg w-44">
            <ul class="py-1 text-sm text-gray-700">
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Yesterday</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Today</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Last 7 days</a></li>
            </ul>
        </div>

        <a href="#" class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-green-700 hover:text-green-800 hover:bg-gray-100 px-3 py-2">
          Full Report
          <svg class="w-4 h-4 ms-1.5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
      </div>
    </div>
  </div>
</template>