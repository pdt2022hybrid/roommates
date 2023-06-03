<template>
  <ion-app id="ion-loader-container">
    <ion-router-outlet />
    <ion-loading id="ion-loader" :isOpen="$store.state.isLoading" message="Loading..." spinner="circles"></ion-loading>
  </ion-app>
</template>

<script>
import {IonLoading} from "@ionic/vue"
import { IonApp, IonRouterOutlet } from '@ionic/vue'
import {store} from "@/store";

export default {
  components: {
    IonApp, IonRouterOutlet, IonLoading
  },
}



</script>

