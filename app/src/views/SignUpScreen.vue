<template>
  <ion-page>

    <div class="header">
      Sign Up
    </div>

    <ion-content>
      <ion-item>
        <ion-label position="stacked">Email</ion-label>
        <ion-input placeholder="Write your email here..."></ion-input>
      </ion-item>
      <ion-item>
        <ion-label position="stacked">Password</ion-label>
        <ion-input type="password" placeholder="Write your password here..."></ion-input>
      </ion-item>
      <ion-item>
        <ion-label position="stacked">Confirm password</ion-label>
        <ion-input type="password" placeholder="Repeat password"></ion-input>
      </ion-item>
      <ion-button shape="round" fill="outline" color="dark">Sign Up</ion-button>
    </ion-content>
    Please fill all fields...
  </ion-page>
</template>

<script setup>
import { IonPage, IonContent, IonItem, IonButton, IonInput, IonLabel, IonHeader, IonIcon } from '@ionic/vue';
import { defineComponent } from 'vue';
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@600&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@600&family=Roboto&display=swap');

  .header {
    color: #989AA2;
    background-color: white;
    font-family: 'Noto Sans', sans-serif;
    font-size: 18px !important;
    padding: 16px 0;
  }

ion-item {
  font-family: 'Roboto', sans-serif;
  --ion-border-color: #C6C6C8;
  padding-right: 16px;
}

ion-button {
  width: 200px !important;
  font-weight: 700 !important;
}

ion-label {
  font-family: 'Roboto', sans-serif;
  font-size: 12px !important;
  color: #3C3C43;
  opacity: 60%;
}
</style>