<template>
   <div class="grid">
      <div class="col-2 col-offset-8"></div>
      <div class="col-2">
         <div class="flex">
            <p
               v-if="authStore.me?.data?.email"
               v-t="{
                  path: 'components.layout.appHeader.welcome',
                  args: { username: authStore.me?.data.email },
               }"
            ></p>
            <span class="scoreStyle"> {{ authStore.me?.score }}</span>
         </div>
      </div>
   </div>
</template>
<script setup lang="ts">
import { useAuthUser } from "~/store/auth";

const authStore = useAuthUser();
</script>
<style scoped>
.scoreStyle {
   font-size: 2rem;
   color: rgb(154, 168, 0);
   padding: 12px;
}
</style>