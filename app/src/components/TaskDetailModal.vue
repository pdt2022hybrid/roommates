<template>
  <ion-page>
    <ion-header class="header">
      <ion-toolbar>
        <ion-icon @click="closeModal" :icon="chevronBackOutline"></ion-icon>
        <ion-title>
          Task Detail
        </ion-title>
      </ion-toolbar>
    </ion-header>

    <ion-content>
      <ion-list>
        <ion-item>
          <ion-label position="stacked">
            Name
          </ion-label>
          <ion-input v-model="inputs.name" :readonly="inputsDisabled" :value="task.name"></ion-input>
        </ion-item>
        <ion-item>
          <ion-label position="stacked">
            Assigned to
          </ion-label>
          <ion-select :class="{'pointer-events-none':inputsDisabled}" v-model="inputs.assignedToName" :value="inputs.assignedToName" placeholder="Assign to a roommate">
            <div class="options" v-for="user in users" v-bind:key="user">
              <ion-select-option :value="user.name">{{ user.name }}</ion-select-option>
            </div>
          </ion-select>
        </ion-item>
      <ion-item>
          <ion-label position="stacked">
            Description
          </ion-label>
          <ion-input v-model="inputs.description" :readonly="inputsDisabled" :value="inputs.description"></ion-input>
        </ion-item>
        <ion-item>
          <ion-label position="stacked">
            Room
          </ion-label>
          <ion-select :class="{'pointer-events-none':inputsDisabled}" :value="inputs.miniRoomName" v-model="inputs.miniRoomName" aria-label="fruit" placeholder="Room">
            <div class="options" v-for="miniroom in minirooms" v-bind:key="miniroom">
              <ion-select-option :value="miniroom.name">{{ miniroom.name }}</ion-select-option>
            </div>
          </ion-select>
        </ion-item>
        <ion-item>
          <ion-label position="stacked">
            Created by
          </ion-label>
          <ion-input :readonly="true" :value="task.user_created.name"></ion-input>
        </ion-item>
        <ion-item :class="displayDeadline">
          <ion-label position="stacked">
            Deadline
          </ion-label>
          <ion-input>
            {{ formatDate(this.inputs.deadline) }}
          </ion-input>
        </ion-item>
        <div :class="displayCal">
          <ion-datetime :value="inputs.deadline" displayFormat="MM/DD/YYYY" pickerFormat="MM DD YYYY" v-model="updatedTask.deadline" class="date-time"></ion-datetime>
        </div>
        <div class="row">
          <ion-chip :disabled="chipsDisabled" @click="this.statusId = 3" :class="this.statusId === 3 ? 'completed' : 'dark'">Completed</ion-chip>
          <ion-chip :disabled="chipsDisabled" @click="this.statusId = 2" :class="this.statusId === 2 ? 'inProgress' : 'dark'">In progress</ion-chip>
          <ion-chip :disabled="chipsDisabled" @click="this.statusId = 1" :class="this.statusId === 1 ? 'notStarted' : 'dark'">Not started</ion-chip>
        </div>
      </ion-list>
      <ion-button @click="click(task.user_assigned.name)" class="bottom" shape="round">
        Save
      </ion-button>
    </ion-content>
  </ion-page>
</template>

<script>
import {modalController} from "@ionic/vue";
import { IonPage, IonContent, IonIcon, IonChip, IonHeader,IonTitle, IonList, IonLabel, IonItem, IonToolbar, IonDatetime } from '@ionic/vue';
import axios from "axios";
import { chevronBackOutline } from 'ionicons/icons'
import {store} from "@/store";
export default {
  name: "TaskDetailModal",
  props: {
    task: {
      required: true,
      type: Object,
    },
    vm: {
      required: true,
      type: Object,
    }
  },
  data() {
    return {
      chevronBackOutline,
      inputs: {
        name: this.task.name,
        description: this.task.description,
        assignedToName: this.task.user_assigned.name,
        assignedToId: this.task.user_assigned.id,
        miniRoomId: this.task.miniroom.id,
        miniRoomName: this.task.miniroom.name,
        deadline: this.task.deadline,
      },
      updatedTask: {},

      displayDeadline: 'd-block',
      displayCal: 'd-none',
      minirooms: JSON.parse(localStorage.getItem('miniRooms')),
      users: JSON.parse(localStorage.getItem('roomUsers')),
      inputsDisabled: true,
      chipsDisabled: true,
      statusId: this.task.status_id,
      statusColor: this.task.status.color
    }
  },
  components: {
    IonPage, IonContent, IonToolbar, IonTitle, IonHeader, IonList, IonLabel, IonItem, IonDatetime, IonChip, IonIcon
  },
  mounted() {
    if(this.task.user_created.name == localStorage.getItem('userName')) {
      this.inputsDisabled = false
      this.displayCal = 'd-block calendar'
      this.displayDeadline = 'd-none'
    }
    if(this.task.user_assigned.name == localStorage.getItem('userName')) {
      this.chipsDisabled = false
    }
    if(this.inputs.description == null || this.inputs.description == '') {
      this.inputs.description = 'No description was added'
    }
  },
  methods: {
    click(name) {
      name  == localStorage.getItem('userName') ? this.updateTask() && this.closeModal() : this.closeModal()
    },
    closeModal() {
      modalController.dismiss({
        task: this.task
      })
    },
    async updateTask() {
      for (let i = 0; i <  this.minirooms.length; i++) {
        if(this.inputs.miniRoomName == this.minirooms[i].name) {
          this.inputs.miniRoomId = this.minirooms[i].id
        }
      }
      for (let i = 0; i < this.users.length; i++) {
        if(this.inputs.assignedToName == this.users[i].name) {
          this.inputs.assignedToName = this.users[i].id
        }
      }
      if(this.inputs.name !== this.task.name) {
        this.updatedTask.task_name = this.inputs.name
      }
      if(this.inputs.assignedToName !== this.task.user_assigned.name && this.inputs.assignedToId !== this.task.user_assigned.id) {
        this.updatedTask.user_assigned_id = this.inputs.assignedToId
      }
      if(this.inputs.description !== this.task.description && this.inputs.description !== 'No description was added') {
        this.updatedTask.task_description = this.inputs.description
      }
      if(this.inputs.miniRoomName !== this.task.miniroom.id && this.inputs.miniRoomId !== this.task.miniroom.id) {
        this.updatedTask.miniroom_id = this.inputs.miniRoomId
      }
      if(this.inputs.deadline !== this.task.deadline) {
        this.updatedTask.deadline = this.inputs.deadline
      }
      if(this.statusId !== this.task.status.id) {
        this.updatedTask.status_id = this.statusId
      }
      console.log(this.updatedTask)
      if(Object.keys(this.updatedTask).length !== 0) {
        await axios.post('/v1/task/update/' + this.task.id, this.updatedTask, {
          headers: {
            Authorization: 'Bearer ' + localStorage.getItem('userToken')
          }
        })
            .then(function (response) {
              console.log(response)
            })
        await store.dispatch('storeTasks', this.updatedTask)
        this.vm.reloadTask()
      }
    }
  },
  computed: {
    formatDate() {
      return function (dateString) {
        const date = new Date(dateString);
        const day = date.getDate().toString().padStart(2, "0");
        const month = (date.getMonth() + 1).toString().padStart(2, "0");
        const year = date.getFullYear();
        return `${day}.${month}.${year}`;
      };
    },
  }
}
</script>

<style scoped>

.pointer-events-none {
  pointer-events: none;
}
.header {
  background-color: white;
  padding: 16px
}
.header-md::after {
  display: none;
}

.notStarted {
  --background: #e94b4b;
  --color: #FFFFFF;
  opacity: 1;
}

.d-none {
  display: none;
}

.completed {
  --background: #1abc9c;
  --color: #FFFFFF;
  opacity: 1;
}

ion-icon {
  color: black;
  width: 24px;
  height: 24px;
  float: left !important;
}

.d-block {
  display: block;
}

.calendar {
  margin-top: 2rem;
  margin-bottom: 1rem;
  display: flex;
  justify-content: center;
}

.inProgress {
  --background: #2980b9;
  --color: #FFFFFF;
  opacity: 1;
}

.dark {
  --background: grey;
  --color: #FFFFFF;
  opacity: 0.4;
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

.row {
  margin-top: 1rem;
}

ion-item {
  padding-right: 2rem;
}

:root {
  --ion-color-rose: #3171e0;
  --ion-color-rose-rgb: 131, 24, 67;
  --ion-color-rose-contrast: #ffffff;
  --ion-color-rose-contrast-rgb: 255, 255, 255;
  --ion-color-rose-shade: #73153b;
  --ion-color-rose-tint: #8f2f56;

  --ion-text-color: #881337;
  --ion-text-color-rgb: 136, 19, 55;

  --ion-color-step-50: #f9e6e9;
  --ion-color-step-100: #f3dbdf;
  --ion-color-step-150: #edd0d6;
  --ion-color-step-200: #e7c5cd;
  --ion-color-step-250: #e1bac3;
  --ion-color-step-300: #dbaeba;
  --ion-color-step-350: #d5a3b1;
  --ion-color-step-400: #cf98a7;
  --ion-color-step-450: #c98d9e;
  --ion-color-step-500: #c48295;
  --ion-color-step-550: #be778b;
  --ion-color-step-600: #b86c82;
  --ion-color-step-650: #b26178;
  --ion-color-step-700: #ac566f;
  --ion-color-step-750: #a64b66;
  --ion-color-step-800: #a03f5c;
  --ion-color-step-850: #9a3453;
  --ion-color-step-900: #94294a;
  --ion-color-step-950: #8e1e40;
}

.ion-color-rose {
  --ion-color-base: var(--ion-color-rose);
  --ion-color-base-rgb: var(--ion-color-rose-rgb);
  --ion-color-contrast: var(--ion-color-rose-contrast);
  --ion-color-contrast-rgb: var(--ion-color-rose-contrast-rgb);
  --ion-color-shade: var(--ion-color-rose-shade);
  --ion-color-tint: var(--ion-color-rose-tint);
}

ion-datetime {
  --background: #fff1f2;
  --background-rgb: 255, 241, 242;

  border-radius: 16px;
  box-shadow: rgba(var(--ion-color-rose-rgb), 0.3) 0px 10px 15px -3px;
}
</style>