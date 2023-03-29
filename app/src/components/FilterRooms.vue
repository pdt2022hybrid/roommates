<template>
    <ion-grid>
        <ion-row>
            <ion-col v-for="room in rooms" :key="room">
                <img :src="this.getIcon(room.icon)" alt="">
                <p>{{ room.name }}</p>
            </ion-col>
        </ion-row>
    </ion-grid>
</template>

<script>
import { defineComponent } from 'vue';
import { presetRoomsWithCustom } from "@/types";

export default defineComponent({
    name: 'FilterRooms',
    data () {
        return {
            rooms: presetRoomsWithCustom
        }
    },
    methods: {
        getIcon: function (icon) {
            return require(`@/../resources/${icon}`)
        }
    }
});
</script>

<style scoped>

img {
    height: 30px;
    width: 29px;
}
/*div {
    display: flex;
    flex-direction: column;
    padding: 16px;
}

section {
    display: flex;
    background-color: white;
    color: black;
    font-family: 'Noto Sans', sans-serif;
    font-size: 10px;
}*/

p {
    font-weight: 400;
    font-size: 10px;
}

</style>