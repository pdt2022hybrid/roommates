<template>
<ion-page>
    <ion-content :fullscreen="true">
        <top-bar title="Home" :menu="true"/>
    </ion-content>
</ion-page>
</template>

<script>
  import TopBar from '@/components/TopBar.vue';
  import { defineComponent } from 'vue';

  export default defineComponent({
      components: { TopBar },
  });
</script>

<style scoped>

.header-md::after {
  display: none;
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

</style>