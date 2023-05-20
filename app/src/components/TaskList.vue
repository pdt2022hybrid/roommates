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
            //console.log(task);
            return (
                /*(this.filter.members.find((o: taskFilterMember) => {
                    return o.name === task.user_created.name;
                }).value || true)
                &&
                this.filter.status.find((o: taskFilterStatus) => {
                    return o.status === task.status;
                }).value*/
                true
            );
        },
        sort() {
            const i = this.filter.importance === 'least' ? 1 : -1;
            //this.tasks.sort((a, b) => (a.priority.priority < b.priority.priority) ? i : -i);
            const j = getDateOptionsValueSort(this.filter.dateOptions.createdDate);
            //console.log(`i: ${i}, j: ${j}`);
            /*this.tasks.sort((a: Task, b: Task) =>
                Math.sign(a.deadline.getTime() - b.deadline.getTime()) * j ||
                Math.sign(a.status.priority - b.status.priority) * i

            );*/
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
        this.sort();
    }
};
</script>

<style scoped>

</style>