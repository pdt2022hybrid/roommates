<template>
<ion-page>
    <ion-content :fullscreen="true">
        <top-bar title="Home" :menu="true"/>
        <filter-rooms/>
        <task-card v-for="task in $store.state.room.tasks" :key="task" :task="task"/>
        <ion-header collapse="condense">
            <ion-toolbar>
                <ion-title size="large">Home</ion-title>
            </ion-toolbar>
        </ion-header>
    </ion-content>
</ion-page>
</template>

<script>
  import TopBar from '@/components/TopBar.vue';
  import FilterRooms from '@/components/FilterRooms.vue';
  import TaskCard from '@/components/TaskCard.vue';
  import { defineComponent } from 'vue';

  export default defineComponent({
      components: { TopBar, FilterRooms, TaskCard },
  });
</script>