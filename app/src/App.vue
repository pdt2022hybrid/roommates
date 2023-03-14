<template>
  <ion-app>
    <ion-router-outlet />
  </ion-app>
</template>

<script setup lang="ts">
import { IonApp, IonRouterOutlet } from '@ionic/vue';
</script>

<style>
  #app {
    --ion-color-primary: #FF4961;
    --ion-color-primary-rgb: 255,73,97;
    --ion-color-primary-contrast: #000000;
    --ion-color-primary-contrast-rgb: 0,0,0;
    --ion-color-primary-shade: #e04055;
    --ion-color-primary-tint: #ff5b71;
    --ion-background-color: #ffffff !important;
    --ion-background-color-rgb: 255,255,255 !important;
  }
  
  .ion-color-primary {
    --ion-color-base: var(--ion-color-primary);
    --ion-color-base-rgb: var(--ion-color-primary-rgb);
    --ion-color-contrast: var(--ion-color-primary-contrast);
    --ion-color-contrast-rgb: var(--ion-color-primary-contrast-rgb);
    --ion-color-shade: var(--ion-color-primary-shade);
    --ion-color-tint: var(--ion-color-primary-tint);
  }
</style>