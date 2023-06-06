import { InjectionKey } from 'vue';
import { createStore, useStore as baseUseStore, Store } from 'vuex';
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
    roomTasks: string,
    roomToken: string,
    isLoading: boolean,
    errorMessage: string,
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
        roomTasks: localStorage.getItem('roomTasks') || '',
        roomToken: localStorage.getItem('roomToken') || '',
        isLoading: false,
        errorMessage: ''
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
        },
        storeTasks(state, roomTasks) {
            const tasks = [];
            for(const task of roomTasks.data.data) {
                task.deadline = new Date(Date.parse(task.deadline));
                tasks.push(task);
            }
            // state.roomTasks.forEach(task => {
            //     console.log(task)
            //     if(task.id == roomTasks.data.data.id) {
            //
            //     }
            // })

            state.roomTasks = roomTasks.data.data
            localStorage.setItem('roomTasks', JSON.stringify(state.roomTasks))
        },
        storeRoomToken(state, roomToken) {
          state.roomToken = roomToken
        },
        loading(state, isLoading) {
            state.isLoading = isLoading
        },
        setErrorMessage(state, message) {
            state.errorMessage = message;
        },
        clearErrorMessage(state) {
            state.errorMessage = ''
        }
    },
    actions: {
        async loaded({commit}, isLoading) {
            commit('loading', isLoading)
        },
        login:  async function ({ commit }, credentials) {
            commit('loading', true)
            await axios.post('/auth/login', credentials)
                .then(function (response) {
                    const userToken = response.data.token
                    const userName = response.data.user.name
                    const userSureName = response.data.user.surname
                    const userEmail = response.data.user.email
                    store.commit('login', {token: userToken, userName: userName, userSurname: userSureName, userEmail: userEmail})
                    localStorage.setItem('userToken', userToken)
                    localStorage.setItem('userName', userName)
                    localStorage.setItem('userSureName', userSureName)
                    localStorage.setItem('userEmail', userEmail)
                    axios.get('/v1/user/room', { headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('userToken')
                    }})
                    .then(function (response) {
                        localStorage.setItem('roomId', response.data.data.id)
                        commit('clearErrorMessage');
                    })
            }).catch(function (error) {
                if(error.response) {
                    const d = error.response.data;
                    if(d.includes('User Not Found') || d.includes('Wrong Password'))
                        commit('setErrorMessage', "Email or password is incorrect");
                    else commit('setErrorMessage', "An error has occurred, please try again later");
                }
                console.error(error.toJSON());
            })
            commit('loading', false)
        },
        signup: async function ({commit}, credentials) {
            commit('loading', true);
            await axios.post('/auth/signup', credentials)
                .then(function (response) {
                    console.log(response);
                    const userToken = response.data.token
                    const userName = response.data.user.name
                    const userSureName = response.data.user.surname
                    const userEmail = response.data.user.email
                    const userId = response.data.user.id
                    store.commit('signup', {token: userToken, userName: userName, userSurname: userSureName, userEmail: userEmail, userId: userId});
                    localStorage.setItem('userToken', userToken);
                    localStorage.setItem('userName', userName);
                    localStorage.setItem('userSureName', userSureName);
                    localStorage.setItem('userEmail', userEmail);
                    localStorage.setItem('userId', userId);
                }).catch(function (error) {
                    if(error.response) {
                        const d = error.response.data;
                        if(d.includes('The email must be between 6 and 255 characters'))
                            commit('setErrorMessage', "The email must be between 6 and 255 characters");
                        else if(d.includes('The email must be a valid email address'))
                            commit('setErrorMessage', "The email must be a valid email address");
                        else if(d.includes('The password must be between 8 and 255 characters'))
                            commit('setErrorMessage', "The password must be between 8 and 255 characters");
                        else commit('setErrorMessage', "An error has occurred, please try again later");
                        console.warn(d);
                    }
                    console.error(error);
                })
            commit('loading', false);
        },
        createRoom: async function ({commit}, data) {
            commit('loading', true)
            const response =  await axios.post('v1/room/create', data, {headers: {
                    Authorization: 'Bearer ' +  localStorage.getItem('userToken')
                }})
            const roomId = response.data.data.id
            store.commit('createRoom', roomId)
            localStorage.setItem('roomId', roomId)
            commit('loading', false)
        },
        storeMinirooms: async function ({commit}, data) {
            commit('loading', true)
            await axios.get('/v1/room/minirooms', {headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('userToken')
                }})
                .then((response) => {
                    store.commit('storeMinirooms', response)
                })
            commit('loading', false)
        },
        storeUsers: async function ({commit}, checker?) {
            commit('loading', true)
            if(store.state.isLoading !== false) {
                setTimeout(() => {
                    commit('loading', false)
                    if(checker === true) {
                        alert('An error ocured please log out, sign in and try again.')
                    }
                },5000)
            }
            await axios.get('/v1/room/' + localStorage.getItem('roomId') + '/users', {headers: {
                Authorization: 'Bearer ' + localStorage.getItem('userToken')
                }})
                .then((response) => {
                    store.commit('storeUsers', response)
                })
            checker = false
            commit('loading', false)
        },
        storeTasks: async function ({commit}, data) {
            commit('loading', true)
            await axios.get('/v1/tasks/room/' + localStorage.getItem('roomId'), {headers: {
                Authorization: 'Bearer ' + localStorage.getItem('userToken')
            }})
            .then((response) => {
                commit('storeTasks', response)
            })
        },
        storeRoomToken: async function ({commit}) {
            await axios.get('/v1/user/room', {headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('userToken')
                }})
                .then((response) => {
                    console.log(response)
                    localStorage.setItem('roomToken', response.data.data.room_identifier)
                    commit('storeRoomToken', localStorage.roomToken)
                })
        },
    },
})

export const key: InjectionKey<Store<State>> = Symbol()
export function useStore() {
    return baseUseStore(key)
}