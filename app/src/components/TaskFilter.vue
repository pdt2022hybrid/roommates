<template>
  <ion-icon @click="openModal()" class="menu-icon" :icon="require(`@/../resources/icon_filter.svg`)"/>
</template>

<script lang="ts">

import {
    placeholderMembers, taskFilterDateOptions, taskFilterMember, taskFilterImportance, TaskFilter,
    dateOptionsValue, TaskStatuses, taskFilterStatus, DefaultTaskFilter
} from "@/types";
import {defineComponent} from "vue";
import {modalController} from "@ionic/vue";
import TaskFilterModal from '@/components/TaskFilterModal.vue'

export default defineComponent({
  name: "TaskFilter",
  data() {
    return {
      filter: DefaultTaskFilter
    }
  },
  // computed() {
  //   filteredBlogs() {
  //     // this.blogs = [{name: 'asdasd'}, ....]
  //
  //     if (!this.filter)
  //         return this.blogs
  //
  //     let blogs = this.blogs
  //
  //     if (this.filter.name)
  //       blogs = blogs.filter(blog => blog.name == this.filter.name)
  //
  //     if (this.filter.author)
  //       blogs = blogs.filter(blog => blog.autor == this.filter.autor)
  //
  //     return blogs
  //   }
  //
  // },
  methods: {
    async openModal() {
      const modal = await modalController.create({
        component: TaskFilterModal,
        componentProps: {
          filter: this.filter
        }
      })

      await modal.present()

      const { data } = await modal.onDidDismiss();
      this.filter = data.filter;
      this.$emit('updateFilter', this.filter);
    }
  },
  emits: ['updateFilter']
})
</script>

<style scoped>
body {
  font-family: 'Noto Sans', sans-serif;
  font-style: normal;
}

.menu-icon {
  color: black;
  width: 24px;
  height: 24px;
  float: left !important;
}

ion-select {
  max-width: 100% !important;
}

p {
  font-family: 'Roboto', sans-serif;
  font-style: normal;
  font-weight: 400;
  font-size: 16px;
  line-height: 24px;
}

ion-card-title {
  margin: 0 auto;
  text-align: left;
}

ion-grid, ion-col {
  padding: 0;
}
</style>