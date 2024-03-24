import {POST} from "~/constants/http";
import type {UserMasterPayment} from "~/types/UserMasterPayment";
import useBasicError from "~/composables/useBasicError";

type UserInput = Omit<User, "id"> & {
    password: string;
};
export default function useUserPaymentLink() {
    const {$appFetch} = useNuxtApp();

    const {setError, resetError, errorMessage, error, violations} =
        useBasicError();

    return {
        errorMessage,
        error,
        violations,
        async paymentLinkRequest(user: UserMasterPayment) {
            try {
                resetError();
                const response = await $appFetch<UserMasterPayment>("/payment/link", {
                    method: POST,
                    body: user,
                });
                if (!response) {
                    throw createError("Error while registering user");
                }
                return response;
            } catch (e: any) {
                setError(e);
                throw e;
            }
        },
    };
}
