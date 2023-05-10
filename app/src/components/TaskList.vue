<template>
    <div v-for="task in tasks" :key="task">
        <task-card v-if="check(task)" :task="task" />
    </div>
</template>

<script lang="ts">
import { getDateOptionsValueSort, Task, TaskFilter} from "@/types";
import TaskCard from "@/components/TaskCard.vue";

export default {
    name: "TaskList",
    components: { TaskCard },
    props: {
        tasklist: [] as Task[],
        filter: TaskFilter
    },
    data() {
        return {
            tasks: this.tasklist
        }
    },
    methods: {
        check(task) {
            return this.filter.members.find(obj => {
                return obj.name === task.author;
            }).value;
        },
        sort() {
            const i = this.filter.importance === 'least' ? 1 : -1;
            //this.tasks.sort((a, b) => (a.priority.priority < b.priority.priority) ? i : -i);
            const j = getDateOptionsValueSort(this.filter.dateOptions.createdDate);
            console.log(`i: ${i}, j: ${j}`);
            this.tasks.sort((a, b) =>
                Math.sign(a.date.getTime() - b.date.getTime()) * j ||
                Math.sign(a.priority.priority - b.priority.priority) * i

            );
        }
    },
    mounted() {
        this.sort();
    }
};
</script>

<style scoped>

</style>