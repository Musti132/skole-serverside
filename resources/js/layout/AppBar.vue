<template>
    <v-app-bar color="" prominent>

        <v-toolbar-title>SuperChat</v-toolbar-title>

        <v-spacer></v-spacer>

        <LoginDialog align="end"></LoginDialog>
    </v-app-bar>
</template>

<script>
import LoginDialog from '../components/LoginDialog.vue';
export default {
    components: {
        LoginDialog
    },
}
</script>