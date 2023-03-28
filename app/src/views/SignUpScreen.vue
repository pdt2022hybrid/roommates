<template>
  <ion-page>

    <ion-header class="header">
      <ion-toolbar>
        <ion-icon :icon="chevronBackOutline"></ion-icon>
        <ion-title>
          Sign Up
        </ion-title>
      </ion-toolbar>
    </ion-header>

    <ion-content fullscreen>
      <div class="content">
        <ion-item>
        <ion-label position="stacked">First Name</ion-label>
        <ion-input v-model="firstName" placeholder="Write your first name here..."></ion-input>
      </ion-item>
      <ion-item>
        <ion-label position="stacked">Last Name</ion-label>
        <ion-input v-model="lastName" placeholder="Write your last name here..."></ion-input>
      </ion-item>
      <ion-item>
        <ion-label position="stacked">Email</ion-label>
        <ion-input v-model="mail" placeholder="Write your email here..."></ion-input>
      </ion-item>
      <ion-item>
        <ion-label position="stacked">Password</ion-label>
        <ion-input v-model="password" type="password" placeholder="Write your password here..."></ion-input>
      </ion-item>
      <ion-item>
        <ion-label position="stacked">Confirm password</ion-label>
        <ion-input v-model="confirmPassword" type="password" placeholder="Repeat password"></ion-input>
      </ion-item>
      <ion-button v-on:click="signUp()" shape="round" fill="outline" color="dark">
        Sign Up
      </ion-button>
      Please fill all fields...
      </div>
    </ion-content>
  </ion-page>
</template>

<script>

import { IonPage, IonContent, IonItem, IonButton, IonInput, IonLabel, IonHeader,IonTitle, IonIcon, IonToolbar } from '@ionic/vue';
import { chevronBackOutline } from 'ionicons/icons';
import axios from 'axios';
import { defineComponent } from 'vue';
export default {
  components: {
    IonPage, IonContent, IonItem, IonButton, IonInput, IonLabel, IonIcon, IonToolbar, IonTitle, IonHeader
  },
  data() {
    return {
      chevronBackOutline,
      firstName: "",
      lastName: "",
      mail: "",
      password: "",
      confirmPassword: "",
    }
  },
  methods: {
    signUp: async function () {
      const data = {
        name: this.firstName,
        surname: this.lastName,
        email: this.mail,
        password: this.password,
        password_confirmation: this.confirmPassword
      }
      await axios.post('https://roomates.hybridlab.dev/cms/api/auth/signup', data)
    }
    }
  }


</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@600&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@600&family=Roboto&display=swap');

  .header {
    color: #989AA2;
    background-color: white;
    font-family: 'Noto Sans', sans-serif;
    font-size: 18px !important;
    padding: 16px
  }

  .content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

ion-toolbar {
  --border-width: 0px;
  --border-style: none;
  --background: white;
}

ion-item {
  font-family: 'Roboto', sans-serif;
  --ion-border-color: #C6C6C8;
  padding-right: 16px;
  width: 100vw;
}

ion-icon {
  color: black;
  width: 24px;
  height: 24px;
  float: left !important;
}

ion-button {
  width: 200px !important;
  font-weight: 700 !important;
  --ion-border-color: #262B2C;
  border-radius: 20px;
}

ion-label {
  font-family: 'Roboto', sans-serif;
  font-size: 12px !important;
  color: #3C3C43;
  opacity: 60%;
}
</style>