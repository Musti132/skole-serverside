<template>
    <v-navigation-drawer expand-on-hover rail>
        <v-list density="compact" nav>
            <v-list-item
                prepend-icon="mdi-home"
                title="Home"
                value="home"
                to="/home"
            ></v-list-item>
            <v-list-item
                prepend-icon="mdi-chat"
                title="Channels"
                value="channels"
                to="/channels"
            ></v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>
<script>
export default {
    data: () => ({
        drawer: false,
        group: null,
        items: [
            {
                title: "Foo",
                value: "foo",
            },
            {
                title: "Bar",
                value: "bar",
            },
            {
                title: "Fizz",
                value: "fizz",
            },
            {
                title: "Buzz",
                value: "buzz",
            },
        ],
    }),

    watch: {
        group() {
            this.drawer = false;
        },
    },
};
</script>
