<template>
  <ion-page class="overlay">
    <ion-content :fullscreen="true">
      <ion-card class="title-card">
        <ion-card-header>
          <ion-card-title>
            <ion-grid>
              <ion-row>
                <ion-col size="auto">
                  <ion-icon @click="closeModal()" :icon="close" style="font-size: 24px;"></ion-icon>
                </ion-col>
                <ion-col class="title">
                  Filters
                </ion-col>
              </ion-row>
            </ion-grid>
          </ion-card-title>
        </ion-card-header>
      </ion-card>
      <p class="subtitle">Date</p>
      <ion-item v-for="sel in labelsDate" :key="sel">
        <ion-label label-placement="fixed">{{ sel.label }}</ion-label>
        <ion-select v-model="sel.value" interface="popover" justify="space-between" :placeholder="optionsDate[0].text">
          <ion-select-option v-for="o in optionsDate" :key="o" :value="o.id">{{ o.text }}</ion-select-option>
        </ion-select>
      </ion-item>
      <p class="subtitle">Roommate</p>
      <ion-item v-for="roommate in members" :key="roommate">
        <ion-label>{{ roommate.name }}</ion-label>
        <ion-checkbox v-model="roommate.value" justify="space-between"></ion-checkbox>
      </ion-item>
      <p class="subtitle">Status</p>
      <ion-item v-for="status in statuses" :key="status">
        <ion-label>{{ status.status }}</ion-label>
        <ion-checkbox v-model="status.value" justify="space-between"></ion-checkbox>
      </ion-item>
      <p class="subtitle">Importance</p>
      <ion-radio-group v-model="this.importanceSort">
        <ion-item>
          <ion-label>Most Important</ion-label>
          <ion-radio value="most" justify="space-between"/>
        </ion-item>
        <ion-item>
          <ion-label>Least Important</ion-label>
          <ion-radio value="least" justify="space-between"/>
        </ion-item>
      </ion-radio-group>
    </ion-content>
  </ion-page>
</template>

<script lang="ts">
import {
  placeholderMembers, taskFilterDateOptions, taskFilterMember, taskFilterImportance, TaskFilter,
  dateOptionsValue, TaskStatuses, taskFilterStatus
} from "@/types";
import {close} from 'ionicons/icons';
import {defineComponent} from "vue";
import {modalController} from "@ionic/vue";

export default defineComponent({
  props: {
    filter: {
      type: Object,
      required: true
    }
  },

  data() {
    return {
      modalFilter: {},
      close,
      optionsDate: [
        {id: 'any', text: "Any"},
        {id: 'newest', text: "Newest"},
        {id: 'oldest', text: "Oldest"},
      ],
      labelsDate: [
        {id: 'createdDate', label: "Task created", value: 'any' as dateOptionsValue},
        {id: 'promiseDate', label: "Promise date", value: 'any' as dateOptionsValue},
        {id: 'cancelDate', label: "Auto cancel date", value: 'any' as dateOptionsValue},
      ],
      importanceSort: "most" as taskFilterImportance
    }
  },

  mounted() {
    this.modalFilter = this.filter
  },

  methods: {
    closeModal() {
      modalController.dismiss({
        filter: this.modalFilter
      })
    }
  }
})
</script>