<template>
    <!--<ion-tab-button v-for="room in rooms" :key="room">
        <--<img :src="room.img" alt="">->
        <span>
            {{ room.name }}
        </span>
    </ion-tab-button>-->
    <ion-grid>
        <ion-row>
            <ion-col>
                <img src="../../resources/room_kitchen.svg" alt="">
                <p>
                    Kitchen
                </p>
            </ion-col>
            <ion-col>
                <img src="../../resources/room_living.svg" alt="">
                <p>
                    Living room
                </p>
            </ion-col>
            <ion-col>
                <img src="../../resources/room_bathroom.svg" alt="">
                <p>
                    Bath room
                </p>
            </ion-col>
            <ion-col>
                <img src="../../resources/room_work.svg" alt="">
                <p>
                    Working room
                </p>
            </ion-col>
            <ion-col>
                <img src="../../resources/room_dining.svg" alt="">
                <p>
                    Dining room
                </p>
            </ion-col>
            <ion-col>
                <img src="../../resources/room_custom.svg" alt="">
                <p>
                    Custom room
                </p>
            </ion-col>
        </ion-row>
    </ion-grid>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'FilterRooms',
    data () {
        return {
            rooms: [
                {
                    name: 'Kitchen',
                    img: '../../resources/room_kitchen.svg'
                },
                {
                    name: 'Living Room',
                    img: '../../resources/room_living.svg'
                },
                {
                    name: 'Bathroom',
                    img: '../../resources/room_bathroom.svg'
                },
                {
                    name: 'Work Room',
                    img: '../../resources/room_work.svg'
                },
                {
                    name: 'Dining Room',
                    img: '../../resources/room_dining.svg'
                },
                {
                    name: 'Custom Room',
                    img: '../../resources/room_custom.svg'
                }
            ]
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