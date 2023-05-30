<template>
<ion-page>
    <!--<ion-refresher slot="fixed" @ionRefresh="handleRefresh($event)">
        <ion-refresher-content></ion-refresher-content>
    </ion-refresher>-->
    <ion-content :fullscreen="true">
        <top-bar title="Home" :menu="true" @update-filter="(updateFilter)"/>
        <task-list :filter="filter" :key="filter"/>
    </ion-content>
</ion-page>
</template>

<script lang="ts">
import TopBar from '@/components/TopBar.vue';
import TaskList from '@/components/TaskList.vue';
import {DefaultTaskFilter, TaskFilter} from "@/types";
import {defineComponent} from 'vue';
import {IonRefresher, IonRefresherContent} from '@ionic/vue';

export default defineComponent({
    components: { TaskList, TopBar, /*IonRefresher,IonRefresherContent*/ },
    data() {
        DefaultTaskFilter.assignedTo = [JSON.parse(localStorage.getItem('userId'))];
        console.log(DefaultTaskFilter);
        return {
          filter: DefaultTaskFilter as TaskFilter,
          updateList: 0
        }
    },
    methods: {
        updateFilter(e) {
            e.assignedTo = [JSON.parse(localStorage.getItem('userId'))]
            this.filter = e;
            this.updateList++;
        },
        handleRefresh(event) {
            setTimeout(() => {
                this.updateList++;
                event.target.complete();
            }, 2000);
        }
    },
  });
</script>

<style scoped>

.header-md::after {
  display: none;
}

ion-toolbar {
  --border-width: 0px;
  --border-style: none;
  --background: white;
}

ion-toolbar > ion-title {
  color: #989AA2;
  font-weight: 600;
  font-size: 18px !important;
}

</style>