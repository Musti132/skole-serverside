<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent>
            <template v-slot:activator="{ props }">
                <v-btn variant="flat" v-bind="props" prepend-icon="mdi-account"> Login </v-btn>
            </template>
            <v-card min-width="500px">
                <v-card-title>
                    <span class="text-h5">Login</span>
                </v-card-title>
                <v-card-text>
                    <v-form refs="form" v-model="valid" lazy-validation>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="6" md="12">
                                <v-text-field
                                    v-model="email"
                                    :rules="emailRules"
                                    label="E-mail"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="12">
                                <v-text-field
                                    v-model="password"
                                    :rules="passwordRules"
                                    :append-icon="
                                        passwordShow ? 'mdi-eye' : 'mdi-eye-off'
                                    "
                                    :type="passwordShow ? 'text' : 'password'"
                                    label="Password"
                                    @click:append="passwordShow = !passwordShow"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                    </v-form>
                    <small>*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue-darken-1" text @click="dialog = false">
                        Close
                    </v-btn>
                    <v-btn color="secondary" flat @click="login">
                        Login
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>
<script>
export default {
    data() {
        return {
            dialog: false,
            valid: true,
            password: "",
            passwordRules: [(v) => !!v || "Password is required"],
            passwordShow: false,
            email: "",
            emailRules: [
                (v) => !!v || "E-mail is required",
                (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
            ],
        };
    },
    
    computed: {
        loggedIn() {
            return this.$store.state.auth.status.loggedIn;
        },
    },
    methods: {
        login() {
            this.$store.dispatch("auth/login", {
                email: this.email,
                password: this.password,
            }).then((resp) => {
                console.log(resp);
            });
        },
    },
};
</script>