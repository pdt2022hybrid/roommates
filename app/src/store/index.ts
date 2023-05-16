import { InjectionKey } from 'vue';
import { createStore, useStore as baseUseStore, Store } from 'vuex';
import { presetRooms, PresetRoom, createCustomRoom, Room, Task, TaskStatus } from '@/types';
import axios from "axios";
import {minimatch} from "cypress/types/cy-minimatch";
import {resize} from "ionicons/icons";

export interface State {
    token: string,
    userName: string,
    userSureName: string,
    userEmail: string,
    userId: string,
    roomId: string,
    miniRooms: string,
    roomUsers: string,
}

export const store = createStore<State>({
    state: {
        token: localStorage.getItem('userToken')  || '',
        userName: localStorage.getItem('UserName') || '',
        userSureName: localStorage.getItem('UserSureName') || '',
        userEmail: localStorage.getItem('UserEmail') || '',
        userId: localStorage.getItem('userId') || '',
        roomId: localStorage.getItem('roomId') || '',
        miniRooms: localStorage.getItem('miniRooms') || '',
        roomUsers: localStorage.getItem('roomUsers') || '',
    },
    getters: {

    },
    mutations: {
        login(state, userData) {
            state.token = userData.token
            state.userName = userData.userName
            state.userSureName = userData.userSureName
            state.userEmail = userData.userEmail
            console.log(userData.token)
        },
        signup(state, userData) {
            state.token = userData.token
            state.userName = userData.userName
            state.userSureName = userData.userSureName
            state.userEmail = userData.userEmail
            state.userId = userData.userId
            console.log(userData.token)
        },
        createRoom(state, roomData) {
            state.roomId = roomData
        },
        storeMinirooms(state, roomData) {
            state.miniRooms = roomData.data.data
            localStorage.setItem('miniRooms', JSON.stringify(state.miniRooms))
        },
        storeUsers(state, roomUsers) {
            state.roomUsers = roomUsers.data.data
            localStorage.setItem('roomUsers', JSON.stringify(state.roomUsers))
        }

    },
    actions: {
        login:  async function ({ commit }, credentials) {
            await axios.post('/auth/login', credentials)
                .then(function (response) {
                    console.log(response)
                    const userToken = response.data.token
                    const userName = response.data.user.name
                    const userSureName = response.data.user.surname
                    const userEmail = response.data.user.email
                    store.commit('login', {token: userToken, userName: userName, userSurname: userSureName, userEmail: userEmail})
                    console.log(userToken)
                    localStorage.setItem('userToken', userToken)
                    localStorage.setItem('userName', userName)
                    localStorage.setItem('userSureName', userSureName)
                    localStorage.setItem('userEmail', userEmail)
            }).catch(function (error) {
                console.error(error);
            })
        },
        signup: async function ({commit}, credentials) {
            await axios.post('/auth/signup', credentials)
                .then(function (response) {
                    console.log(response)
                    const userToken = response.data.token
                    const userName = response.data.user.name
                    const userSureName = response.data.user.surname
                    const userEmail = response.data.user.email
                    const userId = response.data.user.id
                    store.commit('signup', {token: userToken, userName: userName, userSurname: userSureName, userEmail: userEmail, userId: userId})
                    localStorage.setItem('userToken', userToken)
                    localStorage.setItem('userName', userName)
                    localStorage.setItem('userSureName', userSureName)
                    localStorage.setItem('userEmail', userEmail)
                    localStorage.setItem('userId', userId)
                }).catch(function (error) {
                    console.error(error)
                })
        },
        createRoom: async function ({commit}, data) {
            const response =  await axios.post('v1/room/create', data, {headers: {
                    Authorization: 'Bearer ' +  localStorage.getItem('userToken')
                }})
            const roomId = response.data.data.id
            store.commit('createRoom', roomId)
            localStorage.setItem('roomId', roomId)
            console.log(response)
        },
        storeMinirooms: async function ({commit}, data) {
            await axios.get('/v1/room/minirooms', {headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('userToken')
                }})
                .then((response) => {
                    store.commit('storeMinirooms', response)
                })
        },
        storeUsers: async function ({commit}, data) {
            await axios.get('/v1/room/' + localStorage.getItem('roomId') + '/users', {headers: {
                Authorization: 'Bearer ' + localStorage.getItem('userToken')
                }})
                .then((response) => {
                    store.commit('storeUsers', response)
                })
        }
    },
})

export const key: InjectionKey<Store<State>> = Symbol()
export function useStore() {
    return baseUseStore(key)
}
