<template>
  <ion-app>
    <ion-router-outlet />
    <ion-loading :isOpen="$store.state.isLoading" message="Loading..." spinner="circles"></ion-loading>
  </ion-app>
</template>

<script setup lang="ts">
import {IonLoading} from "@ionic/vue";
import { IonApp, IonRouterOutlet } from '@ionic/vue';
</script>