<template>
   <div>
      <div
         v-show="pending"
         v-t="{ path: 'components.payment.list.pending' }"
      ></div>
      <div v-show="error">{{ error }}}</div>
      {{ errorDelete }}
      <table v-if="UserPayment" id="users">
         <thead>
            <tr>
               <th>{{ $t("components.payment.list.id") }}</th>
               <th>{{ $t("components.payment.list.date") }}</th>
               <th>{{ $t("components.payment.list.code") }}</th>
               <th>{{ $t("components.payment.list.amount") }}</th>
               <th>{{ $t("components.payment.list.payment_label") }}</th>
               <th>{{ $t("components.payment.list.localization") }}</th>
               <th>{{ $t("components.payment.list.status") }}</th>
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
               <td>
                  {{
                     data.payment?.payment_label
                        ? data.payment?.payment_label
                        : "NO Payment Label"
                  }}
               </td>
               <td>
                  <Button
                     v-if="!data.payment"
                     @click="updateUser(data)"
                     class="p-2 text-sm"
                  >
                     Payment Identifier
                  </Button>
                  <span v-lese>
                     {{ data.payment?.localization }}
                  </span>
               </td>
               <td>{{ data.status }}</td>
            </tr>
         </tbody>
      </table>
      <model
         v-show="showModal"
         @close-modal="showModal = false"
         @user-selected="handleSubmitLocation"
         :select_user="selectUser"
      />
   </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { useI18n } from "vue-i18n";
import type { UserPayment } from "~/types/User/UserPayment";
import useAuthUser from "~/store/auth";
import useListUsersPaymentNot from "~/composables/api/user/useListUsersPaymentNot";
import useDeleteUser from "~/composables/api/user/useDeleteUser";
import type { User } from "~/types/User";

const authStore = useAuthUser();
const showModal = ref(false);
const selectUser = ref({});
const {
   data: UserPayment,
   error,
   pending: pending,
   refresh: userPaymentRefresh,
} = await useListUsersPaymentNot();

function updateUser(data) {
   showModal.value = true;
   const user = {
      user_payment_id: data.id,
   };
   selectUser.value = user;
}
const handleSubmitLocation = () => {
   showModal.value = false;
   useListUsersPaymentNot();
};

// Delete code
// const deleteUserClick = async (user: User) => {
//    try {
//       await deleteUser(user);
//       refresh();
//    } catch (e) {
//       logger.error(e);
//       throw e;
//    }
// };
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
