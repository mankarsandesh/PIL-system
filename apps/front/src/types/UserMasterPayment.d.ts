export type UserPaymentId = number;
export interface UserMasterPayment {
    id: UserPaymentId;
    user_payment_id: string;
    payment_label: string;
    description: number;
    localization: string;
    gps_location: string;
}
