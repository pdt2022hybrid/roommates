<template>
    <ion-page>
        <ion-content>
            <h2>What type of place you have?</h2>
            <img src="@/../resources/img_typeofplace.png" alt="">
            <ion-button class="custom-btn" fill="outline" color="dark">New</ion-button>
            <p>or...</p>
            <ion-button class="custom-btn" fill="outline" color="dark">Existing</ion-button>
        </ion-content>
    </ion-page>
</template>

<script>
import { IonPage, IonContent, IonButton } from '@ionic/vue';
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'ChooseTypeScreen',
    components: { IonPage, IonContent, IonButton }
});
</script>