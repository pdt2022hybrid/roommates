<template>
    <ion-page>
        <ion-content>
            <ion-header class="header">
                <ion-toolbar>
                    <ion-icon @click="this.$router.back()" :icon="chevronBackOutline"/>
                    <ion-title color="#989AA2">New Room</ion-title>
                </ion-toolbar>
            </ion-header>
            <h2>Creating a room, how exciting...</h2>
            <ion-item>
                <ion-label position="stacked">Name of place</ion-label>
                <ion-input v-model="this.name" type="text" placeholder="What should we call your place ?"></ion-input>
            </ion-item>
            <ion-item>
                <ion-select placeholder="Which rooms will be in your place ?" @ionChange="selectedRooms = $event.detail.value" :multiple="true">
                    <ion-select-option v-for="room in presetRooms" :key="room.id" :value="room">{{ room.name }}</ion-select-option>
                </ion-select>
            </ion-item>
            <!--
            <p>{{ JSON.stringify(selectedRooms) }}</p>
            <h1>{{ numberOfRooms }}</h1>
            -->
            <ion-grid>
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
            <ion-list>
                <ion-label text-wrap class="ion-text-wrap">
                    <ion-chip v-for="room in customRooms" :key="room">
                        <ion-label>{{ room }}</ion-label>
                        <ion-icon @click="removeCustomRoom(room)" :icon="closeOutline"/>
                    </ion-chip>
                </ion-label>
            </ion-list>
            <ion-button class="custom-btn">Create</ion-button>
        </ion-content>
    </ion-page>
</template>

<script lang="ts">
import { IonSelect, IonSelectOption, IonChip, IonNote } from '@ionic/vue';
import { defineComponent, computed } from 'vue';
import { chevronBackOutline, closeOutline } from 'ionicons/icons';
import { PresetRoom } from '@/types';

export default defineComponent({
    name: 'ChooseTypeScreen',
    components: { IonSelect, IonSelectOption, IonChip, IonNote },
    data() {
        return {
            name: '',
            numberOfRooms: computed(() => this.selectedRooms.length + this.customRooms.length),
            selectedRooms: [] as PresetRoom[],
            customRooms: [] as string[],
            customRoomInput: '',
            customRoomError: '',
            presetRooms: [
                new PresetRoom('kitchen', "Kitchen"),
                new PresetRoom('work', "Work Room"),
                new PresetRoom('bath', "Bathroom"),
                new PresetRoom('dining', "Dining Room"),
                new PresetRoom('living', "Living Room")
            ]
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
            if(this.customRooms.find(o => o === room)) {
                this.customRoomError = 'Room already exists';
                this.customRoomInput = room;
                return;
            }
            this.customRooms.push(room);
            this.customRoomInput = '';
            this.customRoomError = '';
        },
        removeCustomRoom(room: string) {
            const i = this.customRooms.findIndex(o => o === room);
            if(i > -1) this.customRooms.splice(i,1);
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

ion-icon {
    color: black;
    width: 24px;
    height: 24px;
    float: left !important;
}
</style>