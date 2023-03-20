<template>
    <ion-page>
        <ion-content>
            <h2>Welcome back, log in...</h2>
            <ion-item>
                <ion-label position="stacked">Email</ion-label>
                <ion-input placeholder="Write your email here..."></ion-input>
            </ion-item>
            <ion-item>
                <ion-label position="stacked">Password</ion-label>
                <ion-input type="password" placeholder="Write your password here..."></ion-input>
            </ion-item>
            <ion-button fill="outline" color="dark">Log In</ion-button>
            <p class="register-text"><u>Or if you are a new user, Sign Up</u></p>
        </ion-content>
    </ion-page>
</template>

<script setup>
    import { IonPage, IonContent, IonItem, IonButton, IonInput, IonLabel } from '@ionic/vue';
    import { defineComponent } from 'vue';
</script>

<style>
    body {
        text-align: center;
        position: absolute;
        left: 0;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
    }

    .register-text {
      color: #606060;
    } .register-text:hover {
      color: #000000;
    }
</style>