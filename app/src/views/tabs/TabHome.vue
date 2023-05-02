<template>
<ion-page>
    <ion-content :fullscreen="true">
        <top-bar title="Home" :menu="true"/>
<<<<<<< Updated upstream
        <filter-rooms/>
        <task-card v-for="task in this.tasks" :key="task" :task="task"/>
        <ion-header collapse="condense">
            <ion-toolbar>
                <ion-title size="large">Home</ion-title>
            </ion-toolbar>
        </ion-header>
=======
>>>>>>> Stashed changes
    </ion-content>
</ion-page>
</template>

<script lang="ts">
  import TopBar from '@/components/TopBar.vue';
  import { defineComponent } from 'vue';
  import { Task, Priority } from '@/types';

  export default defineComponent({
<<<<<<< Updated upstream
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
=======
      components: { TopBar },
>>>>>>> Stashed changes
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