export type UserPaymentId = number;
export interface UserPayment {
    id: UserPaymentId;
    code: string;
    gps_location: string;
    amount: number;
    currency: string;
    status: string;
    user: Array<User>,
    date_time: Array<Date>;
}
