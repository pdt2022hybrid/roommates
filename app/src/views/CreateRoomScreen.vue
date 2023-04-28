<template>
  <ion-page>

    <ion-header class="header">
      <ion-toolbar>
        <router-link to="/login">
          <ion-icon class="ion-float-left" :icon="chevronBackOutline"></ion-icon>
        </router-link>
        <ion-title>
          New place
        </ion-title>
      </ion-toolbar>
    </ion-header>

    <ion-content fullscreen>
      <div class="content">
        <ion-item>
          <ion-label position="stacked">
            Name of place
          </ion-label>
          <ion-input v-model="placeName" placeholder="What should we call your place ?"></ion-input>
        </ion-item>
        <ion-item>
          <ion-label position="stacked">
            Add your rooms
          </ion-label>
          <ion-input class="" v-model="newRoomName" placeholder="Add some rooms"></ion-input>
          <ion-button slot="end" @click="newRoom" class="small">
            Add
          </ion-button>
        </ion-item>
      </div>
      <div class="bottom">
        <ion-button @click="createPlace">
          Create
        </ion-button>
      </div>
      <div class="list">
          <span class="fullRoom" v-for="room in rooms" v-bind:key="room">
          <div class="room">
            {{ room }}
          </div>
            <button class="delete">
              X
            </button>
        </span>
      </div>
    </ion-content>

  </ion-page>
</template>

<script>
import { IonPage, IonContent, IonItem, IonButton, IonInput, IonLabel, IonHeader,IonTitle, IonIcon, IonToolbar } from '@ionic/vue';
import { chevronBackOutline } from 'ionicons/icons';
import axios from "axios";
export default {
    name: 'ChooseTypeScreen',
    components: {
      IonPage, IonIcon, IonToolbar, IonTitle, IonInput, IonHeader, IonContent, IonItem, IonButton, IonLabel
    },
    data() {
        return {
          chevronBackOutline,
          placeName: '',
          newRoomName: '',
          rooms: [],
        }
    },
    methods: {
      newRoom() {
        this.rooms.push(this.newRoomName)
        this.newRoomName = ''
      },
      createPlace: async function () {
        const response =  await axios.post('https://roomates.hybridlab.dev/cms/api/v1/room/create', {room_name: this.placeName, izby: this.rooms}, {headers: {
          Authorization: 'Bearer ' +  localStorage.getItem('userToken')
          }})
        console.log(response)
      },
    }
};
</script>

<style scoped>
@import url('https://fonts.cdnfonts.com/css/nunito');

.header {
  background-color: white;
  padding: 16px
}

.content {
  position: absolute;
  top: 30%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.bottom {
  position: absolute;
  top: 85%;
  left: 50%;
  transform: translate(-50%, -50%);
}

d-none {
  display: none;
}

.header-md::after {
  display: none;
}

.fullRoom {
  display: flex;
}

.delete {
  font-size: 300%;
  background-color: white;
  color: black;
  font-family: 'Nunito', sans-serif;
}

ion-toolbar {
  --border-width: 0px;
  --border-style: none;
  --background: white;
}

.list {
  text-align: start;
  padding-left: 16px;
  padding-right: 16px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
}

.room {
  font-size: 20px;
  border: 0.5px gray solid;
  width: 50%;
  padding: 16px;
  border-radius: 10rem;
  text-align: center;
  filter: drop-shadow(0 25px 25px rgb(0 0 0 / 0.15));
  margin-right: auto;
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

.small {
  width: 20% !important;
  height: 80%;
  margin-left: auto;
}

h3 {
  font-weight: 700;
}

ion-label {
  font-family: 'Roboto', sans-serif;
  font-size: 12px !important;
  color: #3C3C43;
  opacity: 60%;
}
</style>