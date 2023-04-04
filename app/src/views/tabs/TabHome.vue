<template>
<ion-page>
    <ion-content :fullscreen="true">
        <top-bar title="Home" :menu="true"/>
        <filter-rooms/>
        <task-card v-for="task in this.tasks" :key="task" :task="task"/>
        <ion-header collapse="condense">
            <ion-toolbar>
                <ion-title size="large">Home</ion-title>
            </ion-toolbar>
        </ion-header>
    </ion-content>
</ion-page>
</template>

<script lang="ts">
  import TopBar from '@/components/TopBar.vue';
  import FilterRooms from '@/components/FilterRooms.vue';
  import TaskCard from '@/components/TaskCard.vue';
  import { defineComponent } from 'vue';
  import { Task, Priority } from '@/types';

  export default defineComponent({
      components: { TopBar, FilterRooms, TaskCard },
      data() {
          return {
              tasks: [
                  new Task("UPRAC KUCHYNU", "RICHARD EGYED", new Date(Date.parse('2023-1-12')), Priority.HIGH, 'kitchen'),
                  new Task("ALE NO UZ", "LUPTACIK", new Date(Date.parse('2023-1-12')), Priority.MEDIUM, 'bath'),
                  new Task("CHOD DOMOV", "SLOBODA", new Date(Date.parse('2023-1-12')), Priority.LOW, 'living'),
                  new Task("UPRAC SVOJU IZBU", "MAREK TOPOLSKY", new Date(Date.parse('2023-1-12')), Priority.LOW, 'work')
              ]
          }
      }
  });
</script>