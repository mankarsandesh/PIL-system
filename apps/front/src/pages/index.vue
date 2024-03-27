<template>
   <div class="px-5">
      <div class="surface-ground">
         <h2>Dashboard</h2>
         <div class="grid">
            <card v-for="item in items" :key="item" :data="item" />
         </div>
         <h3>Pending Payment Identifier List</h3>
         <div>
            <payments-user-list-not />
         </div>
      </div>
   </div>
</template>
<script lang="ts" setup>
import { ref, onMounted, computed } from "vue";
import useAuthUser from "~/store/auth";
const authStore = useAuthUser();
const items = computed(() => [
   {
      label: "All Payments",
      icon: "pi pi-fw pi-file",
      count: authStore.me?.AllPayment,
      subCount: 24,
      subText: "since last visit",
   },
   {
      label: "Payment  Identified",
      icon: "pi pi-fw pi-money-bill",
      count: authStore.me?.AllPayment - authStore.me?.NotPaymentLabel,
      subCount: 24,
      subText: "since last visit",
   },
   {
      label: "Payment Not Identified",
      icon: "pi pi-fw pi-money-bill",
      count: authStore.me?.NotPaymentLabel,
      subCount: 24,
      subText: "since last visit",
   },
   {
      label: "Total Amount",
      icon: "pi pi-fw pi-money-bill",
      count: "$" + authStore.me?.totalAmount,
      subCount: 24,
      subText: "since last visit",
   },
]);
</script>