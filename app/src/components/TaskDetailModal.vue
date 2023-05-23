<template>
  <ion-page>
    <ion-header class="header">
      <ion-toolbar>
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
          <ion-select v-model="inputs.assignedToName" :value="inputs.assignedToName" placeholder="Assign to a roommate">
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
          <ion-select :value="inputs.miniRoomName" v-model="inputs.miniRoomName" aria-label="fruit" placeholder="Room">
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
          <ion-datetime displayFormat="MM/DD/YYYY" pickerFormat="MM DD YYYY" v-model="updatedTask.deadline" class="date-time"></ion-datetime>
        </div>
        <div class="row">
          <ion-chip disabled :class="this.statusId == 3 ? 'completed' : 'dark'">Completed</ion-chip>
          <ion-chip disabled :class="this.statusId == 2 ? 'inProgress' : 'dark'">In progress</ion-chip>
          <ion-chip disabled :class="this.statusId == 1 ? 'notStarted' : 'dark'">Not started</ion-chip>
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
import { IonPage, IonContent, IonChip, IonHeader,IonTitle, IonList, IonLabel, IonItem, IonToolbar, IonDatetime } from '@ionic/vue';
import axios from "axios";
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
      statusId: this.task.status_id,
      statusColor: this.task.status.color
    }
  },
  components: {
    IonPage, IonContent, IonToolbar, IonTitle, IonHeader, IonList, IonLabel, IonItem, IonDatetime, IonChip
  },
  mounted() {
    if(this.task.user_created.name == localStorage.getItem('userName')) {
      this.inputsDisabled = false
      this.displayCal = 'd-block calendar'
      this.displayDeadline = 'd-none'
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
</style>