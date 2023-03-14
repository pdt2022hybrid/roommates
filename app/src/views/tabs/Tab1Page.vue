<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>Tab 1</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">Tab 1</ion-title>
        </ion-toolbar>
      </ion-header>
      
      <ExploreContainer name="Tab 1 page" />
      <ion-button shape="round" color="primary" ion-color-primary>Button</ion-button>
    </ion-content>
  </ion-page>
</template>

<script lang="ts">
  import { IonPage, IonHeader, IonToolbar, IonTitle, IonContent, IonButton } from '@ionic/vue';
  import ExploreContainer from '@/components/ExploreContainer.vue';
  import { defineComponent } from 'vue';

  export default defineComponent({
    components: { ExploreContainer, IonPage, IonHeader, IonToolbar, IonTitle, IonContent, IonButton },
  });
</script>

<style scoped>
  body {
    text-align: center;
    position: absolute;
    left: 0;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
  }
</style>
