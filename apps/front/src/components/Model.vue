<template>
   <transition name="modal-fade" class="model">
      <div class="modal-overlay" @click="$emit('close-modal')">
         <div class="modal" @click.stop>
            <h2>Update Payment Link</h2>
            <div class="model_view">
               <form>
                  <div class="error">{{ error }}</div>
                  <div class="form">
                     <div>Payment Label <span class="error">*</span></div>
                     <input
                        type="text"
                        name="payment_label"
                        placeholder="Payment Label"
                        v-model="payment_label"
                        class="form-control"
                     />
                  </div>
                  <div class="form">
                     <div>Payment Description <span class="error">*</span></div>
                     <textarea
                        name="payment_description"
                        placeholder="Payment Description"
                        class="form-control"
                        rows="4"
                        cols="50"
                        v-model="payment_description"
                     />
                  </div>

                  <div class="form">
                     <div>Localization {{ gps_location }}</div>
                     <input
                        type="text"
                        name="payment_label"
                        placeholder=" Localization"
                        v-model="localization"
                        disabled="true"
                        class="form-control disabled"
                     />
                  </div>

                  <button type="submit" @click.prevent="handleSubmitLocation">
                     {{ loading ? "Loading..." : "Add location" }}
                  </button>
               </form>

               <div class="image_map">
                  <img
                     src="`~/assets/images/map.png`"
                     alt="panda"
                     @click="setGPSlocation()"
                  />
                  <p>
                     <small class="error">
                        Click on image and get GPS_location</small
                     >
                  </p>
               </div>
            </div>
         </div>
         <div class="close" @click="$emit('close-modal')"></div>
      </div>
   </transition>
</template>

<script setup lang="ts">
import { ref, onMounted, defineProps } from "vue";
const payment_label = ref("");
const payment_description = ref("");
const localization = ref("");
const gps_location = ref("");
const loading = ref(false);
const error = ref("");
const props = defineProps(["select_user"]);
const setGPSlocation = () => {
   gps_location.value = "48.8396898,1.9781491";
   localization.value = "251 Rue Saint-Honoré, 75001 Paris, France";
};

const handleSubmitLocation = () => {
   loading.value = true;
   if (
      !payment_label.value ||
      !payment_description.value ||
      !localization.value
   ) {
      error.value = "Please fill all fields";
      loading.value = false;
      return;
   }
   const paymentLink = {
      payment_label: payment_label.value,
      payment_description: payment_description.value,
      localization: localization.value,
      date_time: new Date(),
      user_id: props.select_user?.user_id,
   };
   console.log(paymentLink, "PaymentLink");
   loading.value = false;
};
</script>


<style scoped lang="scss">
.error {
   color: red;
   font-size: 14px;
   margin-left: 5px;
}
.disabled {
   background-color: #f2f2f2;
}
.image_map {
   width: 60%;
   justify-content: center;
}
.image_map img {
   cursor: pointer;
   width: 80%;
   border-radius: 10px;
   margin-left: 10%;
}
.form label {
   margin-right: 10px;
}
form {
   display: flex;
   flex-direction: column;
   width: 40%;
}
.form-row {
   display: flex;
   //    max-width: 50%;
}
.model_view {
   display: flex;
   flex-direction: row;
}
.form {
   //    max-width: 50%;
   align-items: center;
   font-size: 16px;
   margin-right: 10px;
   padding: 5px;
}

.form-control {
   width: 100%;
   height: 40px;
   border: 1px solid #dfdfdf;
   border-radius: 10px;
   padding: 10px;
   margin: 10px 0;
}
.modal-overlay {
   position: fixed;
   top: 0;
   bottom: 0;
   left: 0;
   right: 0;
   display: flex;
   justify-content: center;
   background-color: #000000da;
}

.modal {
   background-color: white;
   height: 500px;
   width: 70%;
   margin-top: 8%;
   padding: 20px 30px;
   border-radius: 20px;
}

.close {
   margin: 10% 0 0 16px;
   cursor: pointer;
}

.close-img {
   width: 25px;
}

.check {
   width: 150px;
}

h6 {
   font-weight: 500;
   font-size: 28px;
   margin: 20px 0;
}

p {
   /* font-weight: 500; */
   font-size: 16px;
   margin: 20px 0;
}

button {
   background-color: #335465;
   width: 150px;
   height: 40px;
   color: white;
   font-size: 16px;
   border: none;
   cursor: pointer;
   border-radius: 10px;
}

.modal-fade-enter,
.modal-fade-leave-to {
   opacity: 0;
}

.modal-fade-enter-active,
.modal-fade-leave-active {
   transition: opacity 0.5s ease;
}
</style>