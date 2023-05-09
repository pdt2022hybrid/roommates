<template>
    <div v-for="task in tasks" :key="task">
        <task-card v-if="check(task)" />
    </div>
</template>

<script lang="ts">
import { Task } from "@/types";
import TaskCard from "@/components/TaskCard.vue";

export default {
    name: "TaskList",
    components: {TaskCard},
    props: {
        tasklist: [] as Task[],
        filter: []
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
            this.tasks.sort((a, b) => (a.priority.priority > b.priority.priority) ? 1 : -1)
        }
    }
}
</script>

<style scoped>

</style>