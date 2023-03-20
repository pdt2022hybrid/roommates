<template>
    <ion-page @click="this.$router.push({path: 'tabs/tab1'})">
        <ion-content>
            <div id="container">
                <img src="@/../resources/logo_full.svg" class="logo">
            </div>
        </ion-content>
    </ion-page>
</template>

<script>
    import { IonPage, IonContent/*, IonImg*/ } from '@ionic/vue';
    import { defineComponent } from 'vue';
    import { useRouter } from 'vue-router';

    export default defineComponent({
        name: 'SplashScreen',
        components: { IonPage, IonContent/*, IonImg*/ },
        setup() {
            const router = useRouter();
            setTimeout( () => router.push({path: '/tabs/tab1'}), 2000);
            return { router };
        }
    });
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
        flex-direction: column;
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
        position: relative;
        width: 146px;
        height: 74.55px;
        filter: drop-shadow(0px 7.23077px 5px rgba(185, 185, 185, 0.31));
    }
</style>