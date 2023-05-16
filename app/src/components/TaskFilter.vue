<template>
    <ion-page class="overlay" v-if="show">
        <ion-content :fullscreen="true">
        <ion-card class="title-card">
            <ion-card-header>
                <ion-card-title>
                    <ion-grid>
                        <ion-row>
                            <ion-col size="auto">
                                <ion-icon @click="this.submit()" :icon="close" style="font-size: 24px;"></ion-icon>
                            </ion-col>
                            <ion-col class="title">
                                Filters
                            </ion-col>
                        </ion-row>
                    </ion-grid>
                </ion-card-title>
            </ion-card-header>
        </ion-card>
        <p class="subtitle">Date</p>
        <ion-item v-for="sel in labelsDate" :key="sel">
            <ion-label label-placement="fixed">{{ sel.label }}</ion-label>
            <ion-select v-model="sel.value" interface="popover" justify="space-between" :placeholder="optionsDate[0].text">
                <ion-select-option v-for="o in optionsDate" :key="o" :value="o.id">{{ o.text }}</ion-select-option>
            </ion-select>
        </ion-item>
        <p class="subtitle">Roommate</p>
        <ion-item v-for="roommate in members" :key="roommate">
            <ion-label>{{ roommate.name }}</ion-label>
            <ion-checkbox v-model="roommate.value" justify="space-between"></ion-checkbox>
        </ion-item>
        <p class="subtitle">Status</p>
        <ion-item v-for="status in statuses" :key="status">
            <ion-label>{{ status.status }}</ion-label>
            <ion-checkbox v-model="status.value" justify="space-between"></ion-checkbox>
        </ion-item>
        <p class="subtitle">Importance</p>
        <ion-radio-group v-model="this.importanceSort">
            <ion-item>
                <ion-label>Most Important</ion-label>
                <ion-radio value="most" justify="space-between"/>
            </ion-item>
            <ion-item>
                <ion-label>Least Important</ion-label>
                <ion-radio value="least" justify="space-between"/>
            </ion-item>
        </ion-radio-group>
        </ion-content>
    </ion-page>
    <ion-icon @click="this.show = true" class="menu-icon" :icon="require(`@/../resources/icon_filter.svg`)"/>
</template>

<script lang="ts">
import { close } from 'ionicons/icons';
import { placeholderMembers, taskFilterDateOptions, taskFilterMember, taskFilterImportance, TaskFilter,
    dateOptionsValue, TaskStatuses, taskFilterStatus } from "@/types";
import { defineComponent } from "vue";

export default defineComponent({
    name: "TaskFilter",
    data() {
        const members: taskFilterMember[] = [];
        for (const o of placeholderMembers) {
            members.push({name: o, value: true});
        }
        const statuses: taskFilterStatus[] = [];
        for (const o of TaskStatuses) {
            statuses.push({status: o, value: true});
        }
        return {
            close,
            members,
            statuses,
            show: false,
            optionsDate: [
                { id: 'any', text: "Any" },
                { id: 'newest', text: "Newest" },
                { id: 'oldest', text: "Oldest" },
            ],
            labelsDate: [
                { id: 'createdDate', label: "Task created", value: 'any' as dateOptionsValue },
                { id: 'promiseDate', label: "Promise date", value: 'any' as dateOptionsValue },
                { id: 'cancelDate', label: "Auto cancel date", value: 'any' as dateOptionsValue },
            ],
            importanceSort: "most" as taskFilterImportance
        }
    },
    methods: {
        submit() {
            this.show = false;
            const dateOptions: taskFilterDateOptions = {
                createdDate: this.labelsDate.find(obj => {return obj.id === 'createdDate'}).value,
                promiseDate: this.labelsDate.find(obj => {return obj.id === 'promiseDate'}).value,
                cancelDate: this.labelsDate.find(obj => {return obj.id === 'cancelDate'}).value,
            };
            this.$emit('updateFilter', new TaskFilter(dateOptions, this.members, this.statuses, this.importanceSort));
        }
    },
    emits: ['updateFilter']
})
</script>

<style scoped>
body {
    font-family: 'Noto Sans', sans-serif;
    font-style: normal;
}

.overlay {
    z-index: 2000;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    position: fixed;
}

.menu-icon {
    color: black;
    width: 24px;
    height: 24px;
    float: left !important;
}

.title {
    margin-left: 6.4vw;
    font-weight: 500;
    font-size: 20px;
    line-height: 120%;
    color: #222428;
}
.title-card {
    margin-top: 3.5vh;
}

.subtitle {
    font-weight: 400;
    font-size: 20px;
    line-height: 24px;
    text-align: left;
    margin-left: 7.6vw;
}

ion-select {
    max-width: 100% !important;
}

p {
    font-family: 'Roboto', sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
}

ion-card-title {
    margin: 0 auto;
    text-align: left;
}

ion-grid, ion-col {
    padding: 0;
}
</style>