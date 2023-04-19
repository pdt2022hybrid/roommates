<template>
    <ion-page>
        <ion-content>
            <ion-header class="header">
                <ion-toolbar>
                    <ion-icon @click="this.$router.back()" :icon="chevronBackOutline"/>
                    <ion-title color="#989AA2">New Room</ion-title>
                </ion-toolbar>
            </ion-header>
            <p class="title">Creating a room, how exciting...</p>
            <ion-item class="inputs">
                <ion-label position="stacked">Name of place</ion-label>
                <ion-input v-model="this.name" type="text" placeholder="What should we call your place ?"></ion-input>
            </ion-item>
            <ion-item class="inputs">
                <ion-select placeholder="Which rooms will be in your place ?" @ionChange="selectedRooms = $event.detail.value;" :multiple="true">
                    <ion-select-option v-for="room in presetRooms" :key="room.id" :value="room">{{ room.name }}</ion-select-option>
                </ion-select>
            </ion-item>
            <!--
            <p>{{ JSON.stringify(selectedRooms) }}</p>
            <h1>{{ numberOfRooms }}</h1>
            -->
            <ion-grid class="inputs">
                <ion-row class="ion-align-items-end">
                    <ion-col>
                        <ion-item ref="input" class="ion-invalid">
                            <ion-label position="stacked">Add custom room</ion-label>
                            <ion-input v-model="this.customRoomInput" :clear-input="true" maxlength="32" placeholder="Room name"></ion-input>
                            <ion-note position="" slot="error">{{ this.customRoomError }}</ion-note>
                        </ion-item>
                    </ion-col>
                    <ion-col size="auto">
                        <ion-button @click="this.addCustomRoom(this.customRoomInput)">Add</ion-button>
                    </ion-col>
                </ion-row>
            </ion-grid>
            <ion-list class="inputs">
                <ion-label text-wrap class="ion-text-wrap">
                    <ion-chip v-for="room in customRooms" :key="room">
                        <ion-label>{{ room.name }}</ion-label>
                        <ion-icon @click="removeCustomRoom(room.name)" :icon="closeOutline"/>
                    </ion-chip>
                </ion-label>
            </ion-list>
            <ion-button @click="addNewRoom" class="custom-btn">Create</ion-button>
        </ion-content>
    </ion-page>
</template>

<script lang="ts">
import { IonSelect, IonSelectOption, IonChip, IonNote } from '@ionic/vue';
import { defineComponent, computed } from 'vue';
import { chevronBackOutline, closeOutline } from 'ionicons/icons';
import axios from 'axios';

class PresetRoom {
    id: string;
    name: string;
    constructor(id: string, name: string) {
        this.id = id;
        this.name = name;
    }
}

export default defineComponent({
    name: 'ChooseTypeScreen',
    components: { IonChip, IonNote },
    data() {
        return {
            chevronBackOutline, closeOutline,
            name: '',
            numberOfRooms: computed(() => this.selectedRooms.length + this.customRooms.length),
            selectedRooms: [] as PresetRoom[],
            customRooms: [] as PresetRoom[],
            customRoomInput: '',
            customRoomError: '',
        }
    },
    methods: {
        addCustomRoom(room: string) {
            room = room.trim().replace(/\s+/g, ' ');
            if(!room) {
                this.customRoomError = 'Name must not be empty';
                this.customRoomInput = room;
                return;
            }
            if(this.customRooms.find(o => o.name === room)) {
                this.customRoomError = 'Room already exists';
                this.customRoomInput = room;
                return;
            }
            this.customRooms.push(createCustomRoom(room));
            this.customRoomInput = '';
            this.customRoomError = '';
            this.customRooms.sort();
        },
        removeCustomRoom(room: string) {
            const i = this.customRooms.findIndex(o => o.name === room);
            if(i > -1) this.customRooms.splice(i,1);
        },
      async addNewRoom() {
          const izba = this.customRooms
        try {
          const addNewPlace = await axios.post("https://roomates.hybridlab.dev/cms/api/v1/room/create ", {
            room_name: this.name,
          });
          console.log(addNewPlace); // Log the response to the console
        } catch (error) {
          console.error(error); // Log the error to the console
        }
        const addNewRoom = await axios.post("https://roomates.hybridlab.dev/cms/api/v1/room/miniroom/create", {
          izba_name: izba,
        })
      }
    },
    setup() {
        return { chevronBackOutline, closeOutline };
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

.title {
    position: relative;
    top: 10vh;
    z-index: 10;
    font-family: 'Noto Sans', sans-serif;
    font-style: normal;
    font-weight: 600;
    font-size: 24px;
    line-height: 22px;
}

.inputs {
    position: relative;
    top: 16vh;
}

.btn-create {
    position: relative;
    top: 28vh;
}

ion-icon {
    color: black;
    width: 24px;
    height: 24px;
    float: left !important;
}

ion-grid {
    padding-left: 0;
}
ion-col {
    padding-left: 0;
}
</style>