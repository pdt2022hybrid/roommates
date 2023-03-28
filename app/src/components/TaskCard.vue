<template>

</template>

<script>
import { defineComponent } from 'vue';
export default defineComponent({
    name: "TaskCard",
    props: {
        title: String,
        date: String,
        priority: Number,

    }
})
</script>