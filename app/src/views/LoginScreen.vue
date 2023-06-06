<template>
    <ion-page>

        <ion-header class="header">
          <ion-toolbar>
            <ion-title>
              Log In
            </ion-title>
          </ion-toolbar>
        </ion-header>

        <ion-content fullscreen>

            <div class="content">
                <ion-item>
                    <ion-input v-model="this.email" placeholder="Email"></ion-input>
                </ion-item>
                <ion-item>
                    <ion-input :type="showPass ? 'text' : 'password'" v-model="this.password" placeholder="Password"/>
                    <ion-icon @click="showPass = !showPass" :icon="showPass ? eyeOffOutline : eyeOutline" class="show"></ion-icon>
                </ion-item>
                <p style="color: #EC445A;">{{ this.errorMsg }}</p>
            </div>

            <div class="bottom">
              <ion-button @click="login(this.email, this.password)" class="login-btn">Log In</ion-button>
            </div>

            <router-link class="link" to="/signUp">
              New to Roommates? Sign Up!
            </router-link>

        </ion-content>
    </ion-page>
</template>

<script>
    import { eyeOutline, eyeOffOutline } from 'ionicons/icons';
    import { defineComponent } from 'vue';
    import {store} from "@/store";

    export default defineComponent({
        name: 'LoginScreen',
        data() {
            return {
                email: '',
                password: '',
                showPass: false,
                errorMsg: '',
                eyeOutline,
                eyeOffOutline,
            }
        },
        methods: {
            async login() {
              try {
                if(!this.email || !this.password) {
                  this.errorMsg = 'Please fill all fields...';
                  return;
                } else this.errorMsg = '';
                await store.dispatch('login', {email: this.email, password: this.password});
                this.email = null;
                this.password = null;
                if(localStorage.getItem('userToken')) this.$router.push({path: '/tabs/home'});
                else this.errorMsg = store.state.errorMessage;
              } catch (error) {
                this.errorMsg = error
                console.log(error)
              }
            },
        },
      mounted() {
        if(localStorage.userToken && localStorage.roomId) {
          this.$router.push({path: '/tabs/home'})
        } else if(localStorage.userToken) {
          this.$router.push({path: '/chooseTypeOfPlace'})
        } else {
          this.$router.push({path: '/'})
        }
      },
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

    .register-text {
      color: #989AA2;
      font-size: 14px;
      font-weight: 500;
    }


    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@600&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@600&family=Roboto&display=swap');
    .header {
      background-color: white;
      padding: 16px
    }
    .content {
      position: absolute;
      top: 40%;
      left: 50%;
      transform: translate(-50%, -50%);
    }



    .show {
      ion-align-self: end;
    }

    .bottom {
      position: absolute;
      top: 70%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .link {
      color: #989AA2;
      font-weight: 500;
      font-size: 14px;
      position: absolute;
      top: 80%;
      left: 50%;
      transform: translate(-50%, -50%);
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
    }
    ion-icon {
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

    ion-grid {
        padding-left: 0;
    }
    ion-col {
        padding-left: 0;
    }
</style>