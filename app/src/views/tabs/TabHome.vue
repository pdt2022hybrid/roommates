<template>
<ion-page>
    <ion-content :fullscreen="true">
        <top-bar title="Home" :menu="true" @update-filter="(updateFilter)"/>
        <task-list :filter="filter" :key="filter"/>
    </ion-content>
</ion-page>
</template>

<script lang="ts">
  import TopBar from '@/components/TopBar.vue';
  import TaskList from '@/components/TaskList.vue';
  import { TaskFilter, DefaultTaskFilter } from "@/types";
  import { defineComponent } from 'vue';

  export default defineComponent({
      components: { TaskList, TopBar },
      data() {
          return {
              filter: DefaultTaskFilter as TaskFilter,
          }
      },
      methods: {
          updateFilter(e: TaskFilter) {
              this.filter = e;
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