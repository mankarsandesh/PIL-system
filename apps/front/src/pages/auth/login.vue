<template>
   <main id="main" class="main" style="margin-top: 10%">
      <section class="login flex-nowrap container">
         <div
            class="surface-card p-4 shadow-2 border-round w-full lg:w-4 mx-auto"
         >
            <div class="text-center mb-5">
               <img
                  src="/assets/images/true-panda.jpeg"
                  alt="Image"
                  height="50"
                  class="mb-3"
               />
               <div class="text-900 text-3xl font-medium mb-3">PIL System</div>
            </div>

            <form
               class="login-form temporary-primary-bg"
               @submit.prevent.stop="submitAuthenticateUser"
            >
               <div v-if="errorMessage">{{ errorMessage }}</div>

               <label for="email1" class="block text-900 font-medium mb-2"
                  >Email</label
               >

               <InputText
                  v-model="username"
                  :placeholder="$t('pages.auth.login.username')"
                  type="text"
                  class="w-full mb-3"
               />

               <label for="password1" class="block text-900 font-medium mb-2"
                  >Password</label
               >
               <InputText
                  v-model="password"
                  :placeholder="$t('pages.auth.login.password')"
                  type="password"
                  class="w-full mb-3"
               />

               <div
                  class="flex align-items-center justify-content-between mb-6"
               >
                  <a
                     class="font-medium no-underline ml-2 text-blue-500 text-right cursor-pointer"
                     >Forgot password?</a
                  >
               </div>

               <Button
                  type="submit"
                  class="w-full"
                  icon="pi pi-user"
                  :disabled="loading"
               >
                  <span v-if="loading">
                     <i
                        class="pi pi-spin pi-spinner"
                        style="font-size: 18px"
                     ></i>
                     Loading...
                  </span>
                  <span v-else> &nbsp; {{ $t("pages.auth.login.ok") }}</span>
               </Button>
            </form>
         </div>
      </section>
   </main>
</template>
<script lang="ts" setup>
import { ref } from "vue";
import { useAuthUser } from "~/store/auth";
import type { AppFetch } from "~/types/AppFetch";
import useBasicError from "~/composables/useBasicError";
import useInternalUrl from "~/composables/url/useInternalUrl";

definePageMeta({
   layout: "anonymous",
   middleware: ["redirect-authenticated"],
});

const loading = ref(false);

const authStore = useAuthUser();
const route = useRoute();
const { errorMessage, setError, resetError } = useBasicError();
/**
 *
 *  If we’re using ref or reactive to store our state, they don’t get saved and passed along.
 * So when the client is booted up, they don’t have any value and we need to rerun our setup
 * code on the client.
 *
 *   Normally, this is fine.
 * It only becomes an issue when your ref relies on state from the server,
 * such as a header from the request, or data fetched during the server-rendering process.
 * * */
const username = ref("");
const password = ref("");
const { $appFetch }: { $appFetch: AppFetch<any> } = useNuxtApp();
const internalUrl = useInternalUrl();
const submitAuthenticateUser = async () => {
   loading.value = true;
   resetError();
   try {
      const continueUrl = "" + route.query.returnTo;
      await authStore.authenticateUser(
         username.value,
         password.value,
         $appFetch
      );
      if (route.query.returnTo && internalUrl.isInternalUrl(continueUrl)) {
         return await navigateTo(continueUrl, { external: true });
      }
      loading.value = false;

      return await navigateTo("/");
   } catch (e: any) {
      loading.value = false;
      await setError(e);
   }
};
</script>
<style scoped>
</style>