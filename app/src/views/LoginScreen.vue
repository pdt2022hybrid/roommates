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
            <p><u>Or if you are new user, Sign Up</u></p>
        </ion-content>
    </ion-page>
</template>

<script setup>
    import { IonPage, IonContent, IonItem, IonButton, IonInput, IonLabel } from '@ionic/vue';
    import { defineComponent } from 'vue';
</script>

<style scoped>

</style>