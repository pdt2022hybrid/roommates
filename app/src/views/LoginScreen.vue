<template>
    <ion-page>
        <ion-content>
            <p class="text-title">Log In</p>
            <p class="text-main">Welcome back, log in...</p>
            <ion-item>
                <ion-label position="stacked">Email</ion-label>
                <ion-input v-model="this.email" type="email" placeholder="Write your email here..."></ion-input>
            </ion-item>
            <ion-grid>
                <ion-row class="ion-align-items-end">
                    <ion-col>
                        <ion-item>
                            <ion-label position="stacked">Password</ion-label>
                            <ion-input
                                v-model="this.password" :type="this.showPass ? 'text' : 'password'"
                                placeholder="Write your password here...">
                            </ion-input>
                        </ion-item>
                    </ion-col>
                    <ion-col size="auto">
                        <ion-button @click="this.showPass = !this.showPass" clear color="light" type="button">
                            <ion-icon :icon="showPass ? eyeOffOutline : eyeOutline"/>
                        </ion-button>
                    </ion-col>
                </ion-row>
            </ion-grid>
            <p style="color: #EC445A;">{{ this.errorMsg }}</p>
            <ion-button @click="login(this.email, this.password)" class="custom-btn" fill="outline" color="dark">Log In</ion-button>
            <p @click="this.$router.push({path: '/signUp'})" class="register-text"><u>Or if you are a new user, Sign Up</u></p>
        </ion-content>
    </ion-page>
</template>

<script>
    import { eyeOutline, eyeOffOutline } from 'ionicons/icons';
    import axios from 'axios';
    import { defineComponent } from 'vue';

    export default defineComponent({
        name: 'LoginScreen',
        data() {
            return {
                email: '',
                password: '',
                showPass: false,
                errorMsg: '',
            }
        },
        methods: {
            login: async function (email, password) {
                if(!email || !password) {
                    this.errorMsg = 'Please fill all fields...';
                    return;
                } else this.errorMsg = '';
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
            return { eyeOutline, eyeOffOutline };
        }
    })
</script>

<style scoped>
    p {
        font-family: 'Noto Sans', sans-serif;
        font-style: normal;
        font-weight: 600;
        line-height: 22px;
        letter-spacing: -0.408px;
    }

    .text-title {
        //position: relative;
        font-size: 18px;
        //top: 5.5vh;
        color: #989AA2;
    }

    .text-main {
        font-size: 24px;
        //top: 19vh;
        color: #262B2C;
    }

    .register-text {
      color: #606060;
    } .register-text:hover {
      color: #000000;
    }

    ion-grid {
        padding-left: 0;
    }
    ion-col {
        padding-left: 0;
    }
</style>