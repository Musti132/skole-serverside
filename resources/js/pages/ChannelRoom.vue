<template>
    <v-container fluid>
        <h1>Room name</h1>
        <v-card
            max-width="100%"
            max-height="500"
            outlined
            scroll
            class="scroll"
        >
            <v-list-item three-line>
                <v-list-item-content>
                    <div class="text-overline mb-4">Messages</div>
                    <v-row
                        no-gutters
                        v-for="message in channel.messages"
                        :key="message.id"
                    >
                        <v-col
                            v-if="message.user_id !== user.id"
                            cols="12"
                            md="12"
                            class="mb-2 d-flex justify-start"
                        >
                            <v-card color="white" max-width="25%" class="pa-2">
                                <v-card-title v-if="channel.ai">
                                    {{ channel.ai.name }}
                                </v-card-title>
                                <v-card-title v-else>
                                    {{ message.user.name }}
                                </v-card-title>
                                <v-card-text>
                                    <p>
                                        {{ message.message }}
                                    </p>
                                </v-card-text>
                                <v-card-subtitle>
                                    {{ message.created_at }}
                                </v-card-subtitle>
                            </v-card>
                        </v-col>
                        <v-col
                            v-else
                            cols="12"
                            md="12"
                            class="mb-2 d-flex justify-end"
                        >
                            <v-card color="black" max-width="25%" class="pa-2">
                                <v-card-title> {{ user.name }} </v-card-title>
                                <v-card-text>
                                    <p>
                                        {{ message.message }}
                                    </p>
                                </v-card-text>
                                <v-card-subtitle>
                                    {{ message.created_at }}
                                </v-card-subtitle>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-list-item-content>

                <v-list-item-avatar
                    tile
                    size="80"
                    color="grey"
                ></v-list-item-avatar>
            </v-list-item>
        </v-card>

        <v-form class="mt-4">
            <v-row no-gutters>
                <v-col cols="12" md="12">
                    <v-textarea
                        rows="2"
                        name="message"
                        label="Message"
                        hint="Type your message here"
                    ></v-textarea>
                </v-col>

                <v-col cols="12" align="end">
                    <v-btn @click="sendMessage">Send</v-btn>
                </v-col>
            </v-row>
        </v-form>
    </v-container>
</template>

<script type="module">
export default {
    data: () => ({
        channel: {},
    }),

    computed: {
        roomId() {
            return this.$route.params.roomId;
        },

        user() {
            return this.$store.state.auth.user;
        },
    },

    created() {
        this.getChannel(this.roomId);
    },

    mounted() {
        window.Echo.private("channel-" + this.roomId) //Should be Channel Name
            .listen("test-event", (e) => {
                if (this.content.id == e.id) {
                    e.type == 1 ? this.count++ : this.count--;
                }
            });
    },

    methods: {
        getChannel(roomId) {
            this.$store.dispatch("channel/getChannelRoom", roomId).then(() => {
                this.channel = this.$store.getters["channel/getChannel"];
            });

            //console.log(this.$store.state.channel);
        },

        sendMessage(message) {
            this.$store
                .dispatch("channel/sendMessage", message)
                .then((resp) => {
                    console.log("test");
                    console.log(this.$store.getters["channel/getChannel"]);
                });
        },
    },
};
</script>

<style scoped>
.draw-box {
    border-style: solid;
    border-color: red !important;
}

.scroll {
    overflow-y: scroll;
}
</style>