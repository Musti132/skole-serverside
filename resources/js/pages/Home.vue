<template>
    <v-container fluid>
        <v-row>
            <v-col cols="4">
                <v-card dark>
                    <div class="d-flex flex-no-wrap justify-space-between">
                        <div>
                            <v-card-title>OpenAi Bot</v-card-title>
                            <v-card-text
                                >Do you need someone to write a poem? Or perhaps
                                a romantic tinder pickup line, then this is the
                                right bot for you</v-card-text
                            >

                            <v-card-actions>
                                <v-btn
                                    class="ml-2 mt-3"
                                    fab
                                    color="secondary"
                                    variant="flat"
                                    to="channels"
                                    >Start chatting
                                </v-btn>
                            </v-card-actions>
                        </div>

                        <v-avatar class="ma-3" size="85" tile>
                            <v-img
                                src="/assets/open-ai-seeklogo.com.svg"
                            ></v-img>
                        </v-avatar>
                    </div>
                </v-card>
            </v-col>
            <v-col cols="4">
                <v-card dark>
                    <div class="d-flex flex-no-wrap justify-space-between">
                        <div>
                            <v-card-title>Hangout Rooms</v-card-title>
                            <v-card-text
                                >These rooms are for the average beta users, who
                                needs someone to talk to.</v-card-text
                            >

                            <v-card-actions>
                                <v-btn
                                    class="ml-2 mt-3"
                                    fab
                                    color="secondary"
                                    variant="flat"
                                    to="channels"
                                    >Start chatting
                                </v-btn>
                            </v-card-actions>
                        </div>

                        <v-avatar class="ma-3" size="85" tile>
                            <v-icon
                                icon="mdi-chat-outline"
                                color="white"
                                size="55"
                            ></v-icon>
                        </v-avatar>
                    </div>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
import ChatIcon from "../assets/chat-icon.svg";

export default {
    data: () => ({
        ChatIcon,
    }),
};
</script>