<template>
  <ion-page>
    <ion-header class="header">
      <ion-toolbar>
        <ion-title>
          <img src="../../../resources/profileIcon.svg" alt="profileIcon">
          Profile
        </ion-title>
      </ion-toolbar>
    </ion-header>

    <ion-content :fullscreen="true">
      <button>
        <label for="files" @change="onFileSelected">
          <img class="rounded avatar" :src="picture ? picture : avatar" alt="">
        </label>
        <input @change="onFileSelected" id="files" type="file">
      </button>

      <ion-item lines="none">
        <ion-label position="stacked">
          Your Name
        </ion-label>
        <ion-chip :outline="true">
          {{ userName }}
        </ion-chip>
      </ion-item>
      <ion-item lines="none">
        <ion-label position="stacked">
          Your Email
        </ion-label>
        <ion-chip :outline="true">
          {{ userEmail }}
        </ion-chip>
      </ion-item>

      <div id="share">
        <h1>
          Share Your place
          <img src="../../../resources/share.svg" @click="copyRoomToken()" style="cursor: pointer" alt="share">
        </h1>
        <ion-item @click="copyRoomToken()" style="cursor: pointer">
          <p>
            {{ this.roomToken }}
          </p>
        </ion-item>
      </div>
      <ion-button shape="round" @click="leaveRoom">
        <p>
          LEAVE ROOM
        </p>
      </ion-button>
      <ion-button shape="round" @click="logOut">
        <p>
          LOG OUT
        </p>
      </ion-button>

    </ion-content>
  </ion-page>
</template>

<script>
import { IonPage, IonContent, IonHeader,IonTitle, IonToolbar, IonChip, IonLabel, IonButton, IonItem } from '@ionic/vue';
import {defineComponent, ref} from 'vue';
import {store} from "@/store";
import avatar from '../../../resources/Avatar.svg'
import axios from "axios";
import { Clipboard } from '@capacitor/clipboard';

export default defineComponent({
  components: {
    IonPage, IonContent, IonToolbar, IonTitle, IonHeader, IonChip, IonLabel, IonItem, IonButton
  },
  data() {
    return {
      picture: null,
      avatar,
      selectedFile: null,
      fileContents: null,
      roomToken: null,
      userName: null,
      userEmail: null,
    }
  },
  async mounted() {
    console.log('aidawd')
    await store.dispatch('loaded', true)

    this.picture = localStorage.getItem('picture')
    this.picture = ref(localStorage.getItem('picture'))

    if(!this.picture || this.picture === 'null') this.picture = avatar
    await store.dispatch('storeUsers', true)
    await store.dispatch('storeRoomToken')
    this.roomToken = localStorage.getItem('roomToken'),
    this.userName = localStorage.getItem('userName'),
    this.userEmail = localStorage.getItem('userEmail'),
    await store.dispatch('loaded', false)
  },
  methods: {
    async onFileSelected(e) {
      const file = e.target.files[0]
      const fr = new FileReader();

      // eslint-disable-next-line @typescript-eslint/no-this-alias
      const vm = this

      fr.onload = function() {
        vm.picture = ref(fr.result)
        localStorage.setItem('picture', fr.result)
      }.bind(vm)

      fr.readAsDataURL(file);

      const formData = new FormData();
      formData.append('avatar', e.target.files[0]);
      store.commit('loading', true)
      await axios.post('v1/user/avatar/set', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          Authorization:  'Bearer ' + localStorage.getItem('userToken')
        }
      })
          .then(function (response) {
            console.log(response)
            setTimeout(() => {
              store.commit('loading', false)
            }, 1000)
          })
    },
    logOut() {
      localStorage.clear()
      this.roomToken = null
      this.userName = null
      this.userEmail = null
      this.$router.push({path: '/'})
    },
    async leaveRoom() {
      store.dispatch('loaded', true)
      try {
        await axios.get('v1/room/leave', {
          headers: {
            Authorization: 'Bearer ' + localStorage.getItem('userToken')
          }
        })
        this.roomToken = null
        this.userName = null
        this.userEmail = null
        localStorage.removeItem('roomId')
        localStorage.removeItem('roomUsers')
        localStorage.removeItem('roomTasks')
        localStorage.removeItem('roomToken')
        this.$router.push('/chooseTypeOfPlace')
        store.dispatch('loaded', false)
      } catch(error) {
        console.warn(error)
      }
    },
    async copyRoomToken() {
        await Clipboard.write({
            string: this.roomToken
        });
    }
  },

});
</script>

<style scoped>

.header {
  background-color: white;
  padding: 16px
}
a {
  color: #262B2C !important;
  text-decoration: none;
}
.header-md::after {
  display: none;
}
.rounded {
  border-radius: 100%;
}

ion-item {
  padding-bottom: 1rem;
}

#share {
  border: 0.6px black solid;
  border-radius: 10px;
  margin: 1rem;
}

h1 {
  margin-top: 1rem;
  margin-bottom: 1rem;
  padding-bottom: 0.5rem;
  color: #262B2C;
  border-bottom: 0.6px #989AA2 solid;
}

ion-toolbar {
  --border-width: 0px;
  --border-style: none;
  --background: white;
}
ion-toolbar > ion-title {
  color: #989AA2;
  font-weight: 600;
  font-size: 18px !important;
}

input {
  display: none;
}

button {
  border: none !important;
  background-color: white;
}

label {
  height: 100% !important;
  width: 100% !important;
  color: red;
}

.avatar {
  background-color: white;
  width: 188px;
  height: 188px;
}

ion-chip {
  width: 100% !important;
  padding: 1.5rem;
  border-radius: 20px;
  border-color: #262B2C;
  margin-left: 0;
}

ion-label {
  padding-bottom: 4px;
}

ion-item {
  padding-right: 16px;
}
</style>
