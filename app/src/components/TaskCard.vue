<template>
    <ion-card>
        <ion-card-header style="padding-top: 5px; padding-bottom: 10px;">
            <ion-card-title style="padding-top: 5px;">
                <ion-grid>
                    <ion-row class="ion-justify-content-between">
                        <ion-col size="auto">
                            {{ task.name }}
                        </ion-col>
                        <ion-col size="auto" class="status" :style="{ background: task.status.color, userSelect: 'none' }">
                            {{ task.status.name.toUpperCase() }}
                        </ion-col>
                    </ion-row>
                </ion-grid>
            </ion-card-title>
            <ion-card-subtitle>
                <img v-if="this.hasIcon" :src="this.icon" alt="">
                {{ new Date(Date.parse(task.deadline)).toLocaleDateString("sk-SK") }}
            </ion-card-subtitle>
        </ion-card-header>

        <ion-card-content style="padding-bottom: 2px">
            <span style="color: #2FDF75">BY: </span>{{ task.user_created.name.toUpperCase() }}
        </ion-card-content>
    </ion-card>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { Task, getPresetRoom } from '@/types'
export default defineComponent({
    name: "TaskCard",
    props: {
        task: Object,
    },
    data() {
        return {
            hasIcon: false,
            icon: null
        }
    },
    methods: {
        getIcon: function () {
            this.hasIcon = false;
            if(this.task?.room) {
                const room = getPresetRoom(this.task.room);
                if(room?.icon) {
                    this.icon = require(`@/../resources/${room.icon}`);
                    this.hasIcon = true;
                }
            } else {
                this.icon = require(`@/../resources/room_custom.svg`);
                this.hasIcon = true;
            }
        }
    },
    mounted() {
        this.getIcon();
    }
})
</script>

<style scoped>
.status {
    padding: 0 7px;
    border-radius: 5px;
    font-family: 'Noto Sans', sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 10px;
    line-height: 16px;
    align-items: center;
    text-align: right;
    letter-spacing: 1.5px;
    color: #FFFFFF;
}

ion-card {
    text-align: left;
}
ion-card-header {
    display: flex;
    flex-flow: column-reverse;
}
ion-card-title {
    font-weight: 500;
    font-size: 14px;
    line-height: 16px;
    letter-spacing: 1.5px;
}
ion-card-subtitle {
    color: #EC445A;
}

ion-grid, ion-col {
    padding: 0;
}
</style>