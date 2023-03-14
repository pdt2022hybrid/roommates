<template>
    <ion-page @click="this.$router.push({path: 'tabs/tab1'})">
        <ion-content>
            <div id="container">
                <img src="@/../resources/logo_img.svg" class="logo">
                <img src="@/../resources/logo_text.svg" class="logo">
            </div>
        </ion-content>
    </ion-page>
</template>

<script setup>
    import { IonPage, IonContent/*, IonImg*/ } from '@ionic/vue';
    import { defineComponent } from 'vue';

    setTimeout( () => this.$router.push({path: 'tabs/tab1'}), 2000); //TODO Nefunguje

    /*export default defineComponent({
        components: { IonPage, IonContent/*, IonImg* },
    });*/
</script>

<style scoped>
    body {
        text-align: center;
        position: absolute;
        left: 0;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
    }

    #container {
        text-align: center;
        position: absolute;
        left: 0;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
    }

    #container strong {
        font-size: 20px;
        line-height: 26px;
    }

    .logo {
        
        width: 258.5px;
        height: 47px;
        left: 66px;
        top: 336px;

        filter: drop-shadow(0px 7.23077px 5px rgba(185, 185, 185, 0.31));
    }
</style>