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
          <ion-input v-model="inputName" :readonly="inputsDisabled" :value="task.name"></ion-input>
        </ion-item>
        <ion-item>
          <ion-label position="stacked">
            Assigned to
          </ion-label>
          <ion-input :readonly="inputsDisabled" :value="task.user_assigned.name"></ion-input>
        </ion-item>
        <ion-item>
          <ion-label position="stacked">
            Description
          </ion-label>
          <ion-input v-model="inputDescription" :readonly="inputsDisabled" :value="task.description == null ? 'No description was added' : task.description"></ion-input>
        </ion-item>
        <ion-item>
          <ion-label position="stacked">
            Room
          </ion-label>
          <ion-input :readonly="inputsDisabled" :value="task.miniroom.name"></ion-input>
        </ion-item>
        <ion-item>
          <ion-label position="stacked">
            Created by
          </ion-label>
          <ion-input :readonly="true" :value="task.user_created.name"></ion-input>
        </ion-item>
        <ion-item>
          <ion-label position="stacked">
            Deadline
          </ion-label>
          <ion-input>
            {{ formatDate(this.task.deadline) }}
          </ion-input>
        </ion-item>
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
import { IonPage, IonContent, IonHeader,IonTitle, IonList, IonLabel, IonItem, IonToolbar } from '@ionic/vue';
import axios from "axios";
export default {
  name: "TaskDetailModal",
  props: {
    task: {
      required: true,
      type: Object,
    }
  },
  data() {
    return {
      inputName: this.task.name,
      inputDescription: this.task.description,
      userAsigned: this.task.user_assigned.id,
      miniRoom: this.task.miniroom.id,
      inputDeadline: this.task.deadline,

      inputsDisabled: true,
      statusId: this.task.status_id,
      statusColor: this.task.status.color
    }
  },
  components: {
    IonPage, IonContent, IonToolbar, IonTitle, IonHeader, IonList, IonLabel, IonItem
  },
  mounted() {
    if(this.task.user_created.name == localStorage.getItem('userName')) {
      this.inputsDisabled = false
      console.log(this.inputsDisabled)
    }
  },
  methods: {
    click(name) {
      name  == localStorage.getItem('userName') ? this.updateTask() && this.closeModal() : this.closeModal()
      console.log(name)
    },
    closeModal() {
      console.log(this.task)
      modalController.dismiss({
        task: this.task
      })
    },
    async updateTask() {
      await axios.post('/v1/task/' + this.task.id + '/update', {
        user_assigned_id: this.userAsigned,
        miniroom_id: this.miniRoom,
        task_name: this.inputName,
        task_description: this.inputDescription,
        deadline: this.inputDeadline,
      }, {
        headers: {
          Authorization: localStorage.getItem('userToken')
        }
      })
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