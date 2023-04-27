<template>
<ion-page>
    <ion-content :fullscreen="true">
        <top-bar title="Home" :menu="true"/>
        <filter-rooms/>
    </ion-content>
</ion-page>
</template>

<script>
  import TopBar from '@/components/TopBar.vue';
  import FilterRooms from '@/components/FilterRooms.vue';
  import TaskCard from '@/components/TaskCard.vue';
  import { defineComponent } from 'vue';

  export default defineComponent({
      components: { TopBar, FilterRooms },
  });
</script>