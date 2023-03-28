<template>
    <section>
        <div>
            <img src="../../resources/room_kitchen.svg" alt="">
            <span>
                Kitchen
            </span>
        </div>
        <div>
            <img src="../../resources/room_living.svg" alt="">
            <span>
                Living room
            </span>
        </div>
        <div>
            <img src="../../resources/room_bathroom.svg" alt="">
            <span>
                Bath room
            </span>
        </div>
        <div>
            <img src="../../resources/room_work.svg" alt="">
            <span>
                Working room
            </span>
        </div>
        <div>
            <img src="../../resources/room_dining.svg" alt="">
            <span>
                Dining room
            </span>
        </div>
        <div>
            <img src="../../resources/room_custom.svg" alt="">
            <span>
                Custom room
            </span>
        </div>
    </section>
</template>

<style>

img {
    height: 30px;
    width: 29px;
}
div {
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
}

span {
    display: flex;
    flex-direction: row;
}

</style>