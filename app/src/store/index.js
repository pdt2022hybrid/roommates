import { createStore } from 'vuex';
import { PresetRooms } from '@/types';

export default createStore({
    state: {
        token: '',
        room: {
            name: '',
            members: [
                'Marek Topolsky',
                'Richard Egyed',
                'Sloboda',
                'Luptacik'
            ],
            presetRooms: [
                PresetRooms[0],
                PresetRooms[1],
                PresetRooms[4]
            ],
            customRooms: [
            
            ]
        }
    },
    getters: {
    
    },
    mutations: {
    
    },
    actions: {
    
    }
})
