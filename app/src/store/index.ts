import { InjectionKey } from 'vue';
import { createStore, useStore as baseUseStore, Store } from 'vuex';
import { presetRooms, PresetRoom, createCustomRoom, Room, Task, Priority } from '@/types';

export interface State {
    token: string,
    room: Room
}

export const store = createStore<State>({
    state: {
        token: '',
        room: {
            name: '',
            members: [
                "Marek Topolsky",
                "Richard Egyed",
                "Sloboda",
                "Luptacik"
            ],
            presetRooms: [
                presetRooms[0],
                presetRooms[1],
                presetRooms[4]
            ],
            customRooms: [
                createCustomRoom("Roooom"),
                createCustomRoom("Room 7"),
                createCustomRoom("CustomRoom22"),
            ],
            tasks: [
                new Task("UPRAC KUCHYNU", "RICHARD EGYED", '2023-1-12', Priority.HIGH, 'kitchen'),
                new Task("ALE NO UZ", "LUPTACIK", '2023-1-12', Priority.MEDIUM, 'bath'),
                new Task("CHOD DOMOV", "SLOBODA", '2023-1-12', Priority.LOW, 'living'),
                new Task("UPRAC SVOJU IZBU", "MAREK TOPOLSKY", '2023-1-12', Priority.LOW, 'work')
            ]
        }
    },
    getters: {
    
    },
    mutations: {
        setRoomName: (state, name: string) => state.room.name = name,
        setRoomMembers: (state, members: string[]) => state.room.members = members,
        setPresetRooms: (state, rooms: PresetRoom[]) => state.room.presetRooms = rooms,
        setCustomRooms: (state, rooms: PresetRoom[]) => state.room.customRooms = rooms,
        setTasks: (state, tasks: Task[]) => state.room.tasks = tasks,
        addTask: (state, task: Task) => state.room.tasks.push(task),
        removeTask: (state, task: Task) => {
            const i = state.room.tasks.findIndex(o => o === task);
            if(i > -1) state.room.tasks.splice(i,1);
        }

    },
    actions: {
    
    }
})

export const key: InjectionKey<Store<State>> = Symbol()
export function useStore() {
    return baseUseStore(key)
}
