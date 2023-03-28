<template>
  <ion-page>
    <ion-tabs>
      <ion-router-outlet></ion-router-outlet>
      <ion-tab-bar slot="bottom">

          <!--Nefunguje require
          <ion-tab-button v-for="tab in this.tabs" :key="tab.tab" tab="{{ tab.tab }}" href="{{ tab.href }}">
              <ion-label :src="require(tab.icon)" alt=""></ion-label>
              <ion-label>{{ tab.text }}</ion-label>
          </ion-tab-button>
          -->

          <ion-tab-button tab="home" href="/tabs/home">
              <ion-icon :src="require(`@/../resources/tab_home.svg`)" />
              <ion-label>Home</ion-label>
          </ion-tab-button>

          <ion-tab-button tab="tasks" href="/tabs/tasks">
            <ion-icon :src="require(`@/../resources/tab_tasks.svg`)" />
            <ion-label>Tasks</ion-label>
          </ion-tab-button>

          <ion-tab-button tab="add" href="/tabs/add">
            <ion-icon :src="require(`@/../resources/tab_add.svg`)" />
            <ion-label>Add</ion-label>
          </ion-tab-button>

          <ion-tab-button tab="calendar" href="/tabs/calendar">
              <ion-icon :src="require(`@/../resources/tab_calendar.svg`)" />
              <ion-label>Calendar</ion-label>
          </ion-tab-button>

          <ion-tab-button tab="profile" href="/tabs/profile">
              <ion-icon :src="require(`@/../resources/tab_profile.svg`)" />
              <ion-label>Profile</ion-label>
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
                new Tab('home', 'Home', '/tabs/home', '@/../resources/tab_home.svg'),
                new Tab('tasks', 'Tasks', '/tabs/tasks', '@/../resources/tab_tasks.svg'),
                new Tab('add', 'Add', '/tabs/add', '@/../resources/tab_add.svg'),
                new Tab('calendar', 'Calendar', '/tabs/calendar', '@/../resources/tab_calendar.svg'),
                new Tab('profile', 'Profile', '/tabs/profile', '@/../resources/tab_profile.svg'),
            ]
        }
    }
});
</script>
