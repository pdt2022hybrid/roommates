import { InjectionKey } from 'vue';
import { createStore, useStore as baseUseStore, Store } from 'vuex';
import { presetRooms, PresetRoom, createCustomRoom, Room, Task, Priority } from '@/types';
import axios from "axios";

export interface State {
    token: string,
    userName: string,
    userSureName: string,
    userEmail: string,
}

export const store = createStore<State>({
    state: {
        token: localStorage.getItem('roomatesToken'),
        userName: localStorage.getItem('UserName'),
        userSureName: localStorage.getItem('UserSureName'),
        userEmail: localStorage.getItem('UserEmail'),

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
        }

    },
    actions: {
        login:  async function ({ commit }, credentials) {
            await axios.post('https://roomates.hybridlab.dev/cms/api/auth/login', credentials)
                .then(function (response) {
                    console.log(response)
                    const token = response.data.token
                    const userName = response.data.user.name
                    const userSureName = response.data.user.surname
                    const userEmail = response.data.user.email
                    store.commit('login', {token: token, userName: userName, userSurname: userSureName, userEmail: userEmail})
                    console.log(token)
                    localStorage.setItem('userToken', token)
                    localStorage.setItem('userName', userName)
                    localStorage.setItem('userSureName', userSureName)
                    localStorage.setItem('userEmail', userEmail)
            }).catch(function (error) {
                console.error(error);
            })
        },
    },
})

export const key: InjectionKey<Store<State>> = Symbol()
export function useStore() {
    return baseUseStore(key)
}
