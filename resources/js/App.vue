<template>
    <v-layout>
        <AppBar></AppBar>
        <Menu></Menu>
        <v-main>
            <router-view></router-view>
        </v-main>
    </v-layout>
</template>

<script>
import Menu from './layout/Menu.vue';
import AppBar from './layout/AppBar.vue'

export default {
    name: "App",
    components: {
        Menu,
        AppBar
    },
    data: () => ({
        //
    }),
};
</script>
