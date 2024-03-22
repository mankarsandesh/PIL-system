import type {UserPayment} from "~/types/UserPayment";
import {GET} from "~/constants/http";
import useAppFetch from "~/composables/useAppFetch";

export default async function useListUserPayment() {
    return useAppFetch<Array<UserPayment>>(() => "/user/payments", {
        key: "listUserPayments",
        method: GET,
        lazy: true,
    });
}
