<template>
    <div v-for="task in tasks" :key="task">
        <task-card @click="openModal(task)" v-if="check(task)" :task="task" />
    </div>
</template>

<script lang="ts">
import {DefaultTaskFilter, getDateOptionsValueSort, Task, TaskFilter, taskFilterMember, taskFilterStatus} from "@/types";
import TaskCard from "@/components/TaskCard.vue";
import TaskDetailModal from "@/components/TaskDetailModal.vue";
import {store} from "@/store";
import {modalController} from "@ionic/vue";

export default {
    name: "TaskList",
    components: { TaskCard },
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
            return (
                !this.filter.members.find((o: taskFilterMember) => o.id === task.user_created.id)
                &&
                this.filter.status.find((o: taskFilterStatus) => o.status.id === task.status_id).value
            );
        },
        sort() {
            const j = getDateOptionsValueSort(this.filter.dateOptions.createdDate);
            //console.log(`i: ${i}, j: ${j}`);
            this.tasks.sort((a, b) => {
                console.log(a);
                Math.sign(Date.parse(a.deadline)/1000 - Date.parse(b.deadline)/1000 * j) }
            );
        },
       async openModal(task: {
          name: string,
       }) {
          console.log(task)
         const modal = await modalController.create({
           component: TaskDetailModal,
           componentProps: {
             task: task,
           }
         })
         await modal.present()
         const { data } = await modal.onDidDismiss()
      },
    },
    async mounted() {
        await store.dispatch('storeTasks');
        //console.log(JSON.parse(localStorage.getItem('roomTasks')));
        this.tasks = JSON.parse(localStorage.getItem('roomTasks'));
        console.log(this.filter);
        this.sort();
    }
};
</script>

<style scoped>

</style>