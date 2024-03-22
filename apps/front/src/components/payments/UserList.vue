<template>
   <div>
      <div
         v-show="pending"
         v-t="{ path: 'components.user.list.pending' }"
      ></div>
      <div v-show="error">{{ error }}}</div>
      {{ errorDelete }}
      <table v-if="UserPayment" id="users">
         <thead>
            <tr>
               <th>Id</th>

               <th>Date</th>
               <th>Code</th>
               <th>Amount</th>
               <th>Payments Label</th>
               <th>Localization</th>
               <th>Status</th>
            </tr>
         </thead>
         <tbody>
            <tr v-for="(data, index) in UserPayment" :key="data.id">
               <td>{{ index + 1 }}</td>

               <td>
                  {{ new Date(data.date_time.date).toJSON() }}
               </td>
               <td>{{ data.code }}</td>
               <td>{{ data.amount }} {{ data.currency }}</td>
               <td>{{ data.status }}</td>
               <td>
                  <Button> Payment Identifier </Button>
               </td>
               <td>{{ data.status }}</td>
            </tr>
         </tbody>
      </table>
   </div>
</template>

<script setup lang="ts">
import type { UserPayment } from "~/types/User/UserPayment";
import useAuthUser from "~/store/auth";
import useListUsersPayment from "~/composables/api/user/useListUsersPayment";
import useDeleteUser from "~/composables/api/user/useDeleteUser";
import type { User } from "~/types/User";

const authStore = useAuthUser();
const { deleteUser, errorMessage: errorDelete } = useDeleteUser();

const {
   data: UserPayment,
   error,
   pending: pending,
   refresh: refresh,
} = await useListUsersPayment();

console.log(UserPayment, "data");

const deleteUserClick = async (user: User) => {
   try {
      await deleteUser(user);
      refresh();
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
