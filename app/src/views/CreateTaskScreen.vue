<template>
  <ion-page>

    <ion-header class="header">
      <ion-toolbar>
        <router-link to="/tabs/home">
          <ion-icon class="ion-float-left" :icon="chevronBackOutline"></ion-icon>
        </router-link>
        <ion-title>
          Create a task
        </ion-title>
      </ion-toolbar>
    </ion-header>

    <ion-content>

    </ion-content>

  </ion-page>
</template>

<script>
import { IonPage, IonContent, IonHeader,IonTitle, IonLabel, IonToolbar } from '@ionic/vue';
import { chevronBackOutline } from 'ionicons/icons';
export default {
  name: "CreateTaskScreen",
  components: {
    IonPage, IonContent, IonToolbar, IonTitle, IonHeader
  },
  data() {
    return {
      chevronBackOutline,
    }
  }
}
</script>

<style scoped>
.header {
  background-color: white;
  padding: 16px
}

a {
  color: #262B2C !important;
  text-decoration: none;
}
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

ion-icon {
  color: black;
  width: 24px;
  height: 24px;
}
</style>