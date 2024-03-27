<template>
   <div>
      <div
         v-show="usersPending"
         v-t="{ path: 'components.user.list.pending' }"
      ></div>
      <div v-show="error">{{ error }}</div>
      {{ errorDelete }}
      <table v-if="users" id="users">
         <thead>
            <tr>
               <th>{{ $t("components.user.list.id") }}</th>
               <th>{{ $t("components.user.list.username") }}</th>
               <th>{{ $t("components.user.list.email") }}</th>
               <th>{{ $t("components.user.list.role") }}</th>
               <th>{{ $t("components.user.list.action") }}</th>
            </tr>
         </thead>
         <tbody>
            <tr v-for="(user, index) in users" :key="user.id">
               <td>{{ index + 1 }}</td>
               <td>{{ user.username }}</td>
               <td>{{ user.email }}</td>
               <td>
                  {{ $t("components.user.list." + user.roles.toString()) }}
               </td>
               <td>
                  <NuxtLink
                     v-if="!authStore.isAuthUser(user)"
                     :to="`/users/${user.id}`"
                  >
                     <Button severity="secondary">{{
                        $t("components.user.list.edit")
                     }}</Button>
                  </NuxtLink>
                  <Button
                     v-if="!authStore.isAuthUser(user)"
                     severity="danger"
                     @click="deleteUserClick(user)"
                  >
                     {{ $t("components.user.list.delete") }}
                  </Button>
               </td>
            </tr>
         </tbody>
      </table>
   </div>
</template>

<script setup lang="ts">
import type { User } from "~/types/User";
import useAuthUser from "~/store/auth";
import useListUsers from "~/composables/api/user/useListUsers";
import useDeleteUser from "~/composables/api/user/useDeleteUser";

const authStore = useAuthUser();
const { deleteUser, errorMessage: errorDelete } = useDeleteUser();

const {
   data: users,
   error,
   pending: usersPending,
   refresh: usersRefresh,
} = await useListUsers();

const deleteUserClick = async (user: User) => {
   try {
      await deleteUser(user);
      usersRefresh();
   } catch (e) {
      logger.error(e);
      throw e;
   }
};
</script>

<style scoped lang="scss">
#users {
   font-family: Arial, Helvetica, sans-serif;
   border-collapse: collapse;
   width: 100%;
   margin-top: 10px;
}
#users td,
#users th {
   border: 1px solid #ddd;
   padding: 8px;
}

#users tr:nth-child(even) {
   background-color: #f2f2f2;
}

#users tr:hover {
   background-color: #ddd;
}

#users th {
   padding-top: 12px;
   padding-bottom: 12px;
   text-align: left;
   background-color: #04aa6d;
   color: white;
}
</style>
