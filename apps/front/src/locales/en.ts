export default {
    components: {
        form: {
            registerPasswordInput: {
                password: "Password",
                suggestions: "With:",
                suggestionsLowercase: "At least 2 lowercase",
                suggestionsUppercase: "At least 2 uppercase",
                suggestionsNumber: "At least 2 numbers",
                suggestionsSymbol: "At least 1 symbol",
                suggestionsSize: "Minimum 8",
                suggestionsUnicity: "Unique character",
            },
        },
        user: {
            createForm: {
                title: "Create a new user",
                ok: "Create",
                buttonCancel: "Cancel",
            },
            updateForm: {
                pending: "Loading user",
                title: "Update {email}",
                ok: "Update",
            },
            form: {
                email: "Email",
                passwordConfirm: "Confirm your password",
                errorPasswordConfirm: "The confirmation of the password is invalid",
                buttonCancel: "Cancel",
                ok: "Save",
            },
            list: {
                createButton: "New user",
                pending: "Loading users",
                title: "User",
                id: "Id",
                email: "Email",
                username: "Username",
                role: "Role",
                action: "Action",
                edit: "Edit",
                delete: "Delete",
                ROLE_USER: "Role User",
                ROLE_ADMIN: "Role Admin",
            },
        },
        payment: {
            title: "Payment",
            pending: "Loading payments",
            list: {
                id: "Id",
                date: "Date",
                code: "Code",
                amount: "Amount",
                payment_label: "Payment Label",
                localization: "Localization",
                status: "Status",
                pending: "Pending",
            },
        },
        layout: {
            appHeader: {
                welcome: "Welcome {username}",
            },
            menu: {
                appMenu: {
                    dashboard: "Dashboard",
                    users: "Users",
                    payments: "Payments",
                    page1: "page1",
                    page2: "page2",
                    validation: "validation",
                    quit: "Quit",
                },
            },
        },
        demo: {
            validation: {
                form: {
                    startDate: "Date de début",
                    textField: "Champ texte",
                    siret: "Siret",
                    nestedDemoEntityName: "Nom de l'entité imbriquée",
                },
            },
        },
    },
    pages: {
        page1: {
            altPanda: "This is to discover images",
            background: "This is to discover background",
        },
        auth: {
            login: {
                username: "Email",
                password: "Password",
                title: "Please log-in",
                ok: "Submit",
            },
        },
        user: {
            index: {
                createButton: "Create an user",
            },
        },
    },
    plugins: {
        appFetch: {
            toasterUnauthorizedDetail: "Unauthorized",
            toasterUnauthorizedSummary: "Unauthorized",

            toasterForbiddenDetail: "Forbidden",
            toasterForbiddenSummary: "Forbidden",

            toasterCatchAllDetail: "Error",
            toasterCatchAllSummary: "Error",
        },
        error: {
            toasterCatchAllDetail: "Error",
            toasterCatchAllSummary: "Error",
        },
    },
};
