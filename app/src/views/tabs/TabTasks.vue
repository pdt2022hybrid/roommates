<template>
<ion-page>
    <ion-content :fullscreen="true">
        <top-bar title="Place Tasks" :menu="true"></top-bar>
        <ion-grid>
            <ion-row>
                <ion-col class="member-col" size="auto" v-for="member in members" :key="member">
                    <div class="member-bg">
                        <img :src="this.getIcon('icon_user.svg')" alt="">
                        <p class="member-text">{{ member.name }}</p>
                    </div>
                </ion-col>
            </ion-row>
        </ion-grid>
        <task-list :filter="filter" :key="filter"/>
    </ion-content>
</ion-page>
</template>

<script lang="ts">
import TopBar from '@/components/TopBar.vue';
import { defineComponent } from 'vue';
import {DefaultTaskFilter, placeholderMembers, TaskFilter} from "@/types";
import TaskList from "@/components/TaskList.vue";
import {store} from "@/store";

export default defineComponent({
    components: { TaskList, TopBar },
    data() {
        return {
            members: [],
            filter: DefaultTaskFilter as TaskFilter
        }
    },
    methods: {
        updateFilter(e: TaskFilter) {
            this.filter = e;
        },
        getIcon: function (icon) {
            return require(`@/../resources/${icon}`)
        }
    },
    async mounted() {
        await store.dispatch('storeUsers');
        this.members = JSON.parse(localStorage.getItem('roomUsers'));

    }
});
</script>

<style scoped>

img {
    height: 30px;
    width: 29px;
}

.member-text {
    font-weight: 400;
    font-size: 12px;
    width: 50px;
}

.member-col {
    background: #CCCCCC;
    border-radius: 10px;
    margin: 0 2px;
}



</style>