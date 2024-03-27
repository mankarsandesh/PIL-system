<template>
   <div v-if="authStore.me?.data.roles.toString() === 'ROLE_ADMIN'">
      <div>
         <NuxtLink to="/auth/register"
            ><Button>{{
               $t("pages.user.index.createButton")
            }}</Button></NuxtLink
         >
      </div>
      <UserList />
   </div>
   <div v-else>
      <h2>You don't have persmission. Contact your Admin</h2>
   </div>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from "vue";
import useAuthUser from "~/store/auth";
const authStore = useAuthUser();
</script>

<style scoped lang="scss"></style>
