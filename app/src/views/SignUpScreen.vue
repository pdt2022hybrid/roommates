<template>

<ion-page>

    <ion-header class="ion-no-border">
        <ion-toolbar>
            <img src="@/../resources/36-arrow-left-1.svg">
            <ion-title>
                Sign Up
            </ion-title>
        </ion-toolbar>
    </ion-header>

    <ion-content>
        <ion-item>
            <ion-label position="stacked">
                E-mail
            </ion-label>
            <ion-input placeholder="Write your e-mail here"></ion-input>
        </ion-item>
        <ion-item>
            <ion-label position="stacked">
                Password
            </ion-label>
            <div>
                <ion-input placeholder="Your password"></ion-input>
                <ion-icon style="padding-left: 150px;" :icon="eyeOutline"></ion-icon>
            </div>
        </ion-item>
        <ion-item>
            <ion-label position="stacked">
                Confirm password
            </ion-label>
            <div>
                <ion-input placeholder="Reapeat password"></ion-input>
                <ion-icon style="padding-left:  ;" :icon="eyeOutline"></ion-icon>
            </div>
        </ion-item>
    </ion-content>

</ion-page>

</template>


<script>
    import { defineComponent } from 'vue';
    import { IonTitle, IonItem, IonLabel, IonInput, IonToolbar, IonHeader, IonIcon } from '@ionic/vue';
    import { eyeOutline } from 'ionicons/icons'

    export default {
        data() {
            return {
                eyeOutline
            }
        }
    }
</script>





<style scoped>
    img {
        padding-left: 8px;
    }

    ion-label {
        color: #989AA2 !important;
        font-size: 12px;
    }

    ion-input {
        font-size: 17px;
    }

    div {
        display: flex;
        align-items: center;
    }
</style>