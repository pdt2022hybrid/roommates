<template>
<ion-page>
    <ion-content :fullscreen="true">
        <top-bar title="Place Tasks" :menu="true"></top-bar>
        <ion-grid>
            <ion-row>
                <ion-col class="member-col" size="auto" v-for="member in placeholderMembers" :key="member">
                    <div class="member-bg">
                        <img :src="this.getIcon('icon_user.svg')" alt="">
                        <p class="member-text">{{ member }}</p>
                    </div>
                </ion-col>
            </ion-row>
        </ion-grid>
        <task-list :tasklist="placeholderTasks" :filter="filter" :key="filter"/>
    </ion-content>
</ion-page>
</template>

<script lang="ts">
import TopBar from '@/components/TopBar.vue';
import { defineComponent } from 'vue';
import {DefaultTaskFilter, placeholderMembers, placeholderTasks, TaskFilter} from "@/types";
import TaskList from "@/components/TaskList.vue";

export default defineComponent({
    data() {
        return {
            placeholderMembers,
            placeholderTasks,
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
    components: {TaskList, TopBar },
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