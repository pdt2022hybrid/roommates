<template>
    <ion-page>

        <ion-header class="header ion-text-end">
      <ion-toolbar>
        <ion-icon :icon="chevronBackOutline"></ion-icon>
        <ion-title>
          Set profile picture
        </ion-title>
        <ion-label class="later">
            <router-link to="/ChooseTypeOfPlace">
              Later
            </router-link>
        </ion-label>
      </ion-toolbar>
    </ion-header>

    <ion-content fullscreen>
      <div class="content">

        <button>
          <label for="files" @change="onFileSelected">
            <img class="rounded" id="picture" :src="picture ? picture : avatar" alt="">
          </label>
            <input @change="onFileSelected" id="files" type="file">
        </button>
      </div>
      <span class="bottom">
        By clicking on profile icon you can change your profile picture or by clicking on the button.
      </span>
    </ion-content>

    </ion-page>
</template>

<script>

import { IonPage, IonContent, IonHeader,IonTitle, IonLabel, IonToolbar } from '@ionic/vue';
import avatar from '../../resources/SetProfilePicture.svg'
import {ref} from 'vue'

export default {
    components: {
    IonPage, IonContent, IonToolbar, IonTitle, IonLabel, IonHeader
  },

  data() {
    return {
      avatar,
      selectedFile: null,
      fileContents: null,
      picture: null
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
      window.location.replace("https://roomates.hybridlab.dev/ChooseTypeOfPlace")
    },
  },
}

</script>

<style>

.header {
    color: #989AA2;
    background-color: white;
    font-family: 'Noto Sans', sans-serif;
    font-size: 18px !important;
    padding: 16px 16px;
  }

  a {
    text-decoration: none;
  }

  .content {
    position: absolute;
    left: 50%;
    top: 35%;
    transform: translate(-50%, -50%);
  }

  .rounded {
    border-radius: 100%;
  }


.bottom {
  position: absolute;
  top: 70%;
  left: 50%;
  transform: translate(-50%, -50%);
}

  input {
    display: none;
  }

  button {
    border: none !important;
    width: 80vw;
    height: 80vw;
    background-color: white;
  }

  label {
    height: 100% !important;
    width: 100% !important;
    color: red;
  }

  img {
    background-color: white;
    width: 100%;
    height: 100%;
  }

.later {
    color: #FF4961;
    font-size: 16px;
    font-weight: 600;
}

span {
    color: #989AA2;
    font-size: 12px;
    font-weight: 600;
    text-align: center;
    width: 80%;
}

ion-toolbar {
  --border-width: 0px;
  --border-style: none;
  --background: white;
  vertical-align: middle;
}

ion-title {
  color: #989AA2;
}

</style>