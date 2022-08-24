<template>
    <v-container>
        <v-table theme="dark">
            <thead centered align="center">
                <tr>
                    <th>Room Name</th>
                    <th>Description</th>
                    <th>AI</th>
                    <th>AI Type</th>
                    <th>Created</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in data" :key="item.id" align="center">
                    <td>{{ item.name }}</td>
                    <td>{{ item.description }}</td>
                    <td>
                        <v-icon v-if="item.is_ai" color="green"
                            >mdi-check</v-icon
                        >
                        <v-icon v-else color="red">mdi-close</v-icon>
                    </td>
                    <td v-if="item.ai !== null">
                        {{ item.ai.name }}
                    </td>
                    <td v-else>
                        <v-icon color="red">mdi-close</v-icon>
                    </td>
                    <td>{{ item.created_at }}</td>
                    <td><v-btn v-if="!item.is_ai" :to="{
                                name: 'ChannelRoom',
                                params: { roomId: item.id },
                            }" color="secondary">Chat</v-btn>
                            <v-btn v-else :to="{
                                name: 'ChannelRoomAi',
                                params: { roomId: item.id },
                            }" color="secondary">Chat</v-btn>
                            </td>
                </tr>
            </tbody>
        </v-table>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            data: {},
            desserts: [
                {
                    name: "Frozen Yogurt",
                    calories: 159,
                },
                {
                    name: "Ice cream sandwich",
                    calories: 237,
                },
            ],
        };
    },

    mounted() {
        this.getData();
        console.log(this.data);
    },

    methods: {
        getData() {
            this.axios.get("/api/v1/channels").then((response) => {
                this.data = response.data.data;
            });
        },
    },
};
</script>