<template>
    <ion-refresher slot="fixed" @ionRefresh="handleRefresh($event)">
        <ion-refresher-content/>
    </ion-refresher>
    <div v-for="task in tasks" :key="task">
        <task-card @click="openModal(task)" v-if="check(task)" :task="task" />
    </div>
</template>

<script lang="ts">
import {DefaultTaskFilter, getDateOptionsValueSort, Task, TaskFilter, taskFilterMember, taskFilterStatus} from "@/types";
import TaskCard from "@/components/TaskCard.vue";
import TaskDetailModal from "@/components/TaskDetailModal.vue";
import {store} from "@/store";
import {modalController, IonRefresher, IonRefresherContent} from "@ionic/vue";

export default {
    name: "TaskList",
    components: { TaskCard, IonRefresher, IonRefresherContent },
    props: {
        filter: DefaultTaskFilter as TaskFilter
    },
    data() {
        return {
            tasks: JSON.parse(localStorage.getItem('roomTasks')),
        }
    },
    methods: {
        check(task) {
          return true
        },
        sort() {
            const j = getDateOptionsValueSort(this.filter.dateOptions.createdDate);
            //console.log(`i: ${i}, j: ${j}`);
            this.tasks.sort((a, b) => {
                Math.sign(Date.parse(a.deadline)/1000 - Date.parse(b.deadline)/1000 * j) }
            );
        },
       async openModal(task: {
          name: string,
       }) {

         const modal = await modalController.create({
           component: TaskDetailModal,
           componentProps: {
             task: task,
             vm: this
           },

         })
         await modal.present()
         const { data } = await modal.onDidDismiss()
      },
      async reloadTask() {
        await store.dispatch('storeTasks');
        this.tasks = JSON.parse(localStorage.getItem('roomTasks'));
        console.log(this.filter);
        this.sort();
        await store.dispatch('loaded')
      },
      async handleRefresh(event) {
          await this.$emit('refresh');
          await this.reloadTask();
          event.target.complete();
      }
    },
    emits: ['refresh'],
    mounted() {
      store.dispatch('storeMinirooms')
      store.dispatch('storeUsers')
      this.reloadTask()
      this.$events.on('reloadTasks', () => {
        this.reloadTask()
      })
    }
};
</script>

<style scoped>

</style>