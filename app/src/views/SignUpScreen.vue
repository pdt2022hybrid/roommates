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

    <ion-content fullscreen>
      <div class="content">
        <ion-item>
          <ion-label position="stacked">First Name</ion-label>
          <ion-input v-model="firstName" placeholder="Type your first name here..."></ion-input>
        </ion-item>
        <ion-item>
          <ion-label position="stacked">Last Name</ion-label>
          <ion-input v-model="lastName" placeholder="Type your last name here..."></ion-input>
        </ion-item>
        <ion-item>
          <ion-label position="stacked">Email</ion-label>
          <ion-input v-model="mail" placeholder="Type your email here..."></ion-input>
        </ion-item>
        <ion-item>
          <ion-label position="stacked">Password</ion-label>
          <div class="row">
            <ion-input v-model="password" :type="inputTypePassword" placeholder="Type your password here..."></ion-input>
            <span v-if="inputTypePassword == 'password'">
              <ion-icon @click="toggleShowPassword" :icon="eyeOutline" class="show"></ion-icon>
            </span>
            <span v-else>
              <ion-icon @click="toggleShowPassword" :icon="eyeOffOutline"></ion-icon>
            </span>
          </div>
        </ion-item>
        <ion-item>
          <ion-label position="stacked">Confirm password</ion-label>
          <div class="row">
            <ion-input :type="inputTypeConfirmed" v-model="confirmPassword" placeholder="Repeat password"></ion-input>
            <span v-if="inputTypeConfirmed == 'password'">
              <ion-icon @click="toggleShowConfirmed" :icon="eyeOutline" class="show"></ion-icon>
            </span>
            <span v-else>
              <ion-icon @click="toggleShowConfirmed" :icon="eyeOffOutline"></ion-icon>
            </span>
          </div>
        </ion-item>
      </div>
      <div class="bottom">
        <ion-button v-on:click="signUp()">
          Sign Up
        </ion-button>
      </div>
    </ion-content>
  </ion-page>
</template>

<script>

import { IonPage, IonContent, IonItem, IonButton, IonInput, IonLabel, IonHeader,IonTitle, IonIcon, IonToolbar } from '@ionic/vue';
import { chevronBackOutline } from 'ionicons/icons';
import {store} from "@/store";
import { eyeOutline } from 'ionicons/icons';
import { eyeOffOutline } from 'ionicons/icons';
import axios from 'axios';
import { defineComponent } from 'vue';
import * as url from "url";
export default {
  components: {
    IonPage, IonContent, IonItem, IonButton, IonInput, IonLabel, IonIcon, IonToolbar, IonTitle, IonHeader
  },
  data() {
    return {
      chevronBackOutline,
      eyeOutline,
      eyeOffOutline,
      firstName: "",
      lastName: "",
      mail: "",
      password: "",
      confirmPassword: "",
      inputTypePassword: "password",
      inputTypeConfirmed: "password",
    }
  },
  methods: {
    signUp: async function () {
      if (this.password !== this.confirmPassword) {
        alert("Passwords does not match")
      } else {
        await store.dispatch('signup', {name: this.firstName, surname: this.lastName, email: this.mail, password: this.password, password_confirmation: this.confirmPassword})
        this.$router.push({path: '/setProfilePicture'})
      }
    },

    toggleShowPassword() {
      this.inputTypePassword =
          this.inputTypePassword === "password" ? "text" : "password"
    },

    toggleShowConfirmed() {
      this.inputTypeConfirmed =
          this.inputTypeConfirmed === "password" ? "text" : "password"
    }
  },
}


</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@600&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@600&family=Roboto&display=swap');

.header {
  background-color: white;
  padding: 16px
}

a {
  color: #262B2C !important;
  text-decoration: none;
}

.content {
  position: absolute;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.bottom {
  position: absolute;
  top: 70%;
  left: 50%;
  transform: translate(-50%, -50%);
}

d-none {
  display: none;
}

.row {
  display: flex;
  width: 100%;
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

ion-content > ion-title {
  color: #262B2C;
  font-size: 24px;
  font-weight: 600;
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
  height: 48px;
  font-weight: 700 !important;
  --border-color: #262B2C;
  --border-radius: 20px;
  --border-width: 0.5px;
  color: #FFFFFF;
  text-transform: none;
  font-size: 17px;
}

ion-label {
  font-family: 'Roboto', sans-serif;
  font-size: 12px !important;
  color: #3C3C43;
  opacity: 60%;
}
</style>