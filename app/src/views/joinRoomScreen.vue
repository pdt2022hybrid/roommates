<template>
  <ion-page>
    <top-bar title="Join a place" :menu="false"></top-bar>
    <ion-content :fullscreen="true">
      <div class="content">
        <ion-item>
          <ion-label position="stacked">Link</ion-label>
          <ion-input v-model="roomIdentifier" placeholder="Paste here a room identifier"></ion-input>
        </ion-item>
      </div>
      <div class="bottom">
        <ion-button @click="join" shape="round">
          Continue
        </ion-button>
      </div>
    </ion-content>
  </ion-page>
</template>

<script>
import TopBar from "@/components/TopBar.vue";
import { IonPage, IonContent, IonItem, IonButton, IonInput, IonLabel, IonHeader,IonTitle, IonIcon, IonToolbar } from '@ionic/vue';
import axios from "axios";
export default {
  name: "joinRoomScreen",
  components: {
    IonPage, IonContent, TopBar
  },
  data() {
    return {
      roomIdentifier: null,
    }
  },
  methods: {
    async join() {
      await axios.get('https://roomates.hybridlab.dev/cms/api/v1/room/join/' + this.roomIdentifier, {headers: {
        Authorization: 'Bearer ' + localStorage.getItem('userToken')
        }}).then(function (response) {
        const roomId = response.data.data.id
        localStorage.setItem('roomId', roomId)
      })
      this.$router.push({path: '/tabs/home'})
    }
  },
}
</script>

<style scoped>
ion-item {
  padding-right: 1rem;
}

.bottom {
  position: absolute;
  top: 85%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.content {
  position: fixed;
  top: 40%;
  width: 100%;
}
</style>