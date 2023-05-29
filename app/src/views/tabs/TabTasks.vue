<template>
<ion-page>
    <ion-content :fullscreen="true">
        <top-bar title="Place Tasks" :menu="true"></top-bar>
        <ion-grid>
            <ion-row>
                <ion-col @click="obj.select = !obj.select" class="member-col" size="auto" v-for="obj in members" :key="obj" :style="obj.select ? 'background: #AAAAAA;' : 'background: #DDDDDD;'">
                    <div class="member-bg">
                        <img :src="this.getIcon(obj.select ? 'profile_select.svg' : 'profile_select2.svg')" alt="">
                        <p class="member-text">{{ obj.member.name }}</p>
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
import {DefaultTaskFilter, TaskFilter} from "@/types";
import TaskList from "@/components/TaskList.vue";
import {store} from "@/store";

export default defineComponent({
    components: { TaskList, TopBar },
    data() {
        return {
            members: [] as {member: object, select: boolean}[],
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
        const m = JSON.parse(localStorage.getItem('roomUsers'));
        this.members = [];
        console.log(m);
        for(let i=0; i < m.length; i++) {
            this.members[i] = {member: m[i], select: false};
        }
        console.log(this.members);
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
    border-radius: 10px;
    margin: 0 2px;
    user-select: none;
}



</style>