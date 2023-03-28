<template>
  <ion-page>
    <top-bar title="Home" :menu="true"></top-bar>
    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">Home</ion-title>
        </ion-toolbar>
      </ion-header>
      
      <ExploreContainer name="Tab 1 page" />
      <ion-button shape="round" color="primary" ion-color-primary>Button</ion-button>
    </ion-content>
  </ion-page>
</template>

<script lang="ts">
  import ExploreContainer from '@/components/ExploreContainer.vue';
  import TopBar from '@/components/TopBar.vue';
  import { defineComponent } from 'vue';

  export default defineComponent({
    components: { ExploreContainer, TopBar },
  });
</script>