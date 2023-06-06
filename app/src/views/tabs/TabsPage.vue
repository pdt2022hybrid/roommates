<template>
  <ion-page>
    <ion-tabs>
      <ion-router-outlet></ion-router-outlet>
      <ion-tab-bar slot="bottom">
          <ion-tab-button v-for="tab in this.tabs" :key="tab.tab" :tab="tab.tab" @click="this.$router.push(tab.href)">
              <ion-icon :src="this.getIcon(tab.icon)" alt=""></ion-icon>
              <ion-label>{{ tab.text }}</ion-label>
          </ion-tab-button>
      </ion-tab-bar>
    </ion-tabs>
  </ion-page>
</template>

<script lang="ts">
import { IonTabBar, IonTabButton, IonTabs, IonRouterOutlet } from '@ionic/vue';
import { defineComponent } from 'vue';

class Tab {
    tab: string;
    text: string;
    href: string;
    icon: string;
    constructor(tab: string, text: string, href: string, icon: string) {
        this.tab = tab;
        this.text = text;
        this.href = href;
        this.icon = icon;
    }
}

export default defineComponent({
    components: { IonTabBar, IonTabButton, IonTabs, IonRouterOutlet },
    data() {
        return {
            tabs: [
                new Tab('home', 'Home', '/tabs/home', 'tab_home.svg'),
                new Tab('tasks', 'Tasks', '/tabs/tasks', 'tab_tasks.svg'),
                new Tab('add', 'Add', '/tabs/add', 'tab_add.svg'),
                new Tab('calendar', 'Calendar', '/tabs/calendar', 'tab_calendar.svg'),
                new Tab('profile', 'Profile', '/tabs/profile', 'tab_profile.svg'),
            ]
        }
    },
    methods: {
        getIcon: function (icon: string) {
            return require(`@/../resources/${icon}`)
        }
    },
});
</script>

<style>
ion-tab-button {
    --color-selected: #FF4961 !important;
}
</style>
