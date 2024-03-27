<template>
   <div class="col-12 md:col-6 lg:col-3">
      <div class="surface-card shadow-2 p-3 border-round">
         <div class="flex justify-content-between mb-3">
            <div>
               <span class="block text-500 font-medium mb-3">{{
                  props.data.label
               }}</span>
               <div class="text-900 font-medium text-xl">
                  {{ props.data.count }}
               </div>
            </div>
            <div
               class="flex align-items-center justify-content-center bg-blue-100 border-round"
               style="width: 2.5rem; height: 2.5rem"
            >
               <i :class="[props.data.icon + ' text-blue-500 text-xl']"></i>
            </div>
         </div>
         <span class="text-green-500 font-medium"
            >{{ props.data.count }} new
         </span>
         <span class="text-500">{{ props.data.subText }} </span>
      </div>
   </div>
</template>

<script setup lang="ts">
import { ref, onMounted, defineProps } from "vue";
const props = defineProps(["data"]);
</script>