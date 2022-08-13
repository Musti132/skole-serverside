<template>
    <v-container>
        <v-form ref="form" v-model="valid" lazy-validation>
            <LoginDialog></LoginDialog>
            <v-row class="justify-center">
                <v-col md="6">
                    <v-text-field
                        v-model="email"
                        :rules="emailRules"
                        label="E-mail"
                        required
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row class="justify-center">
                <v-col md="6">
                    <v-text-field
                        v-model="password"
                        :rules="passwordRules"
                        :append-icon="passwordShow ? 'mdi-eye' : 'mdi-eye-off'"
                        :type="passwordShow ? 'text' : 'password'"
                        label="Password"
                        @click:append="passwordShow = !passwordShow"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-col align="center">
                    <v-btn
                        color="secondary"
                        class="white--text"
                        :disabled="!valid"
                        @click="login"
                    >
                        Login
                    </v-btn>
                </v-col>
            </v-row>
        </v-form>
    </v-container>
</template>

<script>
import LoginDialog from '../components/LoginDialog.vue';
export default {
    components: {
        LoginDialog
    },
    data: () => ({
        valid: true,
        password: "",
        passwordRules: [(v) => !!v || "Password is required"],
        passwordShow: false,
        email: "",
        emailRules: [
            (v) => !!v || "E-mail is required",
            (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
        ],
    }),

    computed: {
        isLoggedIn() {
           return this.$store.state.auth.status.loggedIn;
        }
    },

    created() {
        console.log(this.isLoggedIn());
        if (this.isLoggedIn) {
            this.$router.push('/');
        }
    },

    methods: {
        login() {
            this.$refs.form.validate();
            if (!this.valid) {
                return 0;
            }

            this.ajax.post('/api/v1/auth/login', {
                email: this.email,
                password: this.password,
            }).then((resp) => {
                console.log(resp)
                //this.$router.push('/');
            }).catch(() => {
                console.log();
            });
        },
        reset() {
            this.$refs.form.reset();
        },
        resetValidation() {
            this.$refs.form.resetValidation();
        },
    },
};
</script>