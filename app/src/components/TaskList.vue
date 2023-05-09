<template>
    <div v-for="task in tasks" :key="task">
        <task-card v-if="check(task)" />
    </div>
</template>

<script>
import TaskCard from "@/components/TaskCard";
import { Task } from '@/types'

export default {
    name: "TaskList",
    components: {TaskCard},
    props: {
        tasks: [],
        filter: []
    },
    methods: {
        check(task) {
            const authorCheck = this.filter.members.find(obj => {
                return obj.name === task.author;
            }).value
            return authorCheck;
        }
    }
}
</script>

<style scoped>

</style>