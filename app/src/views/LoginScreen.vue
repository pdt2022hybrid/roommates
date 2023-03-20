<template>
    <ion-page>
        <ion-content>
            <p style="color: #989AA2;">Log In</p>
            <h2>Welcome back, log in...</h2>
            <ion-item>
                <ion-label position="stacked">Email</ion-label>
                <ion-input placeholder="Write your email here..."></ion-input>
            </ion-item>
            <ion-item>
                <ion-label position="stacked">Password</ion-label>
                <ion-input type="password" placeholder="Write your password here..."></ion-input>
            </ion-item>
            <p style="color: #EC445A;">Please fill all fields...</p>
            <ion-button class="login-btn" fill="outline" color="dark">Log In</ion-button>
            <p class="register-text"><u>Or if you are a new user, Sign Up</u></p>
        </ion-content>
    </ion-page>
</template>

<script>
    import { IonPage, IonContent, IonItem, IonButton, IonInput, IonLabel, /*IonIcon*/ } from '@ionic/vue';
    import { defineComponent } from 'vue';

    export default defineComponent({
        name: 'LoginScreen',
        components: { IonPage, IonContent, IonItem, IonButton, IonInput, IonLabel, /*IonIcon*/ }
    })
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

    .login-btn {
        --border-radius: 4vw;
        --padding-top: 13px;
        --padding-bottom: 13px;
        --padding-start: 75px;
        --padding-end: 75px;
    }

    .register-text {
      color: #606060;
    } .register-text:hover {
      color: #000000;
    }
</style>