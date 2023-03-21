<template>
    <ion-page>
        <ion-content>
            <p style="color: #989AA2;">Log In</p>
            <h2>Welcome back, log in...</h2>
            <ion-item>
                <ion-label position="stacked">Email</ion-label>
                <ion-input v-model="this.email" placeholder="Write your email here..."></ion-input>
            </ion-item>
            <ion-item>
                <ion-label position="stacked">Password</ion-label>
                <ion-input
                    v-model="this.password" :type="this.showPass ? '' : 'password'"
                    placeholder="Write your password here...">
                </ion-input>
                <ion-button @click="this.showPass = !this.showPass; this.errorMsg='TEST'" clear color="light" type="button">
                    <ion-icon :icon="showPass ? eyeOffOutline : eyeOutline"> </ion-icon>
                </ion-button>
            </ion-item>
            <p style="color: #EC445A;">{{ this.errorMsg }}</p>
            <ion-button @click="login(this.email, this.password)" class="login-btn" fill="outline" color="dark">Log In</ion-button>
            <p class="register-text"><u>Or if you are a new user, Sign Up</u></p>
        </ion-content>
    </ion-page>
</template>

<script>
    import { IonPage, IonContent, IonItem, IonButton, IonInput, IonLabel, IonIcon } from '@ionic/vue';
    import { eyeOutline, eyeOffOutline } from 'ionicons/icons';
    import axios from 'axios';
    import { defineComponent } from 'vue';

    export default defineComponent({
        name: 'LoginScreen',
        components: { IonPage, IonContent, IonItem, IonButton, IonInput, IonLabel, IonIcon },
        data() {
            return {
                email: '',
                password: '',
                showPass: false,
                errorMsg: '',
                eyeOffOutline: eyeOffOutline //nefunguje bez toho
            }
        },
        methods: {
            login: async function (email, password) {
                if(!email || !password) {
                    this.errorMsg = 'Please fill all fields...';
                    return;
                }
                await axios.post('https://roomates.hybridlab.dev/cms/api/auth/login', {
                    email: this.email,
                    password: this.password
                }).then(function (response) {
                    console.log(response);
                }).catch(function (error) {
                    console.error(error);
                })
            }
        },
        setup() {
            return { eyeOutline };
        }
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