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
          <img src="../../../resources/share.svg">
        </h1>
        <ion-item>
          <p>
            reaktivne heslo placu
          </p>
        </ion-item>
      </div>

    </ion-content>
  </ion-page>
</template>

<script>
import { IonPage, IonContent, IonHeader,IonTitle, IonToolbar, IonChip, IonLabel, IonItem } from '@ionic/vue';
import {defineComponent, ref} from 'vue';
import avatar from '../../../resources/Avatar.svg'


export default defineComponent({
  components: {
    IonPage, IonContent, IonToolbar, IonTitle, IonHeader, IonChip, IonLabel, IonItem
  },
  data() {
    return {
      picture: null,
      avatar,
      selectedFile: null,
      fileContents: null,
      userName: localStorage.getItem('userName'),
      userEmail: localStorage.getItem('userEmail'),
    }
  },
  mounted() {
    this.picture = ref(localStorage.getItem('picture') || null)
  },
  methods: {
    onFileSelected(e) {
      const file = e.target.files[0]
      const fr = new FileReader();

      // eslint-disable-next-line @typescript-eslint/no-this-alias
      const vm = this

      fr.onload = function() {
        vm.picture = ref(fr.result)
        localStorage.setItem('picture', fr.result)
      }.bind(vm)

      fr.readAsDataURL(file);
    },
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
