<template>
<ion-page>
    <top-bar title="Calendar" :menu="true"></top-bar>
    <ion-content :fullscreen="true">
        <ion-datetime :value="date" v-model="date" presentation="date" :multiple="false" :highlighted-dates="highlightedDates"></ion-datetime>
        <task-list :filter="filter" :key="filter" @refresh="refresh()"/>
    </ion-content>
</ion-page>
</template>

<script lang="ts">
import TopBar from '@/components/TopBar.vue';
import {IonDatetime} from "@ionic/vue";
import TaskList from "@/components/TaskList.vue";
import { defineComponent } from 'vue';
import {DefaultTaskFilter, TaskFilter} from "@/types";
import {store} from "@/store";

export default defineComponent({
    components: { TopBar, IonDatetime, TaskList },
    data() {
        return {
            filter: DefaultTaskFilter as TaskFilter,
            highlightedDates: [] as {date: string, textColor: string, backgroundColor: string, statusId: number}[],
            date: '',
        }
    },
    methods: {
        updateFilter(e: TaskFilter) {
            this.filter = e;
        },
        getHighlightColor(date: string, statusId: number) {
            switch(statusId) {
                case 1:
                    return {date: date, textColor: '#FFFFFF', backgroundColor: '#e94b4b77', statusId: statusId};
                case 2:
                    return {date: date, textColor: '#FFFFFF', backgroundColor: '#2980b977', statusId: statusId};
            }
        },
        async refresh() {
            await store.dispatch('storeTasks');
            const tasks = JSON.parse(localStorage.getItem('roomTasks'));
            for(let i=0; i < tasks.length; i++) {
                this.highlightedDates[i] = this.getHighlightColor(tasks[i].deadline.split('T')[0], tasks[i].status.id);
            }
            await store.dispatch('loaded');
            console.log(tasks);
        }
    },
    async mounted() {
        await this.refresh();
    }
});
</script>