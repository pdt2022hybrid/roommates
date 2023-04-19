<template>
  <ion-page>

    <ion-header class="header">
      <ion-toolbar>
        <router-link to="/login">
          <ion-icon :icon="chevronBackOutline"></ion-icon>
        </router-link>
        <ion-title>
          Sign Up
        </ion-title>
      </ion-toolbar>
    </ion-header>

    <ion-content>

    </ion-content>

  </ion-page>
</template>

<script>
import { IonPage, IonContent, IonHeader,IonTitle, IonLabel, IonToolbar } from '@ionic/vue';
export default {
  name: "CreateTaskScreen",
  components: {
    IonPage, IonContent, IonToolbar, IonTitle, IonHeader
  },
}
</script>

<style scoped>

</style>