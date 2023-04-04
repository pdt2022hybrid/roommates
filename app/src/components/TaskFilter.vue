<template>
    <ion-page class="overlay" v-if="show">
        <ion-content :fullscreen="true">
        <ion-card class="title-card">
            <ion-card-header>
                <ion-card-title>
                    <ion-grid>
                        <ion-row>
                            <ion-col size="auto">
                                <ion-icon @click="this.show = false" :icon="close" style="font-size: 24px;"></ion-icon>
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
        <ion-item v-for="sel in optionsDate" :key="sel">
            <ion-label label-placement="fixed">{{ sel.label }}</ion-label>
            <ion-select interface="popover" justify="space-between" :placeholder="sel.options[0].text">
                <ion-select-option v-for="o in sel.options" :key="o" :value="o.id">{{ o.text }}</ion-select-option>
            </ion-select>
        </ion-item>
        <p class="subtitle">Roommate</p>
        <ion-item v-for="roommate in this.roommates" :key="roommate">
            <ion-label>{{ roommate }}</ion-label>
            <ion-checkbox justify="space-between"></ion-checkbox>
        </ion-item>
        <p class="subtitle">Importance</p>
        <ion-radio-group value="most">
            <ion-item>
                <ion-label>Most Important</ion-label>
                <ion-radio value="most" justify="space-between">Space Between Label and Control</ion-radio>
            </ion-item>
            <ion-item>
                <ion-label>Least Important</ion-label>
                <ion-radio value="least" justify="space-between">Space Between Label and Control</ion-radio>
            </ion-item>
        </ion-radio-group>
        </ion-content>
    </ion-page>
    <ion-icon @click="this.show = true" class="menu-icon" :icon="require(`@/../resources/icon_filter.svg`)"/>
</template>

<script>
import { close } from 'ionicons/icons';
import { defineComponent } from "vue";
import { useStore } from 'vuex'

export default defineComponent({
    name: "TaskFilter",
    data() {
        return {
            close,
            store: useStore(),
            show: false,
            optionsDate: [
                {
                    label: "Task created",
                    options: [
                        { id: "any", text: "Any" },
                        { id: "newest", text: "Newest" },
                        { id: "oldest", text: "Oldest" },
                    ]
                },
                {
                    label: "Promise date",
                    options: [
                        { id: "any", text: "Any" },
                        { id: "newest", text: "Newest" },
                        { id: "oldest", text: "Oldest" },
                    ]
                },
                {
                    label: "Auto cancel date",
                    options: [
                        { id: "any", text: "Any" },
                        { id: "newest", text: "Newest" },
                        { id: "oldest", text: "Oldest" },
                    ]
                },
            ],
            roommates: [
                'Marek Topolsky',
                'Richard Egyed',
                'Sloboda',
                'Luptacik'
            ]
        }
    }
})
</script>

<style scoped>
body {
    font-family: 'Noto Sans', sans-serif;
    font-style: normal;
}

.overlay {
    z-index: 2000;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    position: fixed;
}

.menu-icon {
    color: black;
    width: 24px;
    height: 24px;
    float: left !important;
}

.title {
    margin-left: 6.4vw;
    font-weight: 500;
    font-size: 20px;
    line-height: 120%;
    color: #222428;
}
.title-card {
    margin-top: 5.5vh;
}

.subtitle {
    font-weight: 400;
    font-size: 20px;
    line-height: 24px;
    text-align: left;
    margin-left: 7.6vw;
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