<template>
    <v-container fluid>
        <h1>{{ channel.name }}</h1>
        <v-row class="mb-4">
            <v-col class="d-flex justify-end">
                People here: {{ userCount }}
            </v-col>
        </v-row>
        <v-card
            max-width="100%"
            max-height="500"
            outlined
            class="scroll"
            id="chatBox"
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
                        ref="message"
                        rows="2"
                        name="message"
                        label="Message"
                        hint="Type your message here"
                        :loading="is_loading"
                        :disabled="is_loading"
                        @keydown.enter="sendMessage"
                    ></v-textarea>
                </v-col>
            </v-row>
        </v-form>
    </v-container>
</template>

<script>
export default {
    data: () => ({
        channel: {},
        userCount: 0,
        message: null,
        is_loading: false,
        interval: null,
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

        window.Echo.private("channel-" + this.roomId).listen(
            ".message.sent",
            (e) => {
                this.channel.messages.push(e.message);
                this.scrollChat();
            }
        );

        window.Echo.join("users-channel-" + this.roomId)
            .here((users) => {
                console.log(users);
                this.userCount = users.length;
            })
            .joining((user) => {
                this.userCount += 1;
            })
            .leaving((user) => {
                this.userCount -= 1;
            });
    },

    mounted() {
    },

    methods: {
        scrollChat() {
            let element = document.querySelector("#chatBox");
            var scrollHeight = element.scrollHeight;
            element.scrollTop = scrollHeight * 2;
        },

        getChannel(roomId) {
            this.$store.dispatch("channel/getChannelRoom", roomId).then(() => {
                this.channel = this.$store.getters["channel/getChannel"];
            });
        },

        async sendMessage() {
            this.is_loading = true;
            var message = this.$refs.message.value;

            await this.$store
                .dispatch("channel/sendMessage", {
                    id: this.roomId,
                    message: message,
                })
                .then((resp) => {
                    this.channel.messages.push(resp.data);
                    this.scrollChat();
                    this.is_loading = false;
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
    display: flex !important;
    flex-direction: column;
    overflow-y: scroll !important;
}
</style>