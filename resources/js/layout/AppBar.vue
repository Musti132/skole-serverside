<template>
    <v-app-bar color="" prominent>

        <v-toolbar-title>SuperChat</v-toolbar-title>

        <v-spacer></v-spacer>
        <div v-if="!isLoggedIn">
            <LoginDialog align="end"></LoginDialog>
        </div>

        <div v-else>
            <v-btn flat @click="logout">Logout</v-btn>
        </div>
    </v-app-bar>
</template>

<script>
import LoginDialog from '../components/LoginDialog.vue';
export default {
    components: {
        LoginDialog
    },

    computed: {
        isLoggedIn() {
            return this.$store.state.auth.status.loggedIn;
        }
    },

    methods: {
        logout() {
            this.$store.dispatch("auth/logout");
        }
    }
}
</script>