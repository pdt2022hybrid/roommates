<template>
    <ion-page @click="this.$router.push({path: '/login'})">
        <ion-content>
            <div id="container">
                <img src="@/../resources/logo_full.svg" class="logo" alt="Roommates">
            </div>
        </ion-content>
    </ion-page>
</template>

<script>
    import { defineComponent } from 'vue';
    import { useRouter } from 'vue-router';
    export default defineComponent({
        name: 'SplashScreen',
      mounted() {
        setTimeout( () => this.$router.push('/login'), 600)
      }
    });
</script>

<style scoped>

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