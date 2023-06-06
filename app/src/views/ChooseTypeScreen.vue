<template>
    <ion-page>
        <ion-content>
            <p class="text-title">Welcome, {{ this.name }}</p>
            <img class="img-deco" src="@/../resources/img_typeofplace.png" alt="">
            <ion-button @click="this.$router.push({name: 'createRoom', component: () => import('../views/CreateRoomScreen.vue') })" class="custom-btn btn-new" fill="outline" color="dark">Create a new place</ion-button>
            <p class="text-or">or...</p>
            <ion-button @click="this.$router.push({name: 'joinRoom', component: () => import('../views/joinRoomScreen.vue') })" class="custom-btn btn-existing" fill="outline" color="dark">Join an existing place</ion-button>
        </ion-content>
    </ion-page>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'ChooseTypeScreen',
    data() {
      return {
        name: localStorage.getItem('userName')
      }
    }
});
</script>

<style scoped>

    p {
        font-family: 'Noto Sans', sans-serif;
        font-style: normal;
        font-weight: 600;
        line-height: 22px;
        align-items: center;
        text-align: center;
        letter-spacing: -0.408px;
        color: #262B2C;
        text-align: center;
        margin-bottom: 8vw;
    }

    .text-title {
        position: relative;
        top: 10vh;
        font-size: 24px;
    }

    .img-deco {
        position: relative;
        top: 13vh;
    }

    .btn-new {
        position: relative;
        top: 20vh;
    }

    .text-or {
        position: relative;
        top: 18vh;
        font-size: 14px;
    }

    ion-button {
      --border-width: 0.5px;
      margin-bottom: 5vw;
    }

    .btn-existing {
        position: relative;
        top: 16vh;
    }
</style>