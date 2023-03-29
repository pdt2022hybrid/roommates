<template>
<ion-page>
    <ion-content :fullscreen="true">
        <top-bar title="Home" :menu="true"></top-bar>
        <filter-rooms></filter-rooms>
        <task-card title="UPRAC KUCHYNU" date="12.1.2023" author="RICHARD EGYED"></task-card>
        <task-card title="ALE NO UZ" date="12.1.2023" author="LUPTACIK"></task-card>
        <task-card title="CHOD DOMOV" date="12.1.2023" author="SLOBODA"></task-card>
        <task-card title="UPRAC SVOJU IZBU" date="12.1.2023" author="MAREK TOPOLSKY"></task-card>
        <ion-header collapse="condense">
            <ion-toolbar>
                <ion-title size="large">Home</ion-title>
            </ion-toolbar>
        </ion-header>
    </ion-content>
</ion-page>
</template>

<script lang="ts">
  import ExploreContainer from '@/components/ExploreContainer.vue';
  import TopBar from '@/components/TopBar.vue';
  import FilterRooms from '@/components/FilterRooms.vue';
  import TaskCard from '@/components/TaskCard.vue';
  import { defineComponent } from 'vue';

  export default defineComponent({
    components: { TopBar, FilterRooms, TaskCard },
  });
</script>