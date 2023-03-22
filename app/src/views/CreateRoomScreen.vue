<template>
    <ion-page>
        <ion-content>
            <ion-header class="header">
                <ion-toolbar>
                    <ion-icon :icon="chevronBackOutline"></ion-icon>
                    <ion-title color="#989AA2">New Room</ion-title>
                </ion-toolbar>
            </ion-header>
            <h2>Creating a room, how exciting...</h2>
            <ion-item>
                <ion-label position="stacked">Name of place</ion-label>
                <ion-input v-model="this.name" type="text" placeholder="What should we call your place ?"></ion-input>
            </ion-item>
            <ion-button class="custom-btn">Create</ion-button>
        </ion-content>
    </ion-page>
</template>

<script>
import { IonPage, IonContent, IonButton, IonIcon, IonItem, IonLabel, IonInput, IonTitle, IonHeader, IonToolbar } from '@ionic/vue';
import { defineComponent } from 'vue';
import { chevronBackOutline } from 'ionicons/icons';

export default defineComponent({
    name: 'ChooseTypeScreen',
    components: { IonPage, IonContent, IonButton, IonIcon, IonItem, IonLabel, IonInput, IonTitle, IonHeader, IonToolbar },
    data() {
        return {
            name: '',
            numberOfRooms: 0,
            rooms: [],
            customRooms: []
        }
    },
    setup() {
    return { chevronBackOutline };
    }
});
</script>

<style scoped>
.header {
    color: #989AA2;
    background-color: white;
    font-family: 'Noto Sans', sans-serif;
    font-size: 18px !important;
    padding: 16px
}

ion-icon {
    color: black;
    width: 24px;
    height: 24px;
    float: left !important;
}
</style>