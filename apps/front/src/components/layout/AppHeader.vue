<template>
   <div class="grid">
      <div class="col">
         <h3 class="logo">PIL System</h3>
      </div>
      <div class="col"></div>
      <div class="col">
         <div class="flex" style="justify-content: end">
            <p
               v-if="authStore.me?.data?.email"
               v-t="{
                  path: 'components.layout.appHeader.welcome',
                  args: { username: authStore.me?.data.email },
               }"
            ></p>
            <span class="scoreStyle"> {{ authStore.me?.score }} score</span>
         </div>
      </div>
   </div>
</template>
<script setup lang="ts">
import { useAuthUser } from "~/store/auth";

const authStore = useAuthUser();
</script>
<style scoped>
.logo {
   font-size: 24px;
   font-weight: bold;
   color: rgb(154, 168, 0);
   margin: 10px 10px;
}
.scoreStyle {
   font-size: 16px;
   background-color: rgb(154, 168, 0);
   color: white;
   font-weight: bold;
   padding: 2px 14px;
   margin: 10px 10px;
   height: 30px;
   align-content: center;
   border-radius: 10px;
}
</style>