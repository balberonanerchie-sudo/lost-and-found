<script setup>
import { ref, onMounted, computed } from 'vue'
import VueApexCharts from 'vue3-apexcharts'

// Props allows you to pass data into this component from a parent
const props = defineProps({
  totalLeads: { type: String, default: '3.4k' },
  percentageChange: { type: Number, default: 42.5 },
  moneySpent: { type: String, default: '$3,232' },
  conversionRate: { type: String, default: '1.2%' },
})

// State for the dropdown menu
const isDropdownOpen = ref(false)
const toggleDropdown = () => {
  isDropdownOpen.value = !isDropdownOpen.value
}

// Chart Data (Series)
const series = ref([
  {
    name: "Organic",
    data: [
      { x: "Mon", y: 231 },
      { x: "Tue", y: 122 },
      { x: "Wed", y: 63 },
      { x: "Thu", y: 421 },
      { x: "Fri", y: 122 },
      { x: "Sat", y: 323 },
      { x: "Sun", y: 111 },
    ],
  },
  {
    name: "Social media",
    data: [
      { x: "Mon", y: 232 },
      { x: "Tue", y: 113 },
      { x: "Wed", y: 341 },
      { x: "Thu", y: 224 },
      { x: "Fri", y: 522 },
      { x: "Sat", y: 411 },
      { x: "Sun", y: 243 },
    ],
  },
])

// Chart Options
const chartOptions = ref({
  chart: {
    type: "bar",
    height: "320px",
    fontFamily: "Inter, sans-serif",
    toolbar: { show: false },
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "70%",
      borderRadiusApplication: "end",
      borderRadius: 8,
    },
  },
  tooltip: {
    shared: true,
    intersect: false,
    style: { fontFamily: "Inter, sans-serif" },
  },
  states: {
    hover: {
      filter: { type: "darken", value: 1 },
    },
  },
  stroke: {
    show: true,
    width: 0,
    colors: ["transparent"],
  },
  grid: {
    show: false,
    strokeDashArray: 4,
    padding: { left: 2, right: 2, top: -14 },
  },
  dataLabels: { enabled: false },
  legend: { show: false },
  xaxis: {
    floating: false,
    labels: {
      show: true,
      style: {
        fontFamily: "Inter, sans-serif",
        cssClass: 'text-xs font-normal fill-body'
      }
    },
    axisBorder: { show: false },
    axisTicks: { show: false },
  },
  yaxis: { show: false },
  fill: { opacity: 1 },
  colors: ["#1447E6", "#1447E6"], // Default fallback colors
})

// Logic to fetch CSS variables for colors (handles dynamic theming)
onMounted(() => {
  const getBrandColor = () => {
    const computedStyle = getComputedStyle(document.documentElement)
    return computedStyle.getPropertyValue('--color-fg-brand').trim() || "#1447E6"
  }

  const getBrandSecondaryColor = () => {
    const computedStyle = getComputedStyle(document.documentElement)
    return computedStyle.getPropertyValue('--color-fg-brand-subtle').trim() || "#1447E6"
  }

  // Update chart options with calculated colors
  chartOptions.value = {
    ...chartOptions.value,
    colors: [getBrandColor(), getBrandSecondaryColor()]
  }
})
</script>

<template>
  <div class="max-w-sm w-full bg-neutral-primary-soft border border-default rounded-base shadow-xs p-4 md:p-6">
    
    <div class="flex justify-between pb-4 mb-4 border-b border-light">
      <div class="flex items-center">
        <div class="w-12 h-12 bg-neutral-primary-medium border border-default-medium flex items-center justify-center rounded-full me-3">
          <svg class="w-7 h-7 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"/></svg>
        </div>
        <div>
          <h5 class="text-2xl font-semibold text-heading">{{ props.totalLeads }}</h5>
          <p class="text-sm text-body">Leads generated per week</p>
        </div>
      </div>
      <div>
        <span class="inline-flex items-center bg-success-soft border border-success-subtle text-fg-success-strong text-xs font-medium px-1.5 py-0.5 rounded">
          <svg class="w-4 h-4 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v13m0-13 4 4m-4-4-4 4"/></svg>
          {{ props.percentageChange }}%
        </span>
      </div>
    </div>

    <div class="grid grid-cols-2">
      <dl class="flex items-center">
        <dt class="text-body text-sm font-normal me-1">Money spent:</dt>
        <dd class="text-heading text-sm font-semibold">{{ props.moneySpent }}</dd>
      </dl>
      <dl class="flex items-center justify-end">
        <dt class="text-body text-sm font-normal me-1">Conversion:</dt>
        <dd class="text-heading text-sm font-semibold">{{ props.conversionRate }}</dd>
      </dl>
    </div>

    <div id="column-chart">
      <VueApexCharts
        type="bar"
        height="320"
        :options="chartOptions"
        :series="series"
      />
    </div>

    <div class="grid grid-cols-1 items-center border-light border-t justify-between">
      <div class="flex justify-between items-center pt-4 md:pt-6 relative">
        
        <button 
          @click="toggleDropdown"
          class="text-sm font-medium text-body hover:text-heading text-center inline-flex items-center" 
          type="button">
            Last 7 days
            <svg class="w-4 h-4 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/></svg>
        </button>

        <div v-if="isDropdownOpen" class="absolute top-12 left-0 z-10 bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44 bg-white">
          <ul class="p-2 text-sm text-body font-medium">
            <li><a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Yesterday</a></li>
            <li><a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Today</a></li>
            <li><a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Last 7 days</a></li>
            <li><a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Last 30 days</a></li>
            <li><a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Last 90 days</a></li>
          </ul>
        </div>

        <a href="#" class="inline-flex items-center text-fg-brand bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-base text-sm px-3 py-2 focus:outline-none">
          Leads Report
          <svg class="w-4 h-4 ms-1.5 -me-0.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/></svg>
        </a>
      </div>
    </div>
  </div>
</template>