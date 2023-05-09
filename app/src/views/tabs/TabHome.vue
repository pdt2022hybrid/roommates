<template>
<ion-page>
    <ion-content :fullscreen="true">
        <top-bar title="Home" :menu="true"/>
        <task-list :tasklist="placeholderTasks"></task-list>
        <!--<task-card v-for="task in placeholderTasks" :key="task" :task="task"/>-->
    </ion-content>
</ion-page>
</template>

<script>
  import TopBar from '@/components/TopBar.vue';
  import TaskList from '@/components/TaskList.vue';
  import { placeholderTasks } from "@/types";
  import { defineComponent } from 'vue';

  export default defineComponent({
      components: { TaskList, TopBar },
      data() {
          return {
              placeholderTasks,
              filter: []
          }
      }
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