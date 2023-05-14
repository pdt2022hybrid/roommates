<template>
    <ion-page>

    <top-bar title="Share screen"></top-bar>

    <ion-content>
        <h1>
            Share your place to your 
            <br> 
            <span>
                Roommates !
            </span>
        </h1>

        <ion-item>
            <p>

            </p>
            <img slot="end" class="icon" src="../../resources/22-send.svg" alt="">
        </ion-item>

        <ion-item>
            <p>
                
            </p>
            <img slot="end" class="icon" src="../../resources/19-uplaod.svg" alt="">
        </ion-item>

        <ion-button shape="round">
            Share
        </ion-button>

    </ion-content>

    </ion-page>
</template>

<script>

import { chevronBackOutline } from 'ionicons/icons';
import topBar from "@/components/TopBar.vue";
import { IonHeader, IonItem, IonTitle, IonToolbar, IonContent, IonInput, IonButton } from '@ionic/vue';
import TopBar from "@/components/TopBar.vue";

export default {
  components: {TopBar},
    componets: {
        IonHeader, IonToolbar, IonTitle, IonContent, IonItem, IonInput, IonButton, TopBar
    },

    data() {
        return {
            chevronBackOutline,
        }
    }
}

</script>

<style scoped>

ion-icon {
  color: black;
  width: 24px;
  height: 24px;
  float: left !important;
}

span {
    font-weight: 700;
}

ion-content {
    font-family: 'Noto Sans', sans-serif;
}

ion-item {
    padding-right: 16px !important;
    display: block;
}

ion-button {
    width: 200px;
    font-family: 'Noto Sans', sans-serif;
    font-weight: 600;
    margin-top: 20vh;
}

</style>