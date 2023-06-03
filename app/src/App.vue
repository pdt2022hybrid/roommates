<template>
  <ion-app id="ion-loader-container">
    <ion-router-outlet />
    <ion-loading id="ion-loader" :isOpen="$store.state.isLoading" message="Loading..." spinner="circles"></ion-loading>
  </ion-app>
</template>

<script setup lang="ts">
import {IonLoading} from "@ionic/vue"
import { IonApp, IonRouterOutlet } from '@ionic/vue'
import {store} from "@/store";

console.log(store.state.isLoading)
if(store.state.isLoading == true) {
  setTimeout(() => {
    store.dispatch('loaded', false)
    alert('An error ocured, try to log out and log in again.')
  }, 15000)
}



</script>

