<template>
    <ion-page>

        <ion-header class="header ion-text-end">
      <ion-toolbar>
        <ion-icon :icon="chevronBackOutline"></ion-icon>
        <ion-title>
          Set profile picture
        </ion-title>
        <ion-label class="later">
            Later
        </ion-label>
      </ion-toolbar>
    </ion-header>

    <ion-content>
      <div class="content">

        <button>
          <label for="files" @change="onFileSelected"></label>          
          <input id="files" type="file">
        </button>

        <ion-item lines="none">
            <p>
                By clicking on profile icon you can change your profile picture or by clicking on the button.
            </p>
        </ion-item>
      </div>
    </ion-content>

    </ion-page>
</template>

<script>

import { IonPage, IonContent, IonHeader,IonTitle, IonItem, IonLabel, IonToolbar } from '@ionic/vue';

export default {
    components: {
    IonPage, IonContent, IonToolbar, IonTitle, IonLabel, IonHeader, IonItem
  },

  data() {
    return {
      selectedFile: null,
    }
  },

  methods: {
    onFileSelected(event) {
      this.selectedFile = event.target.files[0]
    }
  }
}

</script>

<style scoped>

.header {
    color: #989AA2;
    background-color: white;
    font-family: 'Noto Sans', sans-serif;
    font-size: 18px !important;
    padding: 16px 16px;
  }

  .content {
    position: absolute;
    top: 10%;
  }

  button {
    border: none !important;
    background-image: url(../../resources/SetProfilePicture.svg);
    height: 310px;
    width: 300px;
    background-color: white;
  }

  label {
    height: 100% !important;
    width: 100% !important;
    color: red;
  }

  input {
    
  }

.later {
    color: #FF4961;
    font-size: 16px;
    font-weight: 600;
}

p {
    color: #989AA2;
    font-size: 12px;
    font-weight: 600;
    text-align: center;
    padding-top: 80px;
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